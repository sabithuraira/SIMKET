<?php

/**
 * This is the model class for table "unit_kerja".
 *
 * The followings are the available columns in table 'unit_kerja':
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $parent
 * @property integer $created_by
 * @property string $createde_time
 * @property integer $updated_by
 * @property string $updated_time
 * @property integer $jenis
 */
class UnitKerja extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'unit_kerja';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, created_by, created_time, updated_by, jenis', 'required'),
			array('parent, created_by, updated_by, jenis', 'numerical', 'integerOnly'=>true),
			array('code', 'length', 'max'=>45),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, name, parent, created_by, created_time, updated_by, updated_time, jenis', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'name' => 'Name',
			'parent' => 'Parent',
			'created_by' => 'Created By',
			'created_time' => 'Createde Time',
			'updated_by' => 'Updated By',
			'updated_time' => 'Updated Time',
			'jenis' => 'Jenis',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('parent',$this->parent);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('jenis',$this->jenis);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UnitKerja the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	//get all kegiatan that have been expired and the progress still not 100%
	public function BidangWarning($tahun)
	{
		$daftar=array();
		$sql="SELECT * FROM kegiatan WHERE 
			unit_kerja IN(SELECT id FROM mongkia.unit_kerja WHERE parent={$this->id}) AND end_date<DATE(NOW()) 
			AND YEAR(end_date)={$tahun};";

		$data=Yii::app()->db->createCommand($sql)->query();
		foreach ($data as $k => $v) {
			$cur=Kegiatan::model()->findByPk($v['id']);
			if($cur!==null)
			{
				if($cur->getTarget()!=0)
				{
					if(($cur->getPercentageProgress(1)/$cur->getTarget())<1)
					{
						$daftar[]=$v['id'];
					}
				}
			}
		}

		$daftar_str=implode(",", $daftar);
		$all_kegiatan=array();
		if(strlen($daftar_str)>0)
			$all_kegiatan=Kegiatan::model()->findAll("id IN ({$daftar_str})");
		return $all_kegiatan;
	}

	public function JumlahKegiatanBulanan($bulan,$tahun){
		$idnya=$this->id;
		$bulan=(int)$bulan;

		$sql="SELECT COUNT(*) FROM kegiatan WHERE unit_kerja={$idnya} AND MONTH(end_date)={$bulan} AND 
			YEAR(end_date)={$tahun}";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public function JumlahKegiatanTDBulanan($bulan,$tahun){
		$idnya=$this->id;
		$bulan=(int)$bulan;

		$sql="SELECT COUNT(*) FROM kegiatan k WHERE unit_kerja={$idnya} 
			AND MONTH(end_date)={$bulan} AND YEAR(end_date)={$tahun}  
			AND id IN(SELECT DISTINCT kegiatan FROM value_kegiatan WHERE jenis=1)";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}


	public function TargetKegiatanBulanan($bulan,$tahun){
		$idnya=$this->id;
		$bulan=(int)$bulan;

		$sql="SELECT SUM(target) FROM participant WHERE kegiatan IN(
				SELECT id FROM kegiatan WHERE unit_kerja={$idnya} AND MONTH(end_date)={$bulan} AND YEAR(end_date)={$tahun}
			)";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public function RincianDokumenBulanan($bulan,$tahun){
		$idnya=$this->id;
		$bulan=(int)$bulan;

		$sql_awal="SELECT id FROM kegiatan WHERE unit_kerja={$idnya} AND MONTH(end_date)={$bulan} AND YEAR(end_date)={$tahun}";
		$data_awal=Yii::app()->db->createCommand($sql_awal)->queryAll();

		if(count($data_awal)>0)
		{	
			$arr_awal=array();
			foreach ($data_awal as $key => $value) {
				$arr_awal[]=$value['id'];
			}	
			$data_awal2=implode(',',$arr_awal);
			
			//print_r($data_awal);die();
			$sql="SELECT 
			SUM(IF(v.jenis=2,v.jumlah,0)) as dikirim, 
			SUM(IF(v.jenis=1,v.jumlah,0)) as diterima, 
			SUM(IF(v.jenis=1 AND DATE(v.tanggal_pengumpulan)>k.end_date,jumlah,0)) as terlambat, 
			SUM(IF(v.jenis=1 AND DATE(v.tanggal_pengumpulan)<=k.end_date,jumlah,0)) as ontime,  
			SUM(IF(v.jenis=1 AND DATE(v.tanggal_pengumpulan)<>DATE(v.created_time),jumlah,0)) as bedalog 
			FROM value_kegiatan v, kegiatan k WHERE v.kegiatan IN({$data_awal2}) AND k.id=v.kegiatan";
			return Yii::app()->db->createCommand($sql)->queryRow();
		}
		else
		{
			$data_kosong=array(
				'dikirim'=>'-',
				'diterima'=>'-',
				'terlambat'=>'-',
				'ontime'	=>'-',
				'bedalog'	=>'-',
			);
			return $data_kosong;
		}
	}
}
