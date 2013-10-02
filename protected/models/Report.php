<?php

/**
 * This is the model class for table "monitor_report".
 *
 * The followings are the available columns in table 'monitor_report':
 * @property integer $id
 * @property string $title
 * @property integer $status
 * @property integer $date_created
 * @property integer $date_update
 *
 * The followings are the available model relations:
 * @property ReportItem[] $reportItems
 */
class Report extends CActiveRecord
{
	const STATUS_DRAFT = 1;
    const STATUS_PUBLISHED = 2;
    const STATUS_ARCHIVED = 3;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Report the static model class
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
		return 'monitor_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, status', 'required'),
			array('status', 'in', 'range'=>array(1,2,3)),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, status, date_created, date_update', 'safe', 'on'=>'search'),
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
			'items' => array(self::HAS_MANY, 'ReportItem', 'report_id',
							'order' => 'items.position ASC'),
			'itemCount' => array(self::STAT, 'ReportItem','report_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Título',
			'status' => 'Estado',
			'date_created' => 'Fecha de creación',
			'date_update' => 'Última actualización',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_created',$this->date_created);
		$criteria->compare('date_update',$this->date_update);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Beautify url
	 */
	public function getUrl()
    {
        return Yii::app()->createUrl('report/view', array(
            'id'=>$this->id,
            'title'=>$this->title,
        ));
    }
	
	/**
	 * Fill date_created and date update before save/update a specific model.
	 * @return boolean true if fields were asigned correctly.
	 */
	protected function beforeSave()
	{
		if($this->isNewRecord)
		{
			$this->date_created=$this->date_update=time();
		}
		else{
			$this->date_update=time();
		}
		return true;
	}
	
	/**
	* Delete all relations belong Report after of deleted it.
	*/
	 
	protected function afterDelete()
	{
		parent::afterDelete();
		ReportItem::model()->deleteAll('report_id='.$this->id);
	}
	
	/**
	 * Returns a descriptive string about Report's status
	 * @param int $status Report's status 
	 * @return string status text in a descriptive string.
	 */
	public function viewTextStatus($status)
    {
	if ($status==1) 
			return 'Borrador'; 
		else if ($status==2) 
			return 'Publicado';
		else if ($status==3) 
			return 'Archivado';
		else 
			return 'No especificado';
	}
	
	public function generarCodigo($longitud){
		$key='';
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
		$max=strlen($pattern)-1;
		
		for($i=0;$i<$longitud;$i++)
			$key.=$pattern{mt_rand(0,$max)};
		return $key;
	}
}
