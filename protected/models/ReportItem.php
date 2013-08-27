<?php

/**
 * This is the model class for table "monitor_report_item".
 *
 * The followings are the available columns in table 'monitor_report_item':
 * @property integer $id
 * @property integer $report_id
 * @property integer $position
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property Report $report
 * @property ReportTable[] $reportTables
 * @property ReportText[] $reportTexts
 */
class ReportItem extends CActiveRecord
{

	const TYPE_TABLE = 0;
	const TYPE_TEXT = 1;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportItem the static model class
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
		return 'monitor_report_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('report_id, type', 'required'),
			array('report_id, position, type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, report_id, position, type', 'safe', 'on'=>'search'),
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
			'report' => array(self::BELONGS_TO, 'Report', 'report_id'),
			'reportTable' => array(self::HAS_ONE, 'ReportTable', 'item_id'),
			'text' => array(self::HAS_ONE, 'ReportText', 'item_id'),
			'textsCount' => array(self::STAT, 'ReportText','item_id'),
			'reportTablesCount' => array(self::STAT, 'ReportTable','item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'report_id' => 'Reporte ID',
			'position' => 'Posición',
			'type' => 'Tipo',
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
		$criteria->compare('report_id',$this->report_id);
		$criteria->compare('position',$this->position);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Returns a descriptive string about Item's type
	 * @param int $type Item's type 
	 * @return string type descriptive string.
	 */
	public function viewTextType($type)
    {
	if ($type==0) 
			return 'Tabla'; 
		else if ($type==1) 
			return 'Texto';
		else 
			return 'No especificado';
	}
	
	/**
	 * Save a ReportItem model in database.
	 * 
	 * @param int $report_id Report's id.
	 * @param int $position  ReportItem's position.
	 * @param int $type ReportItem's type.
	 * 
	 * @return ReportItem reportItem if was saved.
	 * @return boolean false if wasn't saved.
	 */
	 
	public static function createItem($reportId,$position,$type){
		$reportItem = new ReportItem;
		$reportItem->report_id = $reportId;
		$reportItem->type = $type;
		$reportItem->position = $position;
		if ($reportItem->validate())
		{
			$reportItem->save();
			return $reportItem;
		}
		return false;
	}
	
	/**
	 * Update a ReportItem model in database.
	 * 
	 * @param int $id ReportItem's id.
	 * @param int $report_id Report's id.
	 * @param int $position  ReportItem's position.
	 * @param int $type ReportItem's type.
	 * 
	 * @return ReportItem reportItem if was saved.
	 * @return boolean false if wasn't saved.
	 */
	 
	public static function updateItem($id, $reportId,$position,$type){
		$reportItem = ReportItem::model()->findByPk($id);
		$reportItem->report_id = $reportId;
		$reportItem->type = $type;
		$reportItem->position = $position;
		if ($reportItem->validate())
		{
			$reportItem->update();
			return $reportItem;
		}
		return false;
	}
	
}
