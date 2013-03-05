<?php

class DataSourceController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $dataSource = $this->loadModel($id);
        $dsn = 'mysql:';
        $dsn .= 'host=' . $dataSource->host;
        $dsn .= ';port=' . $dataSource->port;
        $dsn .= ';dbname=' . $dataSource->dbname;
        $MyDbCon = new CDbConnection($dsn, $dataSource->username, $dataSource->password);
        $MyDbCon->active = true;
        $this->render('view', array(
            'model' => $dataSource,
            'MyDbCon' => $MyDbCon,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new DataSource;
        $model->port = 3336;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['DataSource'])) {
            $model->attributes = $_POST['DataSource'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['DataSource'])) {
            $model->attributes = $_POST['DataSource'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('DataSource');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new DataSource('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['DataSource']))
            $model->attributes = $_GET['DataSource'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = DataSource::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'data-source-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetData() {
        $dsn = 'mysql:';
        $dsn .= 'host=' . $_GET['host'];
        $dsn .= ';port=' . $_GET['port'];
        $dsn .= ';dbname=' . $_GET['dbname'];
        $dbCon = new CDbConnection($dsn, $_GET['username'], $_GET['password']);
        $dbCon->active = true;
        $data = array();
        $data['title'] = $dsn;
        $data['key'] = $_GET['dbname'];
        $data['expand'] = true;
        $data['children'] = array();

        $dbSchema = $dbCon->getSchema();
        $tables = array();
        foreach ($dbSchema->getTableNames() as $table) {
            $tKey = $_GET['dbname'] . '.' . $table;
            $columns = array();
            $tabelSchema = $dbSchema->getTable($table);
            foreach ($tabelSchema->getColumnNames() as $column) {
                $columnSchema = $tabelSchema->getColumn($column);

                $cKey = $tKey . '.' . $column;
                $columns[] = array('title' => $column, 'key' => $cKey, 'isForeignKey' => $columnSchema->isForeignKey);
            }
            $tables[] = array('title' => $table, 'key' => $tKey, 'isFolder' => true, 'children' => $columns);
        }
        $data['children'] = $tables;
        echo CJSON::encode($data);
    }

    public function actionGetDataById($data_source_id) {
        $dataSource = DataSource::model()->findByPk($data_source_id);
        $dsn = 'mysql:';
        $dsn .= 'host=' . $dataSource->host;
        $dsn .= ';port=' . $dataSource->port;
        $dsn .= ';dbname=' . $dataSource->dbname;
        $dbCon = new CDbConnection($dsn, $dataSource->username, $dataSource->password);
        $dbCon->active = true;
        $data = array();
        $data['type'] = 'db';
        $data['title'] = $dsn;
        $data['key'] = $dataSource->dbname;
        $data['href'] = Yii::app()->request->baseUrl . '/report/dataSource/view/id/' . $data_source_id;
        $data['expand'] = true;
        $data['children'] = array();

        $dbSchema = $dbCon->getSchema();
        $tables = array();
        foreach ($dbSchema->getTableNames() as $table) {
            $tabelSchema = $dbSchema->getTable($table);
            $tKey = $dataSource->dbname . '.' . $table;
            $columns = array();
            foreach ($tabelSchema->getColumnNames() as $column) {
                $columnSchema = $tabelSchema->getColumn($column);
                $cKey = $tKey . '.' . $column;
                $dColumn = array();
                $dColumn['type'] = 'cl';
                $dColumn['title'] = $column;
                $dColumn['key'] = $cKey;
                $dColumn['isForeignKey'] = $columnSchema->isForeignKey;
                $columns[] = $dColumn;
            }
            $dTable = array();
            $dTable['type'] = 'tb';
            $dTable['title'] = $table;
            $dTable['primaryKey'] = $tabelSchema->primaryKey;
            $dTable['foreignKeys'] = $tabelSchema->foreignKeys;
            $dTable['key'] = $tKey;
            $dTable['isFolder'] = true;
            $dTable['children'] = $columns;
            $tables[] = $dTable;
        }
        $data['children'] = $tables;
        echo CJSON::encode($data);
    }

}
