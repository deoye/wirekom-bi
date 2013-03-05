<?php

Yii::import('ext.egmap.*');
$gMap = new EGMap();
$gMap->setJsName('test_map');
$gMap->width = '100%';
$gMap->height = 300;
$gMap->zoom = 4;
$gMap->setCenter(25.774252, -80.190262);

$bounds = new EGMapBounds(new EGMapCoord(25.774252, -80.190262), new EGMapCoord(32.321384, -64.75737));
$rec = new EGMapRectangle($bounds);
$rec->addHtmlInfoWindow(new EGMapInfoWindow('Hey! I am a rectangle!'));

$gMap->addRectangle($rec);

$gMap->renderMap();
?>
