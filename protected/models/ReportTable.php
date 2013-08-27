<?php

/**
 * This is the model class for table "monitor_report_table".
 *
 * The followings are the available columns in table 'monitor_report_table':
 * @property integer $id
 * @property integer $item_id
 * @property integer $table_id
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property ReportItem $item
 * @property Table $table
 * @property ReportTableRow[] $reportTableRows
 * @property ReportText[] $reportTexts
 */
class ReportTable extends CActiveRecord
{
	const STATUS_DISABLED = 0;
	const STATUS_ACTIVE = 1;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportTable the static model class
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
		return 'monitor_report_table';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, table_id', 'required'),
			array('item_id, table_id, status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_id, table_id, status', 'safe', 'on'=>'search'),
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
			'table' => array(self::BELONGS_TO, 'Table', 'table_id'),
			'rows' => array(self::HAS_MANY, 'ReportTableRow', 'rtable_id', 'order' => 'rows.position ASC'),
			'texts' => array(self::HAS_MANY, 'ReportText', 'rtable_id'),
			'rowsCount' => array(self::STAT, 'ReportTableRow','rtable_id'),
			'textsCount' => array(self::STAT, 'ReportText', 'rtable_id'),
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
			'table_id' => 'Tabla',
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
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('table_id',$this->table_id);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Save a ReportTable model in database.
	 * 
	 * @param int $itemId ReportItem's id.
	 * @param int $tableId Table's id.
	 * @param int $status  ReportTable's status.
	 * 
	 * @return ReportTable reportTable if was saved.
	 * @return boolean false if wasn't saved.
	 */
	public static function createReportTable($itemId,$tableId,$status){
		$reportTable = new ReportTable;
		$reportTable->item_id = $itemId;
		$reportTable->table_id = $tableId;
		$reportTable->status = $status;
		if ($reportTable->validate()){
			$reportTable->save();
			return $reportTable;
		}
		return false;
	}
	
	/**
	 * Update a ReportTable model in database.
	 * 
	 * @param int $id ReportTable's id.
	 * @param int $itemId ReportItem's id.
	 * @param int $tableId Table's id.
	 * @param int $status  ReportTable's status.
	 * 
	 * @return ReportTable reportTable if was saved.
	 * @return boolean false if wasn't saved.
	 */
	public static function updateReportTable($id,$itemId,$tableId,$status){
		$reportTable = ReportTable::model()->findByPk($id);
		$reportTable->item_id = $itemId;
		$reportTable->table_id = $tableId;
		$reportTable->status = $status;
		if ($reportTable->validate())
		{
			$reportTable->update();
			return $reportTable;
		}
		return false;
	}
}
