<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ShoppingCart;
use app\models\Category;
use app\models\Discount;
use app\models\ProductSearch;
use yii\base\DynamicModel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (isset($_GET['notif']))
            $notif = $_GET['notif'];
        else
            $notif = '';

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notif' => $notif,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (isset($_GET['notif']))
            $notif = $_GET['notif'];
        else
            $notif = '';

        return $this->render('view', [
            'model' => $this->findModel($id),
            'notif' => $notif,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $categoryList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
        $discountList = ArrayHelper::map(Discount::find()->asArray()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->image = 3;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id, 'notif' => 'Produk berhasil ditambahkan']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categoryList' => $categoryList,
                'discountList' => $discountList,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoryList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
        $discountList = ArrayHelper::map(Discount::find()->asArray()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'notif' => 'Produk berhasil diperbarui']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categoryList' => $categoryList,
                'discountList' => $discountList,
            ]);
        }
    }


    public function actionUploadphoto($id)
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

        $model2 = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->saveUploadedFile() !== false) {
                if ($model->file_id !== NULL && $model->file_id !== '')
                {
                    Yii::$app->db->createCommand('UPDATE uploaded_file SET type = "produk" WHERE id = '.$model->file_id)->execute();
                    $model2->image = $model->file_id;
                    $model2->save();
                    return $this->redirect(['view', 'id' => $model2->id, 'notif' => 'Foto berhasil diunggah']);
                }
            }
            else return $this->redirect(['view', 'id' => $model2->id, 'notif' => 'Foto gagal diunggah, silahkan periksa ukuran foto.']);
        } else {
            return $this->render('uploadphoto', [
                'model' => $model,
                'model2' => $model2,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'notif' => 'Produk berhasil dihapus']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
