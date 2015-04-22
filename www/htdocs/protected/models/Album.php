<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property integer $id
 * @property string $ru_title
 * @property string $en_title
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Photo[] $photos
 */
class Album extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Album the static model class
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
		return 'album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ru_title', 'required'),
			array('ru_title, en_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ru_title, en_title, date', 'safe', 'on'=>'search'),
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
			'photos' => array(self::MANY_MANY, 'Photo', 'link_album_photo(albumId, photoId)'),
		);
	}
	
	protected function beforeDelete() {
		parent::beforeDelete();
		
		$command = Yii::app()->db->createCommand();
		// строим и выполняем следующий SQL:
		// INSERT INTO `tbl_user` (`name`, `email`) VALUES (:name, :email)
		$command->delete(
							'link_album_photo', 
							'albumId=:albumId',
							array(
								'albumId' => $this->id
							)
						);
		
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ru_title' => 'Название альбома',
			'en_title' => 'En Title',
			'date' => 'Date',
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
		$criteria->compare('ru_title',$this->ru_title,true);
		$criteria->compare('en_title',$this->en_title,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTitle() {
		return $this->ru_title; //todo localize
	}
}