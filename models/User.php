<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const STATUS_BANNED = 20;

     /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED, self::STATUS_BANNED]],
            [['created_at', 'updated_at'], 'safe'],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => 'Username tidak boleh kosong'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Username telah digunakan'],
            ['username', 'string', 'min' => 4, 'max' => 30, 'message' => 'Panjang username tidak boleh kurang dari 2 karakter dan lebih dari 255 karakter'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => 'Email tidak boleh kosong'],
            ['email', 'email', 'message' => 'Alamat email tidak valid'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Alamat email ini telah terpakai'],
            
            ['role', 'string', 'max' => 20, 'message' => 'Panjang role tidak boleh lebih dari 20 karakter' ],

            ['birthplace', 'filter', 'filter' => 'trim'],
            ['birthplace', 'string', 'max' => 50, 'message' => 'Panjang tempat lahir tidak boleh lebih dari 50 karakter'],
            
            ['birthdate', 'filter', 'filter' => 'trim'],
            ['birthdate', 'date', 'format' => 'yyyy-M-d', 'message' => 'Tanggal lahir dengan format yyyy-MM-dd'],
            
            ['country', 'filter', 'filter' => 'trim'],
            ['country', 'string', 'max' => 50, 'message' => 'Panjang alamat tidak boleh lebih dari 50 karakter'],

            ['city', 'filter', 'filter' => 'trim'],
            ['city', 'string', 'max' => 50, 'message' => 'Panjang alamat tidak boleh lebih dari 50 karakter'],

            ['street', 'filter', 'filter' => 'trim'],
            ['street', 'string', 'max' => 255, 'message' => 'Panjang alamat tidak boleh lebih dari 50 karakter'],

            ['zip', 'filter', 'filter' => 'trim'],
            ['zip', 'string', 'max' => 8, 'message' => 'Panjang alamat tidak boleh lebih dari 50 karakter'],

            ['gender', 'filter', 'filter' => 'trim'],
            ['gender', 'string', 'max' => 10],
            ['gender', 'required', 'message' => 'Jenis kelamin tidak boleh kosong'],
            
            ['phone', 'filter', 'filter' => 'trim'],
            ['phone', 'integer', 'message' => 'Nomor telepon harus berupa angka'],

            ['phone2', 'filter', 'filter' => 'trim'],
            ['phone2', 'integer', 'message' => 'Nomor telepon harus berupa angka'],
            
            ['occupation', 'filter', 'filter' => 'trim'],
            ['occupation', 'string', 'max' => 50, 'message' => 'Panjang pekerjaan tidak boleh lebih dari 50 karakter'],
            
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'max' => 100, 'message' => 'Panjang nama tidak boleh lebih dari 100 karakter'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'name' => 'Nama lengkap',
            'birthplace' => 'Tempat lahir',
            'birthdate' => 'Tanggal lahir',
            'country' => 'Negara',
            'city' => 'Kota',
            'street' => 'Alamat (Jalan)',
            'zip' => 'Kode pos',
            'phone' => 'Nomor telepon',
            'phone2' => 'Nomor telepon alternatif',
            'gender' => 'Jenis kelamin',
            'education' => 'Pendidikan terakhir',
            'occupation' => 'Pekerjaan',            
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function delete()
    {
        $this->status = 0;
        $this->save();
    }

    public function ban()
    {
        $this->status = 20;
        $this->save();
    }

    public function promote()
    {
        $this->role = 'Admin';
        $this->save();
    }
}
