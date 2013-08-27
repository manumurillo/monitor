<?php

/**
 * This is the model class for table "monitor_report_text".
 *
 * The followings are the available columns in table 'monitor_report_text':
 * @property integer $id
 * @property integer $item_id
 * @property string $text
 * @property integer $rtable_id
 *
 * The followings are the available model relations:
 * @property ReportItem $item
 * @property ReportTable $rtable
 */
class ReportText extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportText the static model class
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
		return 'monitor_report_text';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, rtable_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_id, text, rtable_id', 'safe', 'on'=>'search'),
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
			'item' => array(self::BELONGS_TO, 'ReportItem', 'item_id'),
			'rtable' => array(self::BELONGS_TO, 'ReportTable', 'rtable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_id' => 'Item ID',
			'text' => 'Texto',
			'rtable_id' => 'ReportTable ID',
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
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('rtable_id',$this->rtable_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Save a ReportText model in database.
	 * 
	 * @param int $itemId ReportItem's id.
	 * @param string $text  ReportText's text.
	 * 
	 * @return ReportText reportItemText if was saved.
	 * @return boolean false if wasn't saved.
	 */
	 
	public static function createItemText($itemId,$text){
		$reportItemText = new ReportText;
		$reportItemText->item_id = $itemId;
		$reportItemText->text = $text;
		if ($reportItemText->save())
		{
			return $reportItemText;
		}
		return false;
	}
	
	/**
	 * Update a ReportText model in database.
	 * 
	 * @param int $id ReportText's id.
	 * @param int $itemId ReportItem's id.
	 * @param string $text  ReportText's text.
	 * 
	 * @return ReportText reportItemText if was saved.
	 * @return boolean false if wasn't saved.
	 */
	 
	public static function updateItemText($id,$itemId,$text){
		$reportItemText = ReportText::model()->findByPk($id);
		$reportItemText->item_id = $itemId;
		$reportItemText->text = $text;
		if ($reportItemText->update())
		{
			return $reportItemText;
		}
		return false;
	}
	
	
	/**
	 * Save a ReportText belonging to a ReportTable model in database.
	 * 
	 * @param int $rTableId ReportTable's id.
	 * @param string $text  ReportText's text.
	 * 
	 * @return ReportText reportTableText if was saved.
	 * @return boolean false if wasn't saved.
	 */
	 
	public static function createTableText($rTableId,$text){
		$reportTableText = new ReportText;
		$reportTableText->rtable_id = $rTableId;
		$reportTableText->text = $text;
		if ($reportTableText->save())
		{
			return $reportTableText;
		}
		return false;
	}
	
	/**
	 * Update a ReportText belonging to a ReportTable model in database.
	 * 
	 * @param int $id ReportText's id.
	 * @param int $rTableId ReportTable's id.
	 * @param string $text  ReportText's text.
	 * 
	 * @return ReportText reportTableText if was saved.
	 * @return boolean false if wasn't saved.
	 */
	 
	public static function updateTableText($id,$rTableId,$text){
		$reportTableText = ReportText::model()->findByPk($id);
		$reportTableText->rtable_id = $rTableId;
		$reportTableText->text = $text;
		if ($reportTableText->update())
		{
			return $reportTableText;
		}
		return false;
	}
}
