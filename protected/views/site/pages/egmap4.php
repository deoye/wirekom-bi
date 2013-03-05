<?php

Yii::import('ext.egmap.*');

$gMap = new EGMap();
$gMap->zoom = 8;
// set center to inca
$gMap->setCenter(39.719588117933185, 2.9087440013885635);
$gMap->width = 400;
$gMap->height = 400;
// Enable Key Drag Zoom
$zoom_options = array(
    'visualEnabled' => true,
    'boxStyle' => array(
        'border' => '4px dashed black', // strings with double quoted inside!
        'backgroundColor' => 'transparent',
        'opacity' => 1.0
    ),
    'veilStyle' => array(
        'backgroundColor' => 'red',
        'opacity' => 0.35,
        'cursor' => 'crosshair'
        ));

$drag_Zoom = new EGMapKeyDragZoom($zoom_options);

$gMap->enableKeyDragZoom($drag_Zoom);

$gMap->renderMap();
?>
