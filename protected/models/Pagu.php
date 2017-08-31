<?php

/**
 * This is the model class for table "pagu".
 *
 * The followings are the available columns in table 'pagu':
 * @property integer $id
 * @property integer $m_output
 * @property integer $unit_kerja
 * @property string $jumlah
 * @property integer $tahun
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 * @property integer $m_induk
 *
 * The followings are the available model relations:
 * @property MInduk $mInduk
 * @property MOutput $mOutput
 * @property UnitKerja $unitKerja
 */
class Pagu extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pagu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_kerja, tahun, created_by, created_time, updated_by, updated_time', 'required'),
			array('m_output, unit_kerja, tahun, created_by, updated_by, m_induk', 'numerical', 'integerOnly'=>true),
			array('jumlah', 'length', 'max'=>20),
			array('label', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, m_output, unit_kerja, jumlah, tahun, created_by, created_time, updated_by, updated_time, m_induk', 'safe', 'on'=>'search'),
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
			'mOutput' => array(self::BELONGS_TO, 'MOutput', 'm_output'),
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
			'm_output' => 'Program / Kegiatan',
			'unit_kerja' => 'Unit Kerja',
			'jumlah' => 'Jumlah',
			'tahun' => 'Tahun',
			'created_by' => 'Created By',
			'created_time' => 'Created Time',
			'updated_by' => 'Updated By',
			'updated_time' => 'Updated Time',
			'm_induk' => 'M Induk',
			'revisi'	=>'Revisi',
			'tw1'	=>'Realisasi TW1',
			'tw2'	=>'Realisasi TW3',
			'tw3'	=>'Realisasi TW4',
			'tw4'	=>'Realisasi TW4',
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
		$criteria->compare('m_output',$this->m_output);
		$criteria->compare('unit_kerja',$this->unit_kerja);
		$criteria->compare('jumlah',$this->jumlah,true);
		$criteria->compare('tahun',$this->tahun);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('updated_by',$this->updated_by);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('m_induk',$this->m_induk);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pagu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function TotalPaguProv($tahun){
		$sql="SELECT SUM(jumlah) FROM pagu WHERE 
			unit_kerja IN(SELECT id FROM unit_kerja WHERE parent=1 AND jenis=1) 
			AND tahun={$tahun}";

		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public function TotalPaguRevisiProv($tahun){
		$sql="SELECT SUM(revisi) FROM pagu WHERE 
			unit_kerja IN(SELECT id FROM unit_kerja WHERE parent=1 AND jenis=1) 
			AND tahun={$tahun}";

		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public function TotalPaguRealisasiProv($tahun,$tw){
		$sql="SELECT SUM(tw$tw) FROM pagu WHERE 
			unit_kerja IN(SELECT id FROM unit_kerja WHERE parent=1 AND jenis=1) 
			AND tahun={$tahun}";

		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public function TotalPaguKab($tahun,$kode){
		$sql="SELECT SUM(jumlah) FROM pagu WHERE 
			unit_kerja IN(SELECT id FROM unit_kerja WHERE code={$kode}) 
			AND tahun={$tahun}";

		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public static function PaguKab($output, $satker, $tahun)
	{
		$sql="SELECT SUM(jumlah) FROM pagu WHERE 
			unit_kerja={$satker} AND m_output={$output} AND tahun={$tahun}";

		return Yii::app()->db->createCommand($sql)->queryScalar();
	}
}
