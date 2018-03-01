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
class IndukKegiatan extends HelpAR
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
			array('name, tahun, created_by, created_time, updated_by, updated_time', 'required'),
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
