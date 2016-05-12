<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class ChangePassword extends Model
{
    public $enableCsrfValidation = false;

    public $username;
    public $email;
    public $old_password;
    public $new_password;
	public $repeat_password;

    private $_user = false;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User'],
            ['username', 'string', 'min' => 4, 'max' => 50,],

            //['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User'],

            [['old_password', 'new_password', 'repeat_password'], 'required'],
            ['new_password', 'string', 'min' => 6],
            ['old_password', 'validatePassword'],
            ['repeat_password', 'compare', 'compareAttribute'=>'new_password'],
            ['repeat_password', 'required'], 
        ];
    }

	public function attributeLabels()
    {
        return [
            'username' => 'Username',
			'email' => 'Email',
            'repeat_password' => 'Repeat New Password',	
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->old_password)) {
                $this->addError($attribute, 'Wrong old password.');
            }
        }
    }
	
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function setPassword()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->setPassword($this->new_password);
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername(Yii::$app->user->identity->username);
        }
        return $this->_user;
    }
    
}
