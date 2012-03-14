<?php

/**
 * This is the model class for table "publication".
 *
 * The followings are the available columns in table 'publication':
 * @property integer $id
 * @property string $ru_title
 * @property string $en_title
 * @property string $author
 * @property string $ru_text
 * @property string $en_text
 * @property string $outerLink
 * @property string $creationDate
 * @property string $image
 */
class Publication extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Publication the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public static function getPreview($text, $limit) { // @todo вообще исть инфа в модели о картинке которая должна быть превью, нужно использовать ее
		$imageReg = '/<img[^>]*>/i';
		$srcPattern = '/\/([a-f\d]{32})\./i';
		//$srcReplace = '/128/thumb_$1.';

		
		preg_match($imageReg, $text, $result);
		$text = strip_tags( preg_replace($imageReg, '', $text) );
		
		$TEXT_LIMIT = $limit;
		$text = mb_substr($text, 0, $TEXT_LIMIT) . '...';
		//$text = CHtml::encode($text);
		
		$img = $result[0];
		preg_match($srcPattern, $img, $result);
		
		$src = $result[1];
		
		return '<img src="/upload/photo/publication/128/thumb_' . $src . '.jpg" class="preview" />' . $text;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'publication';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ru_title, ru_text', 'required'),
			array('ru_title, en_title, outerLink', 'length', 'max'=>255),
			array('author', 'length', 'max'=>50),
			array('image', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ru_title, en_title, author, ru_text, en_text, outerLink, creationDate, image', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'ru_title' => 'Название',
			'en_title' => 'Title',
			'author' => 'Author',
			'ru_text' => 'Текст',
			'en_text' => 'Text',
			'outerLink' => 'Ссылка на оригинал',
			'creationDate' => 'Creation Date',
			'image' => 'Фото',
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
		$criteria->compare('author',$this->author,true);
		$criteria->compare('ru_text',$this->ru_text,true);
		$criteria->compare('en_text',$this->en_text,true);
		$criteria->compare('outerLink',$this->outerLink,true);
		$criteria->compare('creationDate',$this->creationDate,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}