<?php

/**
 * This is the model class for table "monitor_report_table_cell".
 *
 * The followings are the available columns in table 'monitor_report_table_cell':
 * @property integer $row_id
 * @property integer $column_id
 * @property string $content
 * @property string $color
 */
class ReportTableCell extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportTableCell the static model class
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
		return 'monitor_report_table_cell';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('row_id, column_id', 'required'),
			array('row_id, column_id', 'numerical', 'integerOnly'=>true),
			array('color', 'length', 'max'=>10),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('row_id, column_id, content, color', 'safe', 'on'=>'search'),
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
			'row_id' => 'Row',
			'column_id' => 'Column',
			'content' => 'Contenido',
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

		$criteria->compare('row_id',$this->row_id);
		$criteria->compare('column_id',$this->column_id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('color',$this->color,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Save a ReportTableCell model in database.
	 * 
	 * @param int $row_id ReportTableRow's id.
	 * @param int $column_id TableRowColumn's id.
	 * @param string $content cell's content.
	 * @param string $color  cell's font color.
	 * 
	 * @return ReportTableCell reportTableCell if was saved.
	 * @return boolean false if wasn't saved.
	 */
	public static function createTableCell($row_id,$column_id,$content,$color){
		$reportTableCell = new ReportTableCell;
		$reportTableCell->row_id = $row_id;
		$reportTableCell->column_id = $column_id;
		$reportTableCell->content = $content;
		$reportTableCell->color = $color;
		if ($reportTableCell->validate()){
			$reportTableCell->save();
			return $reportTableCell;
		}
		return false;
	}
	
	/**
	 * Update a ReportTableCell model in database.
	 * 
	 * @param int $id ReportTableCell's id.
	 * @param int $row_id ReportTableRow's id.
	 * @param int $column_id TableRowColumn's id.
	 * @param string $content cell's content.
	 * @param string $color  cell's font color.
	 * 
	 * @return ReportTableCell reportTableCell if was saved.
	 * @return boolean false if wasn't saved.
	 */
	public static function updateTableCell($id,$row_id,$column_id,$content,$color){
		$reportTableCell = ReportTableCell::model()->findByPk($id);
		$reportTableCell->row_id = $row_id;
		$reportTableCell->column_id = $column_id;
		$reportTableCell->content = $content;
		$reportTableCell->color = $color;
		if ($reportTableCell->validate()){
			$reportTableCell->save();
			return $reportTableCell;
		}
		return false;
	}
	
	// protected function afterSave()
	// {
		// $col = TableColumn::model()->findByPk($this->column_id);
		// if($col->autocomplete == TableColumn::AUTOCOMPLETE)
		// {
			// parent::afterSave();
			// FrequencyContent::model()->updateFrequency(strip_tags($this->content), $this->column_id);
		// }
	// }
	
	protected function afterSave()
	{
			parent::afterSave();
			FrequencyContent::model()->updateFrequency(strip_tags($this->content), $this->column_id);
	}
}
