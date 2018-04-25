<?php

/**
 * This is the model class for table "kegiatan_mitra_wilayah".
 *
 * The followings are the available columns in table 'kegiatan_mitra_wilayah':
 * @property integer $id
 * @property integer $kmp_id
 * @property integer $kegiatan_id
 * @property integer $mitra_id
 * @property string $nks
 * @property string $bs
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 */
class KegiatanMitraWilayah extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan_mitra_wilayah';
	}

	public function beforeDelete()
    {   
		$id_wil = $this->id;
		$sql = "DELETE FROM mitra_nilai WHERE wilayah_id=$id_wil";
		Yii::app()->db->createCommand($sql)->execute();

        return parent::beforeDelete();
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kmp_id, kegiatan_id, mitra_id, nks, bs, created_by, created_time, updated_by, updated_time', 'required'),
			array('kmp_id, kegiatan_id, mitra_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('nks', 'length', 'max'=>255),
			array('bs', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kmp_id, kegiatan_id, mitra_id, nks, bs, created_by, created_time, updated_by, updated_time', 'safe', 'on'=>'search'),
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
			'kmp_id' => 'Kmp',
			'kegiatan_id' => 'Kegiatan',
			'mitra_id' => 'Mitra',
			'nks' => 'Nks',
			'bs' => 'Bs',
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
		$criteria->compare('kmp_id',$this->kmp_id);
		$criteria->compare('kegiatan_id',$this->kegiatan_id);
		$criteria->compare('mitra_id',$this->mitra_id);
		$criteria->compare('nks',$this->nks,true);
		$criteria->compare('bs',$this->bs,true);
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
	 * @return KegiatanMitraWilayah the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
