<?php

/**
 * This is the model class for table "participant".
 *
 * The followings are the available columns in table 'participant':
 * @property integer $id
 * @property integer $kegiatan
 * @property integer $unitkerja
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 * @property integer $target
 *
 * The followings are the available model relations:
 * @property Kegiatan $kegiatan0
 * @property UnitKerja $unitkerja0
 */
class Participant extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'participant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kegiatan, unitkerja, created_by, created_time, updated_by, updated_time, target', 'required'),
			array('kegiatan, unitkerja, created_by, updated_by, target', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kegiatan, unitkerja, created_by, created_time, updated_by, updated_time, target', 'safe', 'on'=>'search'),
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
			'unitkerja0' => array(self::BELONGS_TO, 'UnitKerja', 'unitkerja'),
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
			'unitkerja' => 'Unitkerja',
			'created_by' => 'Created By',
			'created_time' => 'Created Time',
			'updated_by' => 'Updated By',
			'updated_time' => 'Updated Time',
			'target' => 'Target',
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
		$criteria->compare('kegiatan',$this->kegiatan);
		$criteria->compare('unitkerja',$this->unitkerja);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('target',$this->target);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function PerKegiatan($idnya)
	{

		$criteria=new CDbCriteria;
		$criteria->with=array('unitkerja0');
		$criteria->compare('kegiatan',$idnya);
		$criteria->order = 'unitkerja0.code';

		$total=Participant::model()->countByAttributes(array('kegiatan'=>$idnya));

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'totalItemCount' => $total,
            'pagination' => array(
                'pageSize' => $total,
            ),
		));	
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Participant the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// get all list progress acceptance by kegiatan and unitkerja
	public function getListProgressAcceptance()
	{
		$str_result='';
		$model_kegiatan=Kegiatan::model()->findByPk($this->kegiatan);
		foreach (ValueKegiatan::model()->findAllByAttributes(array('unit_kerja'=>$this->unitkerja,'kegiatan'=>$this->kegiatan,'jenis'=>1)) as $key => $value)
		{
			if(HelpMe::isAuthorizeUnitKerja($model_kegiatan->unit_kerja)){
				$str_result.=('- [ <a href="#myModal" role="button" class="update_terima" 
					data-id="'.$value->id.'" 
					data-unitkerja="'.$value->unit_kerja.'" 
					data-tanggal="'.date("Y-m-d",strtotime($value->tanggal_pengumpulan)).'" 
					data-jumlah="'.$value->jumlah.'"
					data-toggle="modal">Update</a> ] '.HelpMe::HrDate($value['tanggal_pengumpulan']).' <b>Jumlah : '.$value['jumlah'].'</b> <br/>');
			}
			else
			{
				$str_result.=('- '.HelpMe::HrDate($value['tanggal_pengumpulan']).' <b>Jumlah : '.$value['jumlah'].'</b><br/>');
			}
		}
		return $str_result;
	}


	// get all list progress delivery by kegiatan and unitkerja
	public function getListProgressDelivery()
	{
		$str_result='';
		$model_kegiatan=Kegiatan::model()->findByPk($this->kegiatan);
		foreach (ValueKegiatan::model()->findAllByAttributes(array('unit_kerja'=>$this->unitkerja,'kegiatan'=>$this->kegiatan,'jenis'=>2)) as $key => $value)
		{
			if(HelpMe::isAuthorizeUnitKerja($model_kegiatan->unit_kerja)){
				$str_result.=('- [ <a href="#myModal2" role="button" class="update_kirim" 
					data-id="'.$value->id.'" 
					data-unitkerja="'.$value->unit_kerja.'" 
					data-tanggal="'.date("Y-m-d",strtotime($value->tanggal_pengumpulan)).'" 
					data-jumlah="'.$value->jumlah.'"
					data-ket="'.$value->ketarangan.'"  
					data-toggle="modal">Update</a> ] '.HelpMe::HrDate($value['tanggal_pengumpulan']).' <b>Jumlah : '.$value['jumlah'].' ('.$value['ketarangan'].')</b> <br/>');
			}
			else
			{
					$str_result.=('- '.HelpMe::HrDate($value['tanggal_pengumpulan']).' <b>Jumlah : '.$value['jumlah'].' ('.$value['ketarangan'].')</b> <br/>');	
			}
		}
		return $str_result;
	}

	// get percentage progress by kegiatan and unitkerja
	public function getPercentageProgress($jenis)
	{
		$unitkerja=$this->unitkerja;
		$kegiatan=$this->kegiatan;

		$sql="SELECT IF(SUM(jumlah) IS NULL, 0, SUM(jumlah)) AS val FROM value_kegiatan WHERE unit_kerja=$unitkerja AND kegiatan=$kegiatan AND jenis=$jenis";
		$total=Yii::app()->db->createCommand($sql)->queryScalar();
		
		$percentage=($this->target==0) ? 100 : $total/$this->target*100;
		return floor($percentage);
	}

	// get percentage progress by kegiatan and unitkerja
	public function getClassProgress($jenis)
	{
		$unitkerja=$this->unitkerja;
		$kegiatan=$this->kegiatan;

		$sql="SELECT IF(SUM(jumlah) IS NULL, 0, SUM(jumlah)) AS val FROM value_kegiatan WHERE unit_kerja=$unitkerja AND kegiatan=$kegiatan AND jenis=$jenis";
		$total=Yii::app()->db->createCommand($sql)->queryScalar();
		
		$percentage=($this->target==0) ? 100 : $total/$this->target*100;
		$classr='';
		if($percentage<50)
			$classr="bpsbad";
		else if($percentage>=50 && $percentage<80)
			$classr="bpsmedium";
		else if($percentage>=80)
			$classr="bpsgood";

		return $classr;
	}


	public function getTimelinesSkor($jenis)
	{
		$skor=0;
		if($this->getPercentageProgress($jenis)<100)
			$skor=0;
		else
		{
			$sql="SELECT TO_DAYS(tanggal_pengumpulan)-TO_DAYS(end_date) FROM value_kegiatan v, kegiatan k WHERE v.kegiatan={$this['kegiatan']} AND 
				v.unit_kerja={$this['unitkerja']} AND v.jenis={$jenis} AND k.id=v.kegiatan 
				ORDER by tanggal_pengumpulan DESC LIMIT 1";

			//difference between end_date and the last time report they work
			$difference_date=Yii::app()->db->createCommand($sql)->queryScalar();
			if($difference_date<0)
			{
				$skor=5;
			}
			else if($difference_date==0)
			{
				$skor=4;
			}
			else
			{
				$jenis_kegiatan=$this->kegiatan0->jenis_kegiatan;
				if($jenis_kegiatan==1)
				{
					if($difference_date<=2)
						$skor=3;
					else if($difference_date>2 && $difference_date<=5)
						$skor=2;
					else
						$skor=1;
				}
				else if($jenis_kegiatan==2)
				{

					if($difference_date<=5)
						$skor=3;
					else if($difference_date>5 && $difference_date<=14)
						$skor=2;
					else
						$skor=1;
				}
				else if($jenis_kegiatan==3)
				{
					if($difference_date<=9)
						$skor=3;
					else if($difference_date>9 && $difference_date<=18)
						$skor=2;
					else
						$skor=1;
				}
				else if($jenis_kegiatan==4)
				{

					if($difference_date<=11)
						$skor=3;
					else if($difference_date>11 && $difference_date<=21)
						$skor=2;
					else
						$skor=1;
				}
				else if($jenis_kegiatan==5)
				{

					if($difference_date<=6)
						$skor=3;
					else if($difference_date>6 && $difference_date<=16)
						$skor=2;
					else
						$skor=1;
				}
			}
		}
		if($jenis==1)
		{
			$sql_set_skor="UPDATE participant SET timelines_point={$skor} WHERE  
						kegiatan={$this['kegiatan']} AND 
						unitkerja={$this['unitkerja']}";
			Yii::app()->db->createCommand($sql_set_skor)->execute();
		}

		return $skor;
	}


	// update all timelines skor
	public function UpdateAllSkor()
	{
		$skor=0;
		$jenis=1;
		foreach (Participant::model()->findAll() as $key => $vmodel) {
			if($vmodel->getPercentageProgress($jenis)<100)
				$skor=0;
			else
			{
				$sql="SELECT TO_DAYS(tanggal_pengumpulan)-TO_DAYS(end_date) FROM value_kegiatan v, kegiatan k WHERE v.kegiatan={$vmodel['kegiatan']} AND 
					v.unit_kerja={$vmodel['unitkerja']} AND v.jenis=1 AND k.id=v.kegiatan 
					ORDER by tanggal_pengumpulan DESC LIMIT 1";

				//difference between end_date and the last time report they work
				$difference_date=Yii::app()->db->createCommand($sql)->queryScalar();
				if($difference_date<0)
				{
					$skor=5;
				}
				else if($difference_date==0)
				{
					$skor=4;
				}
				else
				{
					$jenis_kegiatan=$vmodel->kegiatan0->jenis_kegiatan;
					if($jenis_kegiatan==1)
					{
						if($difference_date<=2)
							$skor=3;
						else if($difference_date>2 && $difference_date<=5)
							$skor=2;
						else
							$skor=1;
					}
					else if($jenis_kegiatan==2)
					{

						if($difference_date<=5)
							$skor=3;
						else if($difference_date>5 && $difference_date<=14)
							$skor=2;
						else
							$skor=1;
					}
					else if($jenis_kegiatan==3)
					{
						if($difference_date<=9)
							$skor=3;
						else if($difference_date>9 && $difference_date<=18)
							$skor=2;
						else
							$skor=1;
					}
					else if($jenis_kegiatan==4)
					{

						if($difference_date<=11)
							$skor=3;
						else if($difference_date>11 && $difference_date<=21)
							$skor=2;
						else
							$skor=1;
					}
					else if($jenis_kegiatan==5)
					{

						if($difference_date<=6)
							$skor=3;
						else if($difference_date>6 && $difference_date<=16)
							$skor=2;
						else
							$skor=1;
					}
				}
			}

			$sql_set_skor="UPDATE participant SET timelines_point={$skor} WHERE  
						kegiatan={$vmodel['kegiatan']} AND 
						unitkerja={$vmodel['unitkerja']}";
			Yii::app()->db->createCommand($sql_set_skor)->execute();	
		}
	}
}
