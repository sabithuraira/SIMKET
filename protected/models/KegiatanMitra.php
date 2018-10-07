<?php

/**
 * This is the model class for table "kegiatan_mitra".
 *
 * The followings are the available columns in table 'kegiatan_mitra':
 * @property integer $id
 * @property integer $induk_id
 * @property string $nama
 * @property integer $simket_id
 * @property integer $kab_id
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 */
class KegiatanMitra extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan_mitra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('induk_id, nama, kab_id, created_by, created_time, updated_by, updated_time', 'required'),
			array('induk_id, simket_id, kab_id, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, induk_id, nama, simket_id, kab_id, created_by, created_time, updated_by, updated_time', 'safe', 'on'=>'search'),
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
			'induk' => array(self::BELONGS_TO, 'IndukKegiatan', 'induk_id'),
			'simket' => array(self::BELONGS_TO, 'Kegiatan', 'simket_id'),
			'kab' => array(self::BELONGS_TO, 'UnitKerja', 'kab_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'induk_id' => 'Induk Kegiatan',
			'nama' => 'Nama',
			'simket_id' => 'Kegiatan SIMKET (jika ada)',
			'kab_id' => 'Kabupaten/Kota',
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
		$criteria->compare('induk_id',$this->induk_id);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('simket_id',$this->simket_id);
		$criteria->compare('kab_id',$this->kab_id);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function listMitra(){
		$id = $this->id;
		$sql="SELECT * FROM kegiatan_mitra_petugas WHERE 
			id_kegiatan=$id";
		
		$result = array();

		$datas =Yii::app()->db->createCommand($sql)->queryAll();

		foreach($datas as $key => $value){
			$nama = "";
			$nip = "";
			$status = "PCL";
			$foto = Yii::app()->baseUrl.'/upload/temp/mitra_foto/black.png';
			$list_wilayah = '';
			$btn_wilayah = '';

			if($value['flag_mitra']==1){
				$petugas = Pegawai::model()->findByPk($value['id_mitra']);	
				if($petugas!==null){
					$nama = $petugas->nama;
					$nip = $petugas->nip;
					$foto = $petugas->fotoImage;
				}
			}
			else{
				$petugas = MitraBps::model()->findByPk($value['id_mitra']);	
				if($petugas!==null){
					$nama = $petugas->nama;
					$foto = $petugas->fotoImage;
				}
			}

			if($value['status']==1){
				$status = "PML";
			}
			else{
				$wilayah = KegiatanMitraWilayah::model()->findAllByAttributes(array(
					'kmp_id'	=>$value['id']
				));

				$list_wilayah .= "<p><b> <u>Wilayah Tugas</u></b></p>";
				foreach($wilayah as $key_wil => $val_wil){
					$list_wilayah .="<p>- NKS: ".$val_wil['nks'].", NBS: ".$val_wil['bs']."</p>";
				}

				$btn_wilayah =('[<a href="#modalUpdate" role="button" class="update_wilayah" 
				data-id="'.$value['id'].'" 
				data-nama="'.$nama.'" 
				data-mitra_id="'.$value['id_mitra'].'" 
				data-toggle="modal">Update Wilayah Tugas</a>]');
			}

			$result[] = array(
				'id'		=>$value['id'],
				'id_mitra'	=>$value['id_mitra'],
				'foto'		=>$foto,
				'nama'		=>$nama,
				'nip'		=>$nip,
				'status'	=>$status,
				'flag'		=>$value['flag_mitra'],
				'nilai'		=>$value['nilai'],
				'list_wilayah'	=>$list_wilayah,
				'btn_wilayah'	=>$btn_wilayah
			);
		}

		return $result;
	}

	public function getResume(){
		$result = array();
		$idnya = $this->id;

		$sql = "SELECT COUNT(id) as jumlah_petugas, 
					SUM(case when status = 1 then 1 else 0 end) as jumlah_pml,
					SUM(case when status = 2 then 1 else 0 end) as jumlah_pcl,
					SUM(case when flag_mitra = 1 then 1 else 0 end) as jumlah_pegawai,
					SUM(case when flag_mitra = 2 then 1 else 0 end) as jumlah_mitra,
					AVG(nilai) as rata_nilai,
					MAX(nilai) as max_nilai,
					MIN(nilai) as min_nilai
					FROM `kegiatan_mitra_petugas` WHERE id_kegiatan=$idnya";
		
		$jumlah_petugas = Yii::app()->db->createCommand($sql)->queryRow();

		$result['jumlah_petugas'] = $jumlah_petugas['jumlah_petugas'];
		$result['jumlah_pml'] = $jumlah_petugas['jumlah_pml'];
		$result['jumlah_pcl'] = $jumlah_petugas['jumlah_pcl'];
		$result['jumlah_pegawai'] = $jumlah_petugas['jumlah_pegawai'];
		$result['jumlah_mitra'] = $jumlah_petugas['jumlah_mitra'];
		$result['rata_nilai'] = $jumlah_petugas['rata_nilai'];
		$result['max_nilai'] = $jumlah_petugas['max_nilai'];
		$result['min_nilai'] = $jumlah_petugas['min_nilai'];

		return $result;
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
					mitra_pertanyaan p, kegiatan_mitra_pertanyaan kmp
					WHERE 
						kmp.mitra_pertanyaan_id = p.id AND 
						m.pertanyaan_id=p.id  AND kegiatan_id = $idnya 
					GROUP BY pertanyaan_id";

		return Yii::app()->db->createCommand($sql)->queryAll();		
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return KegiatanMitra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
