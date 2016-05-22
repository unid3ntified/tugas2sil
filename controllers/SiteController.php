<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\base\DynamicModel;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\ActivityLog;

class SiteController extends Controller
{
    public $notif;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $data = Yii::$app->db->createCommand('SELECT id FROM uploaded_file WHERE type = "slider"')->queryAll();
        if (isset($_GET['notif']))
            $notif = $_GET['notif'];
        else
            $notif = '';
        return $this->render('index', [
                'data' => $data,
                'notif' => $notif,
            ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/index', 'notif' => 'Berhasil login']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['site/index', 'notif' => 'Berhasil logout']);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    // $activitylog = new ActivityLog();
                    // $activitylog->user_id = Yii::$app->user->id;
                    // $activitylog->timestamp = date('Y-m-d H:i:s');
                    // $activitylog->activity = 'Melakukan registrasi';
                    // $activitylog->save();

                    return $this->redirect(['site/index', 'notif' => 'Akun berhasil dibuat']);
                }
            }
        }
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionSlider()
    {
        $model = new DynamicModel([
            'file_id'
        ]);
     
        // behavior for upload file
        $model->attachBehavior('upload', [
            'class' => 'mdm\upload\UploadBehavior',
            'attribute' => 'file',
            'savedAttribute' => 'file_id', 
            //'uploadPath' => Yii::$app->homeUrl.'/files',
        ]);

        $data = Yii::$app->db->createCommand('SELECT id FROM uploaded_file WHERE type = "slider"')->queryAll();   
     
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->saveUploadedFile() !== false) {
                if ($model->file_id !== NULL && $model->file_id !== '')
                    Yii::$app->db->createCommand('UPDATE uploaded_file SET type = "slider" WHERE id = '.$model->file_id)->execute();
                Yii::$app->session->setFlash('success', 'Upload Success');
            }
        }
        return $this->render('slider',[
            'model' => $model,
            'data' => $data,
        ]);
    }

    public function actionDeleteslider($id)
    {
        Yii::$app->db->createCommand('DELETE FROM uploaded_file WHERE id = '.$id)->execute();
        return $this->redirect(['slider']);
    }
}
