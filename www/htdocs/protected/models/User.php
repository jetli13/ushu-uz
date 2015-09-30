<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $nick
 * @property string $name
 * @property string $lastName
 * @property string $email
 * @property string $password
 * @property string $originalPassword
 * @property integer $role
 *
 * The followings are the available model relations:
 * @property Role[] $roles
 * @property Video[] $videos
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role', 'numerical', 'integerOnly'=>true),
			array('nick, name, lastName, email', 'length', 'max'=>50),
			array('name, lastName', 'length', 'encoding'=>'utf-8'),
			array('password', 'length', 'max'=>32),
			array('originalPassword', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nick, name, lastName, email, password, originalPassword, role', 'safe', 'on'=>'search'),
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
			'roles' => array(self::MANY_MANY, 'Role', 'link_user_role(user_id, role_id)'),
			'videos' => array(self::HAS_MANY, 'Video', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nick' => 'Nick',
			'name' => 'Name',
			'lastName' => 'Last Name',
			'email' => 'Email',
			'password' => 'Password',
			'originalPassword' => 'Original Password',
			'role' => 'Role',
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
		$criteria->compare('nick',$this->nick,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('originalPassword',$this->originalPassword,true);
		$criteria->compare('role',$this->role);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}