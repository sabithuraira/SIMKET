<?php

/**
 * This is the model class for table "mitra_bps".
 *
 * The followings are the available columns in table 'mitra_bps':
 * @property integer $id
 * @property string $nama
 * @property string $nomor_telepon
 * @property string $alamat
 * @property string $tanggal_lahir
 * @property integer $jk
 * @property string $created_time
 * @property string $updated_time
 * @property integer $created_by
 * @property string $updated_by
 */
class MitraBps extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mitra_bps';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, kab_id, nomor_telepon, jk, created_time, updated_time, created_by, updated_by', 'required'),
			array('jk, kab_id, created_by', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>255),
			array('nomor_telepon', 'length', 'max'=>15),
			array('alamat, tanggal_lahir', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, nomor_telepon, alamat, tanggal_lahir, jk, created_time, updated_time, created_by, updated_by', 'safe', 'on'=>'search'),
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
			'kabupaten' => array(self::BELONGS_TO, 'UnitKerja', 'kab_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama' => 'Nama',
			'kab_id' => 'Kabupaten',
			'nomor_telepon' => 'Nomor Telepon',
			'alamat' => 'Alamat',
			'tanggal_lahir' => 'Tanggal Lahir',
			'jk' => 'Jenis Kelamin',
			'created_time' => 'Created Time',
			'updated_time' => 'Updated Time',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('kab_id',$this->kab_id);
		$criteria->compare('nomor_telepon',$this->nomor_telepon,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('tanggal_lahir',$this->tanggal_lahir,true);
		$criteria->compare('jk',$this->jk);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_by',$this->updated_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MitraBps the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}