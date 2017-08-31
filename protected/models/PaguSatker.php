<?php

/**
 * This is the model class for table "pagu_satker".
 *
 * The followings are the available columns in table 'pagu_satker':
 * @property integer $id
 * @property integer $m_induk
 * @property integer $unit_kerja
 * @property string $jumlah
 * @property integer $bulan
 * @property integer $tahun
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 *
 * The followings are the available model relations:
 * @property MInduk $mInduk
 * @property UnitKerja $unitKerja
 */
class PaguSatker extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pagu_satker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('m_induk, unit_kerja, jumlah, bulan, tahun, created_by, created_time, updated_by, updated_time', 'required'),
			array('m_induk, unit_kerja, bulan, tahun, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('jumlah', 'length', 'max'=>13),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, m_induk, unit_kerja, jumlah, bulan, tahun, created_by, created_time, updated_by, updated_time', 'safe', 'on'=>'search'),
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
			'mInduk' => array(self::BELONGS_TO, 'MInduk', 'm_induk'),
			'unitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'm_induk' => 'Uraian Satker',
			'unit_kerja' => 'Unit Kerja',
			'jumlah' => 'Jumlah',
			'bulan' => 'Bulan',
			'tahun' => 'Tahun',
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
		$criteria->compare('m_induk',$this->m_induk);
		$criteria->compare('unit_kerja',$this->unit_kerja);
		$criteria->compare('jumlah',$this->jumlah,true);
		$criteria->compare('bulan',$this->bulan);
		$criteria->compare('tahun',$this->tahun);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_time',$this->updated_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/*
	public function getEdit($id,$wil,$data)
	{
		//print_r($data);
		foreach(array_keys($data) as $ii)
		{
			$nilainya=$data[$ii];
			//$tahun=substr($ii,0,4);
			//$parameter=str_replace('_',' ',$nilainya);

			//print_r($parameter);
			$dataparam=explode("-",$nilainya);
			
			if(count($dataparam)>1)
			{
				$idnya		=$dataparam[0];
				$
				$exi=$this->findByAttributes(array(
					'table_inisial'=>$id,
					'wilayah'=>$wil,
					'tahun'=>$tahun,
					'param1'=>$parameter
				));
				
				if($exi!==NULL)
				{
					$sql="UPDATE tabdin SET nilai='$nilainya' 
							WHERE table_inisial=$id AND 
							wilayah='$wil' AND tahun='$tahun' AND param1='$parameter'";
				}
				else
				{
					if(is_numeric($tahun))
					{
						$sql="INSERT INTO tabdin(`wilayah`, `tahun`, `nilai`, `satuan`, `param1`, `param2`,`param3`,
							`param4`, `table_inisial`) VALUES('$wil','$tahun','$nilainya','', '$parameter','','','','$id')";
					}
				}
			}
			
			//print_r($sql);
			//echo ;
			//echo $sql.'-'.$nilainya.'-'.$parameter.'<br/>';
			Yii::app()->db->createCommand($sql)->execute();
		}
	}
	*/

	public function update_me($id,$induk,$bulan,$tahun,$rencana,$realisasi){
		$sql="UPDATE pagu_satker SET jumlah={$rencana},realisasi={$realisasi} 
				WHERE m_induk={$induk} AND unit_kerja={$id} AND
					bulan={$bulan} AND tahun={$tahun}";
		Yii::app()->db->createCommand($sql)->execute();
	}

	public function report_me($unit_kerja,$tahun){
		$sql="SELECT
				  m_induk,
				label,
				  sum(if(bulan = 1, jumlah, 0))  AS Jan,
				  sum(if(bulan = 2, jumlah, 0))  AS Feb,
				  sum(if(bulan = 3, jumlah, 0))  AS Mar,
				  sum(if(bulan = 4, jumlah, 0))  AS Apr,
				  sum(if(bulan = 5, jumlah, 0))  AS May,
				  sum(if(bulan = 6, jumlah, 0))  AS Jun,
				  sum(if(bulan = 7, jumlah, 0))  AS Jul,
				  sum(if(bulan = 8, jumlah, 0))  AS Aug,
				  sum(if(bulan = 9, jumlah, 0))  AS Sep,
				  sum(if(bulan = 10, jumlah, 0)) AS Oct,
				  sum(if(bulan = 11, jumlah, 0)) AS Nov,
				  sum(if(bulan = 12, jumlah, 0)) AS `Dec`,

				  sum(if(bulan = 1, realisasi, 0))  AS Janr,
				  sum(if(bulan = 2, realisasi, 0))  AS Febr,
				  sum(if(bulan = 3, realisasi, 0))  AS Marr,
				  sum(if(bulan = 4, realisasi, 0))  AS Aprr,
				  sum(if(bulan = 5, realisasi, 0))  AS Mayr,
				  sum(if(bulan = 6, realisasi, 0))  AS Junr,
				  sum(if(bulan = 7, realisasi, 0))  AS Julr,
				  sum(if(bulan = 8, realisasi, 0))  AS Augr,
				  sum(if(bulan = 9, realisasi, 0))  AS Sepr,
				  sum(if(bulan = 10, realisasi, 0)) AS Octr,
				  sum(if(bulan = 11, realisasi, 0)) AS Novr,
				  sum(if(bulan = 12, realisasi, 0)) AS `Decr`

				FROM pagu_satker p, m_induk i
				WHERE unit_kerja={$unit_kerja} AND i.id=p.m_induk AND tahun={$tahun}
				GROUP BY m_induk";

        return Yii::app()->db->createCommand($sql)->queryAll();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaguSatker the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
