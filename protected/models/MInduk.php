<?php

/**
 * This is the model class for table "m_induk".
 *
 * The followings are the available columns in table 'm_induk':
 * @property integer $id
 * @property string $label
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 *
 * The followings are the available model relations:
 * @property MOutput[] $mOutputs
 * @property PaguSatker[] $paguSatkers
 */
class MInduk extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'm_induk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_by, created_time, updated_by, updated_time', 'required'),
			array('created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('label', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, label, created_by, created_time, updated_by, updated_time', 'safe', 'on'=>'search'),
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
			'mOutputs' => array(self::HAS_MANY, 'MOutput', 'm_induk'),
			'paguSatkers' => array(self::HAS_MANY, 'PaguSatker', 'm_induk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'label' => 'Label',
			'created_by' => 'Created By',
			'created_time' => 'Created Time',
			'updated_by' => 'Updated By',
			'updated_time' => 'Updated Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_time',$this->updated_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MInduk the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function MyPagu($tahun){
		$sql="SELECT SUM(jumlah) FROM pagu WHERE 
			m_output IN (SELECT id FROM m_output WHERE m_induk={$this->id} AND parent IS NULL) 
			AND tahun={$tahun} AND unit_kerja IN(SELECT id FROM unit_kerja where parent=1 AND jenis=1)";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}
	
	public function MyPaguRevisi($tahun){
		$sql="SELECT SUM(revisi) FROM pagu WHERE 
			m_output IN (SELECT id FROM m_output WHERE m_induk={$this->id} AND parent IS NULL) 
			AND tahun={$tahun} AND unit_kerja IN(SELECT id FROM unit_kerja where parent=1 AND jenis=1)";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}
	
	public function MyPaguRealisasi($tahun,$tw){
		$sql="SELECT SUM(tw$tw) FROM pagu WHERE 
			m_output IN (SELECT id FROM m_output WHERE m_induk={$this->id} AND parent IS NULL) 
			AND tahun={$tahun} AND unit_kerja IN(SELECT id FROM unit_kerja where parent=1 AND jenis=1)";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public function PaguSatker($tahun,$kode){
		$sql="SELECT SUM(jumlah) FROM pagu WHERE 
			m_output IN (SELECT id FROM m_output WHERE m_induk={$this->id} AND parent IS NULL) 
			AND tahun={$tahun} AND unit_kerja IN(SELECT id FROM unit_kerja where code={$kode})";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}
}
