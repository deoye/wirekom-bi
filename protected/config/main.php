<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'REPORT APP',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
        'application.modules.report.models.*',
        'application.modules.report.components.*',
//        'application.extensions.debugtoolbar.*',
//        'application.vendors.PHPExcel.*',
//        'application.vendors.mpdf.*',
    ),
    'defaultController' => 'report/report',
    // application modules
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'pangestu',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'rights' => array(
            'debug' => true,
//            'install' => true,
            'enableBizRuleData' => true,
        ),
        'report',
    ),
    // application components
    'components' => array(
        'widgetFactory' => array(
            'widgets' => array(
                'CGridView' => array(
                    'htmlOptions' => array('cellspacing' => '0', 'cellpadding' => '0'),
                    'itemsCssClass' => 'item-class',
                    'pagerCssClass' => 'pager-class'
                ),
                'CJuiTabs' => array(
                    'htmlOptions' => array('class' => 'shadowtabs'),
                ),
                'CJuiAccordion' => array(
                    'htmlOptions' => array('class' => 'shadowaccordion'),
                ),
                'CJuiProgressBar' => array(
                    'htmlOptions' => array('class' => 'shadowprogressbar'),
                ),
                'CJuiSlider' => array(
                    'htmlOptions' => array('class' => 'shadowslider'),
                ),
                'CJuiSliderInput' => array(
                    'htmlOptions' => array('class' => 'shadowslider'),
                ),
                'CJuiButton' => array(
                    'htmlOptions' => array('class' => 'shadowbutton'),
                ),
                'CJuiButton' => array(
                    'htmlOptions' => array('class' => 'shadowbutton'),
                ),
                'CJuiButton' => array(
                    'htmlOptions' => array('class' => 'button green'),
                ),
            ),
        ),
        'user' => array(
            'class' => 'RWebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=report',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root123',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'authitem',
            'itemChildTable' => 'authitemchild',
            'assignmentTable' => 'authassignment',
            'rightsTable' => 'rights',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'request' => array(
            'enableCsrfValidation' => false,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'urlSuffix' => '.html',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // debug toolbar configuration
//                array(
//                    'class' => 'XWebDebugRouter',
//                    'config' => 'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
//                    'levels' => 'error, warning, trace, profile, info',
//                    'allowedIPs' => array('127.0.0.1'),
//                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);
