<?php

/**
 * This is the model class for table "report".
 *
 * The followings are the available columns in table 'report':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $query
 * @property string $created
 * @property string $updated
 * @property integer $bentuk_id
 * @property integer $data_source_id
 *
 * The followings are the available model relations:
 * @property Bentuk $bentuk
 * @property DataSource $dataSource
 * @property User[] $users
 */
class Report extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Report the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'report';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('bentuk_id, data_source_id', 'required'),
            array('bentuk_id, data_source_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('description, query, created, updated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, description, query, parameter, created, updated, bentuk_id, data_source_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bentuk' => array(self::BELONGS_TO, 'Bentuk', 'bentuk_id'),
            'dataSource' => array(self::BELONGS_TO, 'DataSource', 'data_source_id'),
            'users' => array(self::HAS_MANY, 'User', 'report_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'query' => 'Query',
            'parameter' => 'Parameter',
            'created' => 'Created',
            'updated' => 'Updated',
            'bentuk_id' => 'Bentuk',
            'data_source_id' => 'Data Source',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('query', $this->query, true);
        $criteria->compare('parameter', $this->parameter, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('bentuk_id', $this->bentuk_id);
        $criteria->compare('data_source_id', $this->data_source_id);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function behaviors() {
        return array(
            'timestamps' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'updated',
                'setUpdateOnCreate' => true,
            ),
        );
    }

    public function getDataSourceOptions() {
        return CHtml::listData(DataSource::model()->findAll(), 'id', 'dbname');
    }

    public function getBentukOptions() {
        return CHtml::listData(Bentuk::model()->findAll(), 'id', 'name');
    }

}