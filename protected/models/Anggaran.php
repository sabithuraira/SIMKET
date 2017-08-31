<?php

/**
 * This is the model class for table "anggaran".
 *
 * The followings are the available columns in table 'anggaran':
 * @property integer $id
 * @property integer $unit_kerja
 * @property string $jumlah
 * @property integer $m_o_from
 * @property integer $m_o_to
 * @property string $ket
 * @property integer $jenis
 * @property integer $created_by
 * @property string $created_time
 * @property integer $updated_by
 * @property string $updated_time
 *
 * The followings are the available model relations:
 * @property MOutput $mOFrom
 * @property MOutput $mOTo
 * @property UnitKerja $unitKerja
 */
class Anggaran extends HelpAr
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'anggaran';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('unit_kerja, jumlah, m_o_to, ket, jenis, created_by, created_time, updated_by, updated_time', 'required'),
			array('unit_kerja, m_o_from, m_o_to, jenis, created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('jumlah', 'length', 'max'=>13),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, unit_kerja, jumlah, m_o_from, m_o_to, ket, jenis, created_by, created_time, updated_by, updated_time', 'safe', 'on'=>'search'),
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
			'mOFrom' => array(self::BELONGS_TO, 'MOutput', 'm_o_from'),
			'mOTo' => array(self::BELONGS_TO, 'MOutput', 'm_o_to'),
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
			'unit_kerja' => 'Unit Kerja',
			'jumlah' => 'Jumlah',
			'm_o_from' => 'Asal Anggaran (Kosongkan pilihan ini jika anggaran ditambahkan bukan berbentuk pemindahan anggaran)',
			'm_o_to' => 'Dipindahakan ke / Masuk ke',
			'ket' => 'Keterangan',
			'jenis' => 'Jenis',
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
		$criteria->compare('unit_kerja',$this->unit_kerja);
		$criteria->compare('jumlah',$this->jumlah,true);
		$criteria->compare('m_o_from',$this->m_o_from);
		$criteria->compare('m_o_to',$this->m_o_to);
		$criteria->compare('ket',$this->ket,true);
		$criteria->compare('jenis',$this->jenis);
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
	 * @return Anggaran the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
