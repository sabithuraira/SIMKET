<?php

/**
 * This is the model class for table "kegiatan_for_anggaran".
 *
 * The followings are the available columns in table 'kegiatan_for_anggaran':
 * @property integer $id
 * @property integer $id_induk
 * @property integer $tahun
 * @property integer $jenis
 * @property string $keterangan
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 */
class KegiatanForAnggaran extends HelpAR
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan_for_anggaran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_induk, tahun, jenis, keterangan, created_by, created_time, updated_by, updated_time', 'required'),
			array('id_induk, tahun, jenis, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_induk, tahun, jenis, keterangan, created_by, created_time, updated_by, updated_time', 'safe', 'on'=>'search'),
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
			'indukKegiatan' => array(self::BELONGS_TO, 'IndukKegiatan', 'id_induk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_induk' => 'Induk Kegiatan',
			'tahun' => 'Tahun',
			'jenis' => 'Jenis',
			'keterangan' => 'Keterangan',
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
		$criteria->compare('id_induk',$this->id_induk);
		$criteria->compare('tahun',$this->tahun);
		$criteria->compare('jenis',$this->jenis);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_time',$this->updated_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getByKabKota($id_kab_kota){
		$id = $this->id;
		$sql_t = "SELECT 
				COALESCE(SUM(CASE WHEN jenis = 1 THEN jumlah ELSE 0 End),0) AS t1, 
				COALESCE(SUM(CASE WHEN jenis = 2 THEN jumlah ELSE 0 End),0) AS t2, 
				COALESCE(SUM(CASE WHEN jenis = 3 THEN jumlah ELSE 0 End),0) AS t3, 
				COALESCE(SUM(CASE WHEN jenis = 4 THEN jumlah ELSE 0 End),0) AS t4
				FROM `value_anggaran_target` WHERE kegiatan=$id AND unit_kerja=$id_kab_kota";

		$result_t = Yii::app()->db->createCommand($sql_t)->queryRow();


		$sql_r = "SELECT 
				COALESCE(SUM(CASE WHEN jenis = 1 THEN jumlah ELSE 0 End),0) AS r1, 
				COALESCE(SUM(CASE WHEN jenis = 2 THEN jumlah ELSE 0 End),0) AS r2, 
				COALESCE(SUM(CASE WHEN jenis = 3 THEN jumlah ELSE 0 End),0) AS r3, 
				COALESCE(SUM(CASE WHEN jenis = 4 THEN jumlah ELSE 0 End),0) AS r4
				FROM `value_anggaran` WHERE kegiatan=$id AND unit_kerja=$id_kab_kota";

		$result_r = Yii::app()->db->createCommand($sql_r)->queryRow();

		return array_merge($result_t, $result_r);
	}

	public function getDetailByKabKotaAndJenis($id_kab_kota, $id_jenis){
		$id = $this->id;
		$sql = "SELECT * FROM `value_anggaran` 
				WHERE kegiatan=$id AND unit_kerja=$id_kab_kota AND jenis=$id_jenis";
		
		$data = Yii::app()->db->createCommand($sql)->queryAll();

		$str_result = "";

		foreach($data as $value){
			if(HelpMe::isAuthorizeUnitKerja($id_kab_kota)){
				$str_result.=('- [ <a href="#myModal" role="button" class="update_terima" 
					data-id="'.$id.'" 
					data-unitkerja="'.$id_kab_kota.'" 
					data-jenis="'.$id_jenis.'" 
					data-tanggal="'.date("Y-m-d",strtotime($value['tanggal_realisasi'])).'" 
					data-jumlah="'.$value['jumlah'].'"
					data-keterangan="'.$value['keterangan'].'" 
					data-toggle="modal">Update</a> ] '.HelpMe::HrDate($value['tanggal_realisasi']).' <b>Jumlah : '.$value['jumlah'].'</b> ('.$value['keterangan'].')<br/>');
			}
			else
			{
				$str_result.=('- '.HelpMe::HrDate($value['tanggal_realisasi']).' <b>Jumlah : '.$value['jumlah'].'</b> ('.$value['keterangan'].')<br/>');
			}
		}

		return $str_result;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KegiatanForAnggaran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
