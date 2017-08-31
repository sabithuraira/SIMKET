<?php

/**
 * This is the model class for table "value_kegiatan".
 *
 * The followings are the available columns in table 'value_kegiatan':
 * @property integer $id
 * @property integer $unit_kerja
 * @property integer $kegiatan
 * @property string $seri_kegiatan
 * @property string $tanggal_pengumpulan
 * @property integer $jumlah
 * @property string $created_time
 * @property integer $created_by
 * @property string $updated_time
 * @property integer $updated_by
 * @property integer $jenis
 * @property string $ketarangan
 *
 * The followings are the available model relations:
 * @property Kegiatan $kegiatan0
 * @property UnitKerja $unitKerja
 */
class ValueKegiatan extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'value_kegiatan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_kerja, kegiatan, tanggal_pengumpulan, jumlah, created_time, created_by, updated_time, updated_by', 'required'),
			array('unit_kerja, kegiatan, jumlah, created_by, updated_by, jenis', 'numerical', 'integerOnly'=>true),
			array('seri_kegiatan, ketarangan', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, unit_kerja, kegiatan, seri_kegiatan, tanggal_pengumpulan, jumlah, created_time, created_by, updated_time, updated_by, jenis, ketarangan', 'safe', 'on'=>'search'),
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
			'kegiatan0' => array(self::BELONGS_TO, 'Kegiatan', 'kegiatan'),
			'unitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja'),
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
			'seri_kegiatan' => 'Seri Kegiatan',
			'tanggal_pengumpulan' => 'Tanggal Pengumpulan',
			'jumlah' => 'Jumlah',
			'created_time' => 'Created Time',
			'created_by' => 'Created By',
			'updated_time' => 'Updated Time',
			'updated_by' => 'Updated By',
			'jenis' => 'Jenis',
			'ketarangan' => 'Ketarangan',
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
		$criteria->compare('seri_kegiatan',$this->seri_kegiatan,true);
		$criteria->compare('tanggal_pengumpulan',$this->tanggal_pengumpulan,true);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('jenis',$this->jenis);
		$criteria->compare('ketarangan',$this->ketarangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ValueKegiatan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
