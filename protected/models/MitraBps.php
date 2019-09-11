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
	//pendidikan: 1=tidak sekolah/tidak tamat SD,
	//2=SD, 3=SMP, 4=SMA, 5=D3 atau sederajat, 6=S1 atau sederajat, 7=S2 atau S3
	public static function getPendidikanDropdown(){
		return array(
			1=>'Tidak sekolah/tidak tamat SD',
			2=> 'SD',
			3=> 'SMP',
			4=> 'SMA',
			5=> 'D1, D3 atau sederajat',
			6=> 'S1, D4 atau sederajat',
			7=> 'S2 atau S3',
		);
	}

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
			array('foto', 'file', 'types'=>'jpg, png', 'allowEmpty'=>true, 'maxSize'=>1024*100),
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

	public function getFotoImage(){
		// if($this->is_black==1){
		// 	return Yii::app()->baseUrl.'/upload/temp/mitra_foto/black.png';
		// }
		// else{
			if($this->foto!==''){
				return Yii::app()->baseUrl.'/upload/temp/mitra_foto/' . $this->foto;
			}
		// }
		return Yii::app()->theme->baseUrl.'/dist/img/avatar.png';
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
			'unit_kerja_id'	=>	'Seksi/Subbagian',
			'created_time' => 'Created Time',
			'updated_time' => 'Updated Time',
			'created_by' => 'Created By',
			'updated_by' => 'Updated By',
			'riwayat'	=> 'Riwayat Kerja',
			'pendidikan'	=>'Pendidikan Terakhir',
			'foto'	=>'Foto (ukuran maksimal 100kb)',
			'is_black'	=> 'Tandai Sebagai Mitra Hitam?',
			'black_note'	=>'Catatan Mitra',
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
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('is_black',$this->is_black,true);

		if($is_raport){
			$criteria->order = 'nilai_menjadi_mitra DESC, total_menjadi_mitra DESC';
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchRecommended($is_raport=false)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('kab_id',$this->kab_id);
		$criteria->compare('is_black',$this->is_black,true);
		$criteria->addCondition('nilai_menjadi_mitra>=3');

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
		$criteria->compare('kab_id',$this->kab_id);
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
	 * @return MitraBps the static model class
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
		$idnya = $this->id;
		$sql = "SELECT IFNULL(AVG(kmp.nilai),0) as rata, COUNT(kmp.id) as jumlah 
					FROM `kegiatan_mitra_petugas`  kmp, 
						kegiatan_mitra km 
					WHERE kmp.id_mitra='$idnya' AND  
					km.id = kmp.id_kegiatan
					 AND km.is_active=1";

		
		$sql_result = Yii::app()->db->createCommand($sql)->queryRow();	

		$result = array();
		$result['rata'] = $sql_result['rata'];
		$result['jumlah'] = $sql_result['jumlah'];

		$label = "";

		//print_r($result['jumlah']);die();
		
		if($result['rata'] <= 1.65){ $label = "Buruk"; }
		else if($result['rata'] > 1.66 && $result['rata']<= 2.65){  $label = "Cukup"; }
		else if($result['rata'] > 2.66 && $result['rata']<= 3.65){  $label = "Baik"; }
		else if($result['rata'] > 3.65){  $label = "Amat Baik"; }
		
		$result['labelRata'] = $label;

		$this->total_menjadi_mitra = $result['jumlah'];
		$this->nilai_menjadi_mitra = $result['rata'];
		$this->save();

		return $result;
	}


	public function getListKegiatan(){
		$idnya = $this->id;
		$sql = "SELECT kmp.id, km.nama, kmp.status, kmp.nilai 
					FROM kegiatan_mitra_petugas kmp,
					kegiatan_mitra km
					WHERE km.id = kmp.id_kegiatan AND id_mitra = '$idnya' 
					 AND km.is_active='1'";

		return Yii::app()->db->createCommand($sql)->queryAll();
	}

	public function getResumePertanyaan(){
		$idnya = $this->id;

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
					mitra_pertanyaan p, 
					kegiatan_mitra km 
					WHERE 
						m.pertanyaan_id=p.id  AND mitra_id IN (SELECT kmp.id FROM kegiatan_mitra_petugas kmp WHERE id_mitra='$idnya') 
						AND m.kegiatan_id = km.id AND km.is_active = 1
					GROUP BY pertanyaan_id";

		return Yii::app()->db->createCommand($sql)->queryAll();		
	}
}
