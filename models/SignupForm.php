<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $name;
    public $email;
    public $password;
	public $birthdate;
	public $birthplace;
	public $country;
	public $city;
	public $street;
	public $zip;
	public $gender;
	public $phone;
	public $phone2;
	public $occupation;
	public $repeat_password;
	public $image;
	

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message' => 'Username tidak boleh kosong'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Username telah digunakan'],
            ['username', 'string', 'min' => 4, 'max' => 30, 'message' => 'Panjang username tidak boleh kurang dari 2 karakter dan lebih dari 255 karakter'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => 'Email tidak boleh kosong'],
            ['email', 'email', 'message' => 'Alamat email tidak valid'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Alamat email ini telah terpakai'],

            ['password', 'required', 'message' => 'Password tidak boleh kosong'],
            ['password', 'string', 'min' => 6, 'message' => 'Panjang password tidak boleh kurang dari 6 karakter'],
            ['repeat_password', 'compare', 'compareAttribute'=>'password', 'message'=>'Password tidak sama'],
            ['repeat_password', 'required', 'message' => 'Password tidak boleh kosong'],
			
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
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->name = $this->name;
            $user->email = $this->email;
            $user->setPassword($this->password);
			$user->role = 'Member';
			$user->status = 10;
			$user->birthdate = $this->birthdate;
			$user->birthplace = $this->birthplace;
			$user->country = $this->country;
            $user->city = $this->city;
            $user->street = $this->street;
            $user->zip = $this->zip;
			if ($this->gender == 0)
				$user->gender = 'Pria';
			else $user->gender = 'Wanita';
			$user->phone = $this->phone;
			$user->phone2 = $this->phone2;
			$user->occupation = $this->occupation;
			
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
