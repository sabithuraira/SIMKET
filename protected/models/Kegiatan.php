<?php

/**
 * This is the model class for table "kegiatan".
 *
 * The followings are the available columns in table 'kegiatan':
 * @property integer $id
 * @property string $kegiatan
 * @property integer $unit_kerja
 * @property string $start_date
 * @property string $end_date
 * @property string $created_time
 * @property integer $created_by
 * @property string $updated_time
 * @property integer $updated_by
 * @property integer $response_a
 * @property integer $response_b
 * @property integer $response_c
 * @property integer $response_d
 * @property integer $response_e
 * @property string $timeline_a_start
 * @property string $timeline_a_end
 * @property string $timeline_b_start
 * @property string $timeline_c_start
 * @property string $timeline_c_end
 * @property string $timeline_d_start
 * @property string $timeline_d_end
 * @property string $timeline_e_start
 * @property string $timeline_e_end
 * @property string $timeline_b_end
 *
 * The followings are the available model relations:
 * @property UnitKerja $unitKerja
 * @property Participant[] $participants
 * @property ValueKegiatan[] $valueKegiatans
 */
class Kegiatan extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kegiatan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kegiatan, unit_kerja, start_date, end_date, created_time, created_by, updated_time, updated_by,
				jenis_kegiatan', 'required'),
			array('unit_kerja, created_by, updated_by, response_a, response_b, response_c, response_d, response_e', 'numerical', 'integerOnly'=>true),
			array('kegiatan', 'length', 'max'=>255),
			array('timeline_a_start, timeline_a_end, timeline_b_start, timeline_c_start, timeline_c_end, timeline_d_start, timeline_d_end, timeline_e_start, timeline_e_end, timeline_b_end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kegiatan, unit_kerja, start_date, end_date, created_time, created_by, updated_time, updated_by, response_a, response_b, response_c, response_d, response_e, timeline_a_start, timeline_a_end, timeline_b_start, timeline_c_start, timeline_c_end, timeline_d_start, timeline_d_end, timeline_e_start, timeline_e_end, timeline_b_end', 'safe', 'on'=>'search'),
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
			'participants' => array(self::HAS_MANY, 'Participant', 'kegiatan'),
			'valueKegiatans' => array(self::HAS_MANY, 'ValueKegiatan', 'kegiatan'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kegiatan' => 'Kegiatan',
			'unit_kerja' => 'Unit Kerja',
			'start_date' => 'Tanggal Mulai',
			'end_date' => 'Tanggal Berakhir',
			'created_time' => 'Created Time',
			'created_by' => 'Created By',
			'updated_time' => 'Updated Time',
			'updated_by' => 'Updated By',
			'response_a' => 'Response A',
			'response_b' => 'Response B',
			'response_c' => 'Response C',
			'response_d' => 'Response D',
			'response_e' => 'Response E',
			'timeline_a_start' => 'Timeline A Start',
			'timeline_a_end' => 'Timeline A End',
			'timeline_b_start' => 'Timeline B Start',
			'timeline_c_start' => 'Timeline C Start',
			'timeline_c_end' => 'Timeline C End',
			'timeline_d_start' => 'Timeline D Start',
			'timeline_d_end' => 'Timeline D End',
			'timeline_e_start' => 'Timeline E Start',
			'timeline_e_end' => 'Timeline E End',
			'timeline_b_end' => 'Timeline B End',
		);
	}

	public function beforeDelete()
    {   
    	$idnya=$this->id;
    	$sql="DELETE FROM value_kegiatan WHERE kegiatan={$idnya}";
    	$sql2="DELETE FROM participant WHERE kegiatan={$idnya}";
    	
    	Yii::app()->db->createCommand($sql)->execute();
    	Yii::app()->db->createCommand($sql2)->execute();

        return true;
    }

	public function getProgressValue()
	{
		$sql1="SELECT SUM(target) FROM participant WHERE kegiatan={$this->id}";
		$sql2="SELECT SUM(jumlah) FROM value_kegiatan WHERE kegiatan={$this->id} AND jenis=1";

		$total1=Yii::app()->db->createCommand($sql1)->queryScalar();
		$total2=Yii::app()->db->createCommand($sql2)->queryScalar();

		$result=0;
		if($total1>0)
		{
			$result=$total2/$total1*100;
		}

		return round($result,2).' %';
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
		$criteria->compare('kegiatan',$this->kegiatan,true);
		$criteria->compare('unit_kerja',$this->unit_kerja);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('response_a',$this->response_a);
		$criteria->compare('response_b',$this->response_b);
		$criteria->compare('response_c',$this->response_c);
		$criteria->compare('response_d',$this->response_d);
		$criteria->compare('response_e',$this->response_e);
		$criteria->compare('timeline_a_start',$this->timeline_a_start,true);
		$criteria->compare('timeline_a_end',$this->timeline_a_end,true);
		$criteria->compare('timeline_b_start',$this->timeline_b_start,true);
		$criteria->compare('timeline_c_start',$this->timeline_c_start,true);
		$criteria->compare('timeline_c_end',$this->timeline_c_end,true);
		$criteria->compare('timeline_d_start',$this->timeline_d_start,true);
		$criteria->compare('timeline_d_end',$this->timeline_d_end,true);
		$criteria->compare('timeline_e_start',$this->timeline_e_start,true);
		$criteria->compare('timeline_e_end',$this->timeline_e_end,true);
		$criteria->compare('timeline_b_end',$this->timeline_b_end,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kegiatan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function CalendarClass()
	{
		$kelas="1";
		$now = time(); // or your date as well
     	$data_date = strtotime($this->end_date);
     	$datediff = $data_date-$now;
     	$total_day=floor($datediff/(60*60*24));
     	//1 hijau, 2 kuning, 3 merah

     	if($total_day>7)
     	{
     		$kelas=1;
     	}
     	else if($total_day<=7 && $total_day>=1)
     	{
     		$kelas=2;
     	}
     	else
     	{
     		if($this->getProgressValue()==100)
     			$kelas=1;
     		else
     			$kelas=3;
     	}

		return $kelas;
	}

	public function TabelClass()
	{
		$kelas="bpsgood";
		$now = time(); // or your date as well
     	$data_date = strtotime($this->end_date);
     	$datediff = $data_date-$now;
     	$total_day=floor($datediff/(60*60*24));
     	//1 hijau, 2 kuning, 3 merah

     	if($total_day>7)
     	{
     		$kelas="bpsgood";
     	}
     	else if($total_day<=7 && $total_day>=1)
     	{
     		$kelas="bpsmedium";
     	}
     	else
     	{
     		if($this->getProgressValue()==100)
     			$kelas="bpsgood";
     		else
     			$kelas="bpsbad";
     	}

		return $kelas;
	}

	
	public function getAll()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'totalItemCount'=>$this->count(),
			'pagination'=>array(
				'pageSize'	=>$this->count(),
			),
		));
	}

	public function getKegiatan2017Plus()
	{
		$sql="SELECT * FROM kegiatan WHERE YEAR(start_date)>=2018 OR YEAR(end_date)>=2018";
		$return_value=Yii::app()->db->createCommand($sql)->queryAll();

		return $return_value;
	}

	public function getTop5()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'totalItemCount'=>5,
			'pagination'=>array(
				'pageSize'	=>5,
			),
		));
	}

	
	// get target kegiatan from all participant
	public function getTarget()
	{
		$id=$this->id;
		$sql="SELECT IF(SUM(target) IS NULL, 0, SUM(target)) AS val FROM participant WHERE kegiatan=$id";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	// get target anggaran from all participant
	public function getTotalTargetAnggaran()
	{
		$id=$this->id;
		$sql="SELECT IF(SUM(target_anggaran) IS NULL, 0, SUM(target_anggaran)) AS val FROM participant WHERE kegiatan=$id";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	// get total realisasi anggaran from all participant
	public function getTotalRealisasiAnggaran()
	{
		$id=$this->id;
		$sql="SELECT IF(SUM(jumlah) IS NULL, 0, SUM(jumlah)) AS val FROM value_anggaran WHERE kegiatan=$id";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	// get percentage progress kegiatan from kegiatan
	public function getPercentageProgress($jenis)
	{
		$id=$this->id;
		$sql="SELECT IF(SUM(jumlah) IS NULL, 0, SUM(jumlah)) AS val FROM value_kegiatan WHERE kegiatan=$id AND jenis=$jenis";
		$hasil=Yii::app()->db->createCommand($sql)->queryScalar();
        if($jenis==1){
            if($hasil==0){
                $sql2="SELECT IF(end_date<NOW(), 0, 1) AS val FROM kegiatan WHERE id={$id}";
                $hasil2=Yii::app()->db->createCommand($sql2)->queryScalar();
                if($hasil2==0)
                    $hasil='<span class="text-red">TIDAK DILAPORKAN OPERATOR PROVINSI</span>';
            }
            else if($hasil<$this->getTarget()){
                $hasil='<span class="label label-danger">'.$hasil.'</span>';
            }
        }
        return $hasil;
	}

	// get total kegiatan in a yer
	public function getTotalKegiatan($tahun=NULL)
	{
		if($tahun==NULL)
		{
			$tahun=date('Y');
		}
		$sql="SELECT COUNT(*) FROM kegiatan WHERE YEAR(end_date)=$tahun";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	// get total kegiatan that have been expired in a year
	public function getTotalKegiatanExpired($tahun=NULL)
	{
		if($tahun==NULL)
		{
			$tahun=date('Y');
		}
		$datenow=date('Y-m-d');
		$sql="SELECT COUNT(*) FROM kegiatan WHERE YEAR(end_date)=$tahun AND end_date<$datenow";
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	// get total progress in a year
	// for example in 2014 we have 30000 target from all kegiatan
	// we have been finished 20000 target
	// this function will return 20000/30000*100
	public function getTotalProgress($tahun=NULL)
	{
		if($tahun==NULL)
		{
			$tahun=date('Y');
		}
		$sqlk="SELECT SUM(target) FROM participant p, kegiatan k 
				WHERE p.kegiatan=k.id AND YEAR(k.end_date)=$tahun";

		$total_target=Yii::app()->db->createCommand($sqlk)->queryScalar();

		$sqlr="SELECT SUM(jumlah) FROM value_kegiatan p, kegiatan k 
				WHERE p.kegiatan=k.id AND YEAR(k.end_date)=$tahun AND jenis=1";

		$total_real=Yii::app()->db->createCommand($sqlr)->queryScalar();

		return $total_target==0 ? 0 : floor($total_real/$total_target*100);
	}


	public function getProgressPerKabupaten()
	{
		$sql="SELECT sum(target) as vtarget,sum(amount) as vtotal, u.name FROM 
				(select pv.unitkerja, sum(target) as target
			      from participant pv
			      group by pv.unitkerja) p
			LEFT JOIN
			     (select v.unit_kerja, sum(jumlah) as amount
			      from value_kegiatan v
			      group by v.unit_kerja
			     ) f
			     ON f.unit_kerja = p.unitkerja
			LEFT JOIN unit_kerja u ON u.id=p.unitkerja
			GROUP BY p.unitkerja";


		$return_value=Yii::app()->db->createCommand($sql)->queryAll();

		return $return_value;
	}


    public function getJenisKegiatan()
    {
    	$result="";

    	if($this->jenis_kegiatan==1)
    		$result="Bulanan";
    	else if($this->jenis_kegiatan==2)
    		$result="Triwulanan";
    	else if($this->jenis_kegiatan==3)
    		$result="Semester";
    	else if($this->jenis_kegiatan==4)
    		$result="Tahunan";
    	else if($this->jenis_kegiatan==5)
    		$result="Subround";

   		return $result; 
    }


    public function getNilaiParticipan($unit_kerja)
    {
        $result="";
        $kegiatan=$this->id;
        
        $sql_part="SELECT COUNT(id) FROM participant WHERE kegiatan={$kegiatan} AND unitkerja={$unit_kerja}";
        $is_part=Yii::app()->db->createCommand($sql_part)->queryScalar();
        if($is_part<=0){
            $result='<b>X</b>';
        }
        else{
            $sql_rekap="SELECT SUM(v.jumlah) as total, target FROM value_kegiatan v, participant p  
                WHERE v.kegiatan={$kegiatan} AND v.unit_kerja={$unit_kerja} AND v.jenis=1 
                AND p.unitkerja=v.unit_kerja AND p.kegiatan=v.kegiatan";

            $hasil_rekap=Yii::app()->db->createCommand($sql_rekap)->queryRow();

            if($hasil_rekap['total']==0){
                $result="Tidak Ada Laporan";   
            }
            if($hasil_rekap['total']!=0 && $hasil_rekap['total']<$hasil_rekap['target'])
            {
                $result='<b style="color:red">T</b>';
            }
            else{
                $sql_tanggal="SELECT * FROM value_kegiatan 
                    WHERE kegiatan=15 AND unit_kerja=4 ORDER BY tanggal_pengumpulan DESC LIMIT 1";

                $hasil_tanggal=Yii::app()->db->createCommand($sql_tanggal)->queryRow();
                $hasil_tanggal=date('Y-m-d',strtotime($hasil_tanggal['tanggal_pengumpulan']));
                if($hasil_tanggal<=$this->end_date){
                    $result='<b style="color:green">OK</b>';
                }else{
                    $result='<b style="color:red">T</b>';
                }
            }
        }

        return $result; 
    }
}
