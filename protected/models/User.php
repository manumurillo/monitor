<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $status
 */
class User extends CActiveRecord
{
	const STATUS_ACTIVE=1;
	const STATUS_DISABLED=2;
	
	private $_oldPassword="";
	
	private static $_status=array();
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'monitor_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('username, password, email, salt', 'length', 'max'=>128),
			array('username', 'validateUsername'),
			array('password', 'required', 'on'=>'create'),
			array('email', 'email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, status', 'safe', 'on'=>'search'),
		);
	}
	
	public function validateUsername($attribute,$params)
	{
		if (!preg_match('/^[a-zA-Z0-9_]{1,}$/', $this->$attribute))
			$this->addError($attribute,$this->getAttributeLabel($attribute).' solo puede contener letras números y guión bajo (_)');
		
	}
	
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Nombre de usuario',
			'password' => 'Contraseña',
			'email' => 'E-mail',
			'status' => 'Estado',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	public function validatePassword($password)
    {
        return $this->hashPassword($password,$this->salt)===$this->password;
    }
	
	public function hashPassword($password,$salt)
    {
        return md5($salt.$password);
    }
	
	protected function generateSalt()
	{
		return uniqid('',true);
	}
	
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->salt=$this->generateSalt();
				$this->password=$this->hashPassword($this->password,$this->salt);
			}
			elseif($this->password>"")
				$this->password=$this->hashPassword($this->password,$this->salt);
			else
				$this->password=$this->_oldPassword;
			
			return true;
		}
		else
			return false;
	}
	
	/**
	 * This is invoked after the record is saved.
	 */
	protected function afterSave()
	{
		parent::afterSave();
		$this->password = "";
	}
	
	public static function getStatusById($statusId)
	{
		self::loadStatus();
		return self::$_status[$statusId];
	}
	
	public static function getStatusArray()
	{
		self::loadStatus();
		return self::$_status;
	}
	
	private static function loadStatus()
	{
		if(empty(self::$_status))
		{
			self::$_status[User::STATUS_ACTIVE]='Active';
			self::$_status[User::STATUS_DISABLED]='Disabled';
		}
	}
}