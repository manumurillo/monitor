<?php

/**
 * This is the model class for table "monitor_table_column".
 *
 * The followings are the available columns in table 'monitor_table_column':
 * @property integer $id
 * @property integer $table_id
 * @property string $title
 * @property integer $width
 * @property string $color
 * @property integer $position
 * @property integer $autocomplete
 *
 * The followings are the available model relations:
 * @property ReportTableRow[] $monitorReportTableRows
 * @property Table $table
 */
class TableColumn extends CActiveRecord
{
	const NO_AUTOCOMPLETE = 0;
	const AUTOCOMPLETE = 1;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TableColumn the static model class
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
		return 'monitor_table_column';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('table_id, title, width', 'required'),
			array('table_id, width, position, autocomplete', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			array('color', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, table_id, title, width, color, position, autocomplete', 'safe', 'on'=>'search'),
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
			'rows' => array(self::MANY_MANY, 'ReportTableRow', 'monitor_report_table_cell(column_id, row_id)'),
			'table' => array(self::BELONGS_TO, 'Table', 'table_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'table_id' => 'Table',
			'title' => 'Título',
			'width' => 'Anchura',
			'color' => 'Color',
			'position' => 'Posición',
			'autocomplete' => 'Autocompletar',
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
		$criteria->compare('table_id',$this->table_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('width',$this->width);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('autocomplete',$this->autocomplete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getColumnsByTableId($id)
	{
		$criteria=new CDbCriteria(array(
				'condition'=>'t.table_id = :tableId',
				'order'=>'position ASC',
				'params'=>array(
					':tableId'=>$id,
				),
			));
		return self::model()->findAll($criteria);
	}
	
	public function loadModel($id)
	{
		$model=TableColumn::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
}