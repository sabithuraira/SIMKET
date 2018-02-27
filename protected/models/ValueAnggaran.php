<?php

/**
 * This is the model class for table "value_anggaran".
 *
 * The followings are the available columns in table 'value_anggaran':
 * @property integer $id
 * @property integer $unit_kerja
 * @property integer $kegiatan
 * @property string $tanggal_realisasi
 * @property string $jumlah
 * @property string $created_time
 * @property integer $created_by
 * @property string $updated_time
 * @property integer $updated_by
 * @property string $keterangan
 */
class ValueAnggaran extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'value_anggaran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_kerja, kegiatan, tanggal_realisasi, jumlah, created_time, created_by, updated_time, updated_by', 'required'),
			array('unit_kerja, kegiatan, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('keterangan', 'length', 'max'=>255),
			array('jumlah', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, unit_kerja, kegiatan, tanggal_realisasi, jumlah, created_time, created_by, updated_time, updated_by, keterangan', 'safe', 'on'=>'search'),
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
			'unit_kerja' => 'Unit Kerja',
			'kegiatan' => 'Kegiatan',
			'jenis' => 'Rincian',
			'tanggal_realisasi' => 'Tanggal Realisasi',
			'jumlah' => 'Jumlah',
			'created_time' => 'Created Time',
			'created_by' => 'Created By',
			'updated_time' => 'Updated Time',
			'updated_by' => 'Updated By',
			'keterangan' => 'Keterangan',
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
		$criteria->compare('unit_kerja',$this->unit_kerja);
		$criteria->compare('kegiatan',$this->kegiatan);
		$criteria->compare('jenis',$this->jenis,true);
		$criteria->compare('tanggal_realisasi',$this->tanggal_realisasi,true);
		$criteria->compare('jumlah',$this->jumlah,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('keterangan',$this->keterangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ValueAnggaran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
