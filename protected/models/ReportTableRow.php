<?php

/**
 * This is the model class for table "monitor_report_table_row".
 *
 * The followings are the available columns in table 'monitor_report_table_row':
 * @property integer $id
 * @property integer $rtable_id
 * @property integer $position
 * @property string $color
 *
 * The followings are the available model relations:
 * @property ReportTableColumn[] $monitorReportTableColumns
 * @property ReportTableRow $rtable
 * @property ReportTableRow[] $reportTableRows
 */
class ReportTableRow extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportTableRow the static model class
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
		return 'monitor_report_table_row';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rtable_id, position', 'required'),
			array('rtable_id, position', 'numerical', 'integerOnly'=>true),
			array('color', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, rtable_id, position, color', 'safe', 'on'=>'search'),
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
			'cells' => array(self::MANY_MANY, 'ReportTableColumn', 'monitor_report_table_cell(row_id, column_id)','order' => 'cells.position ASC'),
			'rTable' => array(self::BELONGS_TO, 'ReportTable', 'rtable_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'rtable_id' => 'ReportTable ID',
			'position' => 'Posición',
			'color' => 'Color',
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
		$criteria->compare('rtable_id',$this->rtable_id);
		$criteria->compare('position',$this->position);
		$criteria->compare('color',$this->color,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Save a ReportTableRow model in database.
	 * 
	 * @param int $rtable_id ReportTable's id.
	 * @param int $position row's position in table.
	 * @param string $color  color's font in hexadecimal.
	 * 
	 * @return ReportTableRow reportTableRow if was saved.
	 * @return boolean false if wasn't saved.
	 */
	public static function createTableRow($rtable_id,$position,$color){
		$ReportTableRow = new ReportTableRow;
		$ReportTableRow->rtable_id = $rtable_id;
		$ReportTableRow->position = $position;
		$ReportTableRow->color = $color;
		if ($ReportTableRow->validate()){
			$ReportTableRow->save();
			return $ReportTableRow;
		}
		return false;
	}
	
	/**
	 * Update a ReportTableRow model in database.
	 * 
	 * @param int $id ReportTableRow's id.
	 * @param int $rtable_id ReportTable's id.
	 * @param int $position row's position in table.
	 * @param string $color  color's font in hexadecimal.
	 * 
	 * @return ReportTableRow reportTableRow if was saved.
	 * @return boolean false if wasn't saved.
	 */
	public static function updateTableRow($id,$rtable_id,$position,$color){
		$ReportTableRow = ReportTableRow::model()->findByPk($id);
		$ReportTableRow->rtable_id = $rtable_id;
		$ReportTableRow->position = $position;
		$ReportTableRow->color = $color;
		if ($ReportTableRow->validate()){
			$ReportTableRow->update();
			return $ReportTableRow;
		}
		return false;
	}
}
