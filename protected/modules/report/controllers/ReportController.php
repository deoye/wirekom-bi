<?php

class ReportController extends Controller {

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
        $params = null;
        $model = $this->loadModel($id);
        $data = array(
            'model' => $model,
            'params' => $params,
            'reader' => null,
        );

        if (empty($model->parameter)) {
            $data['reader'] = $this->executeQuery($id);
        } else {
            if (isset($_POST['params'])) {
                $params = $_POST['params'];
                $data['reader'] = $this->executeQuery($id, $params);
            }
        }
        $this->render('view', $data);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $this->layout = '/layouts/column1';
        $model = new Report;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Report'])) {
            $model->attributes = $_POST['Report'];
            if (isset($_POST['param'])) {
                $tmp = array();
                foreach ($_POST['param'] as $val)
                    $tmp[] = $val;
                $model->parameter = json_encode($tmp);
            }
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
        $this->layout = '/layouts/column1';
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Report'])) {
            $model->attributes = $_POST['Report'];
            if (isset($_POST['param'])) {
                $tmp = array();
                foreach ($_POST['param'] as $val)
                    $tmp[] = $val;
                $model->parameter = json_encode($tmp);
            }
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
        $dataProvider = new CActiveDataProvider('Report');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Report('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Report']))
            $model->attributes = $_GET['Report'];

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
        $model = Report::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'report-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function executeQuery($id, $params = null) {
        $report = $this->loadModel($id);
        $dbCon = new CDbConnection($report->dataSource->getDsn(), $report->dataSource->username, $report->dataSource->password);
        $dbCon->active = true;
        if ($params !== null)
            foreach ($params as $key => $val) {
                $var = '$P{var}';
                $tmp = str_replace('var', $key, $var);


                $report->query = str_replace($tmp, $val, $report->query);
            }


        return $dbCon->createCommand($report->query)->queryAll();
    }

    public function actionExportPdf($id) {
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        Yii::import('application.vendors.PHPExcel.PHPExcel', true);
        spl_autoload_register(array('YiiBase', 'autoload'));

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Widodo Pangestu")
                ->setLastModifiedBy("Widodo Pangestu")
                ->setTitle("PDF Test Document")
                ->setSubject("PDF Test Document")
                ->setDescription("Test document for PDF, generated using PHP classes.")
                ->setKeywords("pdf php")
                ->setCategory("Test result file");

        $reader = $this->executeQuery($id);
        $no = '1';
        foreach ($reader as $row) {
            $char = 'A';
            foreach ($row as $key => $value) {
                $objPHPExcel->setActiveSheetIndex(0)->getCell("$char$no")->setValue($value);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle("$char$no")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $char++;
            }
            $no++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Report App');
        $objPHPExcel->getActiveSheet()->setShowGridLines(false);

        $objPHPExcel->setActiveSheetIndex(0);


        if (!PHPExcel_Settings::setPdfRenderer(
                        PHPExcel_Settings::PDF_RENDERER_MPDF, Yii::getPathOfAlias('application.vendors.mpdf')
        )) {
            die(
                    'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
                    '<br />' .
                    'at the top of this script as appropriate for your directory structure'
            );
        }


// Redirect output to a client鈥檚 web browser (PDF)
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename="report_app.pdf"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
        $objWriter->save('php://output');
        exit;
    }

    public function actionExportXls($id) {
        spl_autoload_unregister(array('YiiBase', 'autoload'));
        Yii::import('application.vendors.PHPExcel.PHPExcel', true);
        spl_autoload_register(array('YiiBase', 'autoload'));
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Widodo Pangestu")
                ->setLastModifiedBy("Widodo Pangestu")
                ->setTitle("PDF Test Document")
                ->setSubject("PDF Test Document")
                ->setDescription("Test document for PDF, generated using PHP classes.")
                ->setKeywords("pdf php")
                ->setCategory("Test result file");

        $reader = $this->executeQuery($id);
        $no = '1';
        foreach ($reader as $row) {
            $char = 'A';
            foreach ($row as $key => $value) {
                $objPHPExcel->setActiveSheetIndex(0)->getCell("$char$no")->setValue($value);
                $objPHPExcel->setActiveSheetIndex(0)->getStyle("$char$no")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $char++;
            }
            $no++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Report App');
        $objPHPExcel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report_app.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

}
