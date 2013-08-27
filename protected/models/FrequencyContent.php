<?php

/**
 * This is the model class for table "monitor_frequency_content".
 *
 * The followings are the available columns in table 'monitor_frequency_content':
 * @property integer $id
 * @property string $content
 * @property integer $frequency
 * @property integer $column_id
 *
 * The followings are the available model relations:
 * @property TableColumn $column
 */
class FrequencyContent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FrequencyContent the static model class
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
		return 'monitor_frequency_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, column_id', 'required'),
			array('frequency, column_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, content, frequency, column_id', 'safe', 'on'=>'search'),
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
			'column' => array(self::BELONGS_TO, 'TableColumn', 'column_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'content' => 'Content',
			'frequency' => 'Frequency',
			'column_id' => 'Column',
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('frequency',$this->frequency);
		$criteria->compare('column_id',$this->column_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/**
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
	
	 * Update frequency's content of cells.
	 */
	public function updateFrequency($content, $columnId)
    {
		$freq = FrequencyContent::model()->findByAttributes(array('content'=>$content, 'column_id'=>$columnId));
		if($freq)
		{
			$plus = $freq->frequency+1;
			$freq->frequency = $plus;
			$freq->update();
		}
		else
		{
			$newFreq = new FrequencyContent();
			$newFreq->content = $content;
			$newFreq->column_id = $columnId;
			$newFreq->frequency = 1;
			$newFreq->save();
		}
    }
}