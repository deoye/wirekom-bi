<?php

/**
 * This is the model class for table "kpi".
 *
 * The followings are the available columns in table 'kpi':
 * @property integer $id
 * @property string $name
 * @property string $query
 * @property string $advice
 * @property integer $target
 * @property string $created
 * @property string $updated
 * @property integer $user_id
 * @property integer $data_source_id
 *
 * The followings are the available model relations:
 * @property DataSource $dataSource
 * @property User $user
 */
class Kpi extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Kpi the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'kpi';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('target, user_id, data_source_id', 'required'),
            array('target, user_id, data_source_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('query, advice, created, updated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, query, advice, target, created, updated, user_id, data_source_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'dataSource' => array(self::BELONGS_TO, 'DataSource', 'data_source_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'query' => 'Query',
            'advice' => 'Advice',
            'target' => 'Target',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_id' => 'User',
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
        $criteria->compare('query', $this->query, true);
        $criteria->compare('advice', $this->advice, true);
        $criteria->compare('target', $this->target);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('user_id', $this->user_id);
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
    
    public function getHasil() {        
        $dbCon = new CDbConnection($this->dataSource->getDsn(), $this->dataSource->username, $this->dataSource->password);
        $dbCon->active = true;

        return $dbCon->createCommand($this->query)->queryScalar();
    }
    
    public function getStatus() {        
        return ($this->getHasil() >= $this->target) ? 'Terpenuhi' : 'Tidak Terpenuhi';
    }
    
}