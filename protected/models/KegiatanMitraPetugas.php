<?php

/**
 * This is the model class for table "kegiatan_mitra_petugas".
 *
 * The followings are the available columns in table 'kegiatan_mitra_petugas':
 * @property integer $id
 * @property integer $id_kegiatan
 * @property integer $flag_mitra
 * @property integer $id_mitra
 * @property integer $status
 * @property double $nilai
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 */
class KegiatanMitraPetugas extends HelpAr
{
	//flag mitra 1 = pegawai, 2= mitra
	//status 1 = PML, 2 = PCL


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan_mitra_petugas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_kegiatan, flag_mitra, id_mitra, status, nilai, created_by, created_time, updated_by, updated_time', 'required'),
			array('id_kegiatan, flag_mitra, id_mitra, status, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('nilai', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_kegiatan, flag_mitra, id_mitra, status, nilai, created_by, created_time, updated_by, updated_time', 'safe', 'on'=>'search'),
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
			'pegawai' => array(self::BELONGS_TO, 'Pegawai', 'id_mitra'),
			'mitra' => array(self::BELONGS_TO, 'MitraBps', 'id_mitra'),
		);
	}

	public function getNamaMitra(){
		$str = "";
		if($this->flag_mitra==1){
			$petugas = Pegawai::model()->findByPk($this->id_mitra);
			if($petugas!==null)
				$str = $petugas->nama;
		}
		else{
			$petugas = MitraBps::model()->findByPk($this->id_mitra);
			if($petugas!==null)
				$str = $petugas->nama;
		}

		return $str;
	}

	public function getStatusLabel(){
		if($this->status==1)
			return 'PML';
		else
			return 'PCL';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_kegiatan' => 'Id Kegiatan',
			'flag_mitra' => 'Flag Mitra',
			'id_mitra' => 'Id Mitra',
			'status' => 'Status',
			'nilai' => 'Nilai',
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
		$criteria->compare('id_kegiatan',$this->id_kegiatan);
		$criteria->compare('flag_mitra',$this->flag_mitra);
		$criteria->compare('id_mitra',$this->id_mitra);
		$criteria->compare('status',$this->status);
		$criteria->compare('nilai',$this->nilai);
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
	 * @return KegiatanMitraPetugas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
