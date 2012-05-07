<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $userid
 * @property string $emailaddress
 * @property string $password
 * @property string $warriorforumusername
 * @property string $paypalemailaddress
 */
class Users extends CActiveRecord
{
	public $cpassword;
	public $varification_code;
	public $is_active;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emailaddress, password,cpassword', 'required'),			
			array('cpassword', 'compare', 'compareAttribute'=>'password'),
			array('emailaddress,paypalemailaddress', 'email'),
			array('emailaddress', 'unique'),
			array('emailaddress, warriorforumusername, paypalemailaddress', 'length', 'max'=>255),
			array('password', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, emailaddress, password, warriorforumusername, paypalemailaddress,is_active,cpassword,varification_code', 'safe', 'on'=>'search'),
		);
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
			//'userid' => 'Userid',
			'emailaddress' => 'Email Address',
			'password' => 'Password',
			'warriorforumusername' => 'Warriorforum Username',
			'paypalemailaddress' => 'Paypal Email Address',
			'cpassword' => 'Retype Password',
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

		$criteria->compare('userid',$this->userid);
		$criteria->compare('emailaddress',$this->emailaddress,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('warriorforumusername',$this->warriorforumusername,true);
		$criteria->compare('paypalemailaddress',$this->paypalemailaddress,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}