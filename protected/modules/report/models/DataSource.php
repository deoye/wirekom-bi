<?php

/**
 * This is the model class for table "data_source".
 *
 * The followings are the available columns in table 'data_source':
 * @property integer $id
 * @property string $host
 * @property integer $port
 * @property string $dbname
 * @property string $username
 * @property string $password
 * @property string $created
 * @property string $updated
 *
 * The followings are the available model relations:
 * @property Kpi[] $kpis
 * @property Report[] $reports
 */
class DataSource extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DataSource the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'data_source';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('port', 'numerical', 'integerOnly' => true),
            array('host', 'length', 'max' => 255),
            array('dbname, username, password', 'length', 'max' => 45),
            array('created, updated', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, host, port, dbname, username, password, created, updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'kpis' => array(self::HAS_MANY, 'Kpi', 'data_source_id1'),
            'reports' => array(self::HAS_MANY, 'Report', 'data_source_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'host' => 'Host',
            'port' => 'Port',
            'dbname' => 'Dbname',
            'username' => 'Username',
            'password' => 'Password',
            'created' => 'Created',
            'updated' => 'Updated',
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
        $criteria->compare('host', $this->host, true);
        $criteria->compare('port', $this->port);
        $criteria->compare('dbname', $this->dbname, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getDsn() {
        $dsn = 'mysql:';
        $dsn .= 'host=' . $this->host;
        $dsn .= ';port=' . $this->port;
        $dsn .= ';dbname=' . $this->dbname;

        return $dsn;
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

}