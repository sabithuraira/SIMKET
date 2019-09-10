<?php

/**
 * This is the model class for table "pegawai".
 *
 * The followings are the available columns in table 'pegawai':
 * @property string $nip
 * @property string $nama
 * @property integer $unit_kerja
 * @property integer $unit_kerja_kab
 * @property string $golongan
 * @property string $jabatan
 * @property string $created_time
 * @property string $updated_time
 */
class Pegawai extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pegawai';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nip, nama, unit_kerja, golongan, jabatan, created_time, updated_time', 'required'),
			array('unit_kerja', 'numerical', 'integerOnly'=>true),
			array('nip', 'length', 'max'=>18),
			array('nama, golongan, jabatan', 'length', 'max'=>255),
			array('foto', 'file', 'types'=>'jpg, png', 'allowEmpty'=>true, 'maxSize'=>1024*100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('nip, nama, unit_kerja, unit_kerja_kab, golongan, jabatan, created_time, updated_time', 'safe', 'on'=>'search'),
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
			'unitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja'),
		);
	}

	public function getFotoImage(){
		if($this->foto!==''){
			return Yii::app()->baseUrl.'/upload/temp/pegawai/' . $this->foto;
		}
		return Yii::app()->theme->baseUrl.'/dist/img/avatar.png';
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nip' => 'NIP',
			'nama' => 'Nama',
			'unit_kerja' => 'Unit Kerja',
			'unit_kerja_kab' => 'Jabatan Struktural',
			'golongan' => 'Golongan',
			'jabatan' => 'Jabatan',
			'created_time' => 'Created Time',
			'updated_time' => 'Updated Time',
			'foto'	=>'Foto (ukuran maksimal 100kb)',
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
	public function search($is_raport=false)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('unit_kerja',$this->unit_kerja);
		$criteria->compare('unit_kerja_kab',$this->unit_kerja_kab);
		$criteria->compare('golongan',$this->golongan,true);
		$criteria->compare('jabatan',$this->jabatan,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('is_active',$this->is_active,true);

		if($is_raport){
			$criteria->order = 'nilai_menjadi_mitra DESC, total_menjadi_mitra DESC';
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchAll($is_raport=false)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('unit_kerja',$this->unit_kerja);
		$criteria->compare('is_active',$this->is_active,true);

		if($is_raport){
			$criteria->order = 'nilai_menjadi_mitra DESC, total_menjadi_mitra DESC';
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'totalItemCount'=>$this->count(),
			'pagination'=>array(
				'pageSize'=>$this->count(),
			 ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pegawai the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getPredikatLabel(){
		if($this->total_menjadi_mitra>0){
			if($this->nilai_menjadi_mitra <= 1.65){ 
				return "Buruk";
			}
			else if($this->nilai_menjadi_mitra > 1.66 && $this->nilai_menjadi_mitra<= 2.65){  
				return "Cukup"; 
			}
			else if($this->nilai_menjadi_mitra > 2.66 && $this->nilai_menjadi_mitra<= 3.65){  
				return "Baik";
			}
			else if($this->nilai_menjadi_mitra > 3.65){  
				return "Amat Baik";
			}
		}
		else{
			return "-";
		}
	}

	public function getNilaiAndJumlah(){
		$idnya = $this->nip;
		$sql = "SELECT IFNULL(AVG(nilai),0) as rata, COUNT(id) as jumlah 
					FROM `kegiatan_mitra_petugas` kmp, 
						kegiatan_mitra km 
					WHERE kmp.id_mitra='$idnya' AND 
						km.id = kmp.id_kegiatan
						AND km.is_active=1";

		
		$sql_result = Yii::app()->db->createCommand($sql)->queryRow();	

		$result = array();
		$result['rata'] = $sql_result['rata'];
		$result['jumlah'] = $sql_result['jumlah'];

		$label = "";
		$strata = 1;

		// print_r($result['jumlah']);die();
		
		if($result['rata'] <= 1.65){ 
			$label = "Buruk"; 
			$strata = 1;
		}
		else if($result['rata'] > 1.66 && $result['rata']<= 2.65){  
			$label = "Cukup"; 
			$strata = 2;
		}
		else if($result['rata'] > 2.66 && $result['rata']<= 3.65){  
			$label = "Baik"; 
			$strata = 3;
		}
		else if($result['rata'] > 3.65){  
			$label = "Amat Baik"; 
			$strata = 4;
		}

		$result['labelRata'] = $label;
		$result['strata'] = $strata;

		return $result;
	}

	public function getListKegiatan(){
		$idnya = $this->nip;
		$sql = "SELECT kmp.id, km.nama, kmp.status, kmp.nilai 
					FROM kegiatan_mitra_petugas kmp,
					kegiatan_mitra km
					WHERE km.id = kmp.id_kegiatan AND id_mitra = '$idnya' 
					AND km.is_active=1";

		return Yii::app()->db->createCommand($sql)->queryAll();
	}

	public function getResumePertanyaan(){
		$idnya = $this->nip;

		$sql = "SELECT AVG(nilai) as rata,  
					SUM(if(m.nilai = 1, 1, 0)) AS jumlah1,
					SUM(if(m.nilai = 2, 1, 0)) AS jumlah2,
					SUM(if(m.nilai = 3, 1, 0)) AS jumlah3,
					SUM(if(m.nilai = 4, 1, 0)) AS jumlah4,  
					pertanyaan_id, p.pertanyaan ,
					(SELECT o.description FROM mitra_option o WHERE o.id_pertanyaan=pertanyaan_id AND o.skala=1 LIMIT 1) as opt1,
					(SELECT o.description FROM mitra_option o WHERE o.id_pertanyaan=pertanyaan_id AND o.skala=2 LIMIT 1) as opt2,
					(SELECT o.description FROM mitra_option o WHERE o.id_pertanyaan=pertanyaan_id AND o.skala=3 LIMIT 1) as opt3,
					(SELECT o.description FROM mitra_option o WHERE o.id_pertanyaan=pertanyaan_id AND o.skala=4 LIMIT 1) as opt4
					
					FROM `mitra_nilai` m, 
					mitra_pertanyaan p
					WHERE 
						m.pertanyaan_id=p.id  AND mitra_id IN (SELECT id FROM kegiatan_mitra_petugas WHERE id_mitra='$idnya') 
					GROUP BY pertanyaan_id";

		return Yii::app()->db->createCommand($sql)->queryAll();		
	}
}
