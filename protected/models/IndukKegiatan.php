<?php

/**
 * This is the model class for table "induk_kegiatan".
 *
 * The followings are the available columns in table 'induk_kegiatan':
 * @property integer $id
 * @property string $name
 * @property string $tahun
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 */
class IndukKegiatan extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'induk_kegiatan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, tahun, output_id, unit_kerja_id, created_by, created_time, updated_by, updated_time', 'required'),
			array('tahun, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, tahun, created_by, created_time, updated_by, updated_time', 'safe', 'on'=>'search'),
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
			'unitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja_id'),
			'output' => array(self::BELONGS_TO, 'Output', 'output_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'tahun' => 'Tahun',
			'output_id' => 'Output',
			'unit_kerja_id'	=> 'Penanggung Jawab',
			'created_by' => 'Created By',
			'created_time' => 'Created Time',
			'updated_by' => 'Updated By',
			'updated_time' => 'Updated Time',
		);
	}

	public function getByKabKota($id_kab_kota){
		$id = $this->id;
		$sql_t = "(SELECT IFNULL(jumlah, 0) target 
						FROM `value_anggaran_target` WHERE kegiatan=$id AND unit_kerja=$id_kab_kota
						ORDER BY created_time DESC LIMIT 1)
					UNION
					(SELECT 0 target)";

		// print_r($sql_t);die();
		$result_t = Yii::app()->db->createCommand($sql_t)->queryRow();
		
		$select_real = "";
		for($i = 1;$i < 12;++$i){
			$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS r$i, ";
		}
		$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS r12";

		$sql_r = "SELECT 
				$select_real 
				FROM `value_anggaran` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan 
					FROM `value_anggaran` as t 
					WHERE t.kegiatan = $id AND t.unit_kerja=$id_kab_kota 
					GROUP BY bulan
				) AS x USING (id)";

		$result_r = Yii::app()->db->createCommand($sql_r)->queryRow();

		$select_rpd = "";
		for($i = 1;$i < 12;++$i){
			$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS rpd$i, ";
		}
		$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS rpd12";

		$sql_rpd = "SELECT 
				$select_rpd 
				FROM `value_rpd` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan 
					FROM `value_rpd` as t 
					WHERE t.kegiatan = $id AND t.unit_kerja=$id_kab_kota 
					GROUP BY bulan
				) AS x USING (id)";

		$result_rpd = Yii::app()->db->createCommand($sql_rpd)->queryRow();
		
		return array_merge($result_t, $result_r, $result_rpd);
	}

	public function getByKegiatan($id){
		$sql_t = "SELECT 
				COALESCE(SUM(jumlah),0) AS target 
				FROM `value_anggaran_target` as va1 
				JOIN (
		
					SELECT MAX(t.id) AS id, unit_kerja
					FROM `value_anggaran_target` as t 
					WHERE t.kegiatan = $id 
					GROUP BY unit_kerja
				) AS x USING (id)";

		$result_t = Yii::app()->db->createCommand($sql_t)->queryRow();
		
		$select_real = "";
		for($i = 1;$i < 12;++$i){
			$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS r$i, ";
		}
		$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS r12";

		$sql_r = "SELECT 
				$select_real 
				FROM `value_anggaran` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan, unit_kerja 
					FROM `value_anggaran` as t 
					WHERE t.kegiatan = $id 
					GROUP BY bulan, unit_kerja
				) AS x USING (id)";

		$result_r = Yii::app()->db->createCommand($sql_r)->queryRow();

		$select_rpd = "";
		for($i = 1;$i < 12;++$i){
			$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS rpd$i, ";
		}
		$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS rpd12";

		$sql_rpd = "SELECT 
				$select_rpd 
				FROM `value_rpd` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan, unit_kerja 
					FROM `value_rpd` as t 
					WHERE t.kegiatan = $id 
					GROUP BY bulan, unit_kerja
				) AS x USING (id)";

		$result_rpd = Yii::app()->db->createCommand($sql_rpd)->queryRow();
		return array_merge($result_t, $result_r, $result_rpd);
	}

	// show data for graphic RPD and Realisasi
	// for all unit kerja or spesific unit kerja
	public static function getByUnitKerja($id){
		$s_where = " ";

		if($id!=0){
			$s_where = " WHERE t.unit_kerja = $id ";
		}

		$sql_t = "SELECT 
				COALESCE(SUM(jumlah),0) AS target 
				FROM `value_anggaran_target` as va1 
				JOIN (
		
					SELECT MAX(t.id) AS id, kegiatan
					FROM `value_anggaran_target` as t 
					$s_where 
					GROUP BY kegiatan
				) AS x USING (id)";

		$result_t = Yii::app()->db->createCommand($sql_t)->queryRow();
		
		$select_real = "";
		for($i = 1;$i < 12;++$i){
			$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS r$i, ";
		}
		$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS r12";

		$sql_r = "SELECT 
				$select_real 
				FROM `value_anggaran` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan, kegiatan 
					FROM `value_anggaran` as t 
					$s_where 
					GROUP BY bulan, kegiatan
				) AS x USING (id)";

		$result_r = Yii::app()->db->createCommand($sql_r)->queryRow();

		$select_rpd = "";
		for($i = 1;$i < 12;++$i){
			$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS rpd$i, ";
		}
		$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS rpd12";

		$sql_rpd = "SELECT 
				$select_rpd 
				FROM `value_rpd` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan, kegiatan 
					FROM `value_rpd` as t 
					$s_where  
					GROUP BY bulan, kegiatan
				) AS x USING (id)";

		// print_r($sql_t);
		// print_r("<br/><br/>");
		// print_r($sql_rpd);
		// print_r("<br/><br/>");
		// print_r($sql_r);
		// die();

		$result_rpd = Yii::app()->db->createCommand($sql_rpd)->queryRow();
		return array_merge($result_t, $result_r, $result_rpd);
	}

	// show data for tabel RPD and Realisasi
	// for all unit kerja or spesific unit kerja
	// and all kegiatan
	public static function getByUnitKerjaAndKegiatan($id){
		$s_where = " ";

		if($id!=0){
			$s_where = " WHERE t.unit_kerja = $id ";
		}

		$sql_t = "SELECT 
				COALESCE(SUM(jumlah),0) AS target,
				va1.unit_kerja as t_unit_kerja
				FROM `value_anggaran_target` as va1 
				JOIN (
		
					SELECT MAX(t.id) AS id, kegiatan, unit_kerja
					FROM `value_anggaran_target` as t 
					$s_where 
					GROUP BY kegiatan, unit_kerja
				) AS x USING (id) 
				GROUP BY t_unit_kerja";

		// $result_t = Yii::app()->db->createCommand($sql_t)->queryAll();
		
		$select_real = "";
		for($i = 1;$i < 12;++$i){
			$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS r$i, ";
		}
		$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS r12";

		$sql_r = "SELECT va1.unit_kerja as r_unit_kerja, 
				$select_real 
				FROM `value_anggaran` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan, kegiatan, unit_kerja
					FROM `value_anggaran` as t 
					$s_where 
					GROUP BY bulan, kegiatan, unit_kerja
				) AS x USING (id) 
				GROUP BY r_unit_kerja";

		// $result_r = Yii::app()->db->createCommand($sql_r)->queryAll();

		$select_rpd = "";
		for($i = 1;$i < 12;++$i){
			$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS rpd$i, ";
		}
		$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS rpd12";

		$sql_rpd = "SELECT va1.unit_kerja as rpd_unit_kerja, 
				$select_rpd 
				FROM `value_rpd` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan, kegiatan, unit_kerja
					FROM `value_rpd` as t 
					$s_where  
					GROUP BY bulan, kegiatan, unit_kerja
				) AS x USING (id) 
				GROUP BY rpd_unit_kerja";

		// $result_rpd = Yii::app()->db->createCommand($sql_rpd)->queryAll();
		
		$sql_all = "SELECT uk.id, code, name, t_target.target,
			t_rpd.rpd1, t_rpd.rpd2, t_rpd.rpd3, t_rpd.rpd4, t_rpd.rpd5, t_rpd.rpd6, t_rpd.rpd7, t_rpd.rpd8, t_rpd.rpd9, t_rpd.rpd10, t_rpd.rpd11, t_rpd.rpd12,
			t_r.r1, t_r.r2, t_r.r3, t_r.r4, t_r.r5, t_r.r6, t_r.r7, t_r.r8, t_r.r9, t_r.r10, t_r.r11, t_r.r12
			
			FROM unit_kerja as uk
			
			LEFT JOIN($sql_t) as t_target ON t_target.t_unit_kerja = uk.id 
			LEFT JOIN($sql_rpd) as t_rpd ON t_rpd.rpd_unit_kerja = uk.id 
			LEFT JOIN ($sql_r) as t_r ON t_r.r_unit_kerja = uk.id

			WHERE parent=1 ORDER BY jenis, code";

		return Yii::app()->db->createCommand($sql_all)->queryAll();
	}

	// show data for tabel anggaran per unit kerja
	public function getAllAnggaranPerUnitKerja($id){
		$s_where = " ";

		if($id!=0){
			$s_where = " WHERE t.unit_kerja = $id ";
		}

		$sql_t = "SELECT 
				COALESCE(SUM(jumlah),0) AS target,
				va1.kegiatan as keg
				FROM `value_anggaran_target` as va1 
				JOIN (
		
					SELECT MAX(t.id) AS id, kegiatan
					FROM `value_anggaran_target` as t 
					$s_where 
					GROUP BY kegiatan
				) AS x USING (id) 
				GROUP BY keg";

		$select_real = "";
		for($i = 1;$i < 12;++$i){
			$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS r$i, ";
		}
		$select_real.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS r12";

		$sql_r = "SELECT va1.kegiatan as keg, 
				$select_real 
				FROM `value_anggaran` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan, kegiatan
					FROM `value_anggaran` as t 
					$s_where 
					GROUP BY bulan, kegiatan
				) AS x USING (id) 
				GROUP BY keg";

		$select_rpd = "";
		for($i = 1;$i < 12;++$i){
			$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = $i THEN va1.jumlah ELSE 0 END),0) AS rpd$i, ";
		}
		$select_rpd.= "COALESCE(SUM(CASE WHEN va1.bulan = 12 THEN va1.jumlah ELSE 0 END),0) AS rpd12";

		$sql_rpd = "SELECT va1.kegiatan as keg, 
				$select_rpd 
				FROM `value_rpd` as va1 
				JOIN (
					SELECT MAX(t.id) AS id, bulan, kegiatan 
					FROM `value_rpd` as t 
					$s_where  
					GROUP BY bulan, kegiatan 
				) AS x USING (id) 
				GROUP BY keg";

		$sql_all = "SELECT ik.id, ik.name,  t_target.target,
			t_rpd.rpd1, t_rpd.rpd2, t_rpd.rpd3, t_rpd.rpd4, t_rpd.rpd5, t_rpd.rpd6, t_rpd.rpd7, t_rpd.rpd8, t_rpd.rpd9, t_rpd.rpd10, t_rpd.rpd11, t_rpd.rpd12,
			t_r.r1, t_r.r2, t_r.r3, t_r.r4, t_r.r5, t_r.r6, t_r.r7, t_r.r8, t_r.r9, t_r.r10, t_r.r11, t_r.r12
			
			FROM induk_kegiatan as ik
			
			LEFT JOIN($sql_t) as t_target ON t_target.keg = ik.id 
			LEFT JOIN($sql_rpd) as t_rpd ON t_rpd.keg = ik.id 
			LEFT JOIN ($sql_r) as t_r ON t_r.keg = ik.id

			ORDER BY id";

		// print_r($sql_all);
		// die();

		return Yii::app()->db->createCommand($sql_all)->queryAll();
	}

	//menu from BOSS
	// public function getByKabKota_j($id_kab_kota){
	// 	$id = $this->id;
	// 	$sql_t = "SELECT 
	// 			COALESCE(SUM(CASE WHEN jenis = 1 THEN jumlah ELSE 0 End),0) AS t1, 
	// 			COALESCE(SUM(CASE WHEN jenis = 2 THEN jumlah ELSE 0 End),0) AS t2, 
	// 			COALESCE(SUM(CASE WHEN jenis = 3 THEN jumlah ELSE 0 End),0) AS t3, 
	// 			COALESCE(SUM(CASE WHEN jenis = 4 THEN jumlah ELSE 0 End),0) AS t4
	// 			FROM `value_anggaran_target_bos` WHERE kegiatan=$id AND unit_kerja=$id_kab_kota";

	// 	$result_t = Yii::app()->db->createCommand($sql_t)->queryRow();


	// 	$sql_r = "SELECT 
	// 			COALESCE(SUM(CASE WHEN jenis = 1 THEN jumlah ELSE 0 End),0) AS r1, 
	// 			COALESCE(SUM(CASE WHEN jenis = 2 THEN jumlah ELSE 0 End),0) AS r2, 
	// 			COALESCE(SUM(CASE WHEN jenis = 3 THEN jumlah ELSE 0 End),0) AS r3, 
	// 			COALESCE(SUM(CASE WHEN jenis = 4 THEN jumlah ELSE 0 End),0) AS r4
	// 			FROM `value_anggaran_bos` WHERE kegiatan=$id AND unit_kerja=$id_kab_kota";
		
	// 	$result_r = Yii::app()->db->createCommand($sql_r)->queryRow();
	// 	return array_merge($result_t, $result_r);
	// }


	//report jenis BOSS
	// public function getDetailByKabKotaAndJenis_j($id_kab_kota, $id_jenis){
	// 	$id = $this->id;
	// 	$sql = "SELECT * FROM `value_anggaran_bos` 
	// 			WHERE kegiatan=$id AND unit_kerja=$id_kab_kota AND jenis=$id_jenis";
		
	// 	$data = Yii::app()->db->createCommand($sql)->queryAll();

	// 	$str_result = "";

	// 	foreach($data as $value){
	// 		if(HelpMe::isAuthorizeUnitKerja($id_kab_kota)){
	// 			$str_result.=('- [ <a href="#myModalRealisasi" role="button" class="update_realisasi" 
	// 				data-id="'.$value['id'].'" 
	// 				data-unitkerja="'.$id_kab_kota.'" 
	// 				data-jenis="'.$id_jenis.'" 
	// 				data-tanggal="'.date("Y-m-d",strtotime($value['tanggal_realisasi'])).'" 
	// 				data-jumlah="'.$value['jumlah'].'"
	// 				data-keterangan="'.$value['keterangan'].'" 
	// 				data-toggle="modal">Update</a> ] '.HelpMe::HrDate($value['tanggal_realisasi']).' <b>Jumlah : '.$value['jumlah'].'</b> ('.$value['keterangan'].')<br/>');
	// 		}
	// 		else
	// 		{
	// 			$str_result.=('- '.HelpMe::HrDate($value['tanggal_realisasi']).' <b>Jumlah : '.$value['jumlah'].'</b> ('.$value['keterangan'].')<br/>');
	// 		}
	// 	}

	// 	return $str_result;
	// }


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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tahun',$this->tahun);
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
	 * @return IndukKegiatan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
