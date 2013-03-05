<?php

Yii::import('ext.egmap.*');
$gMap = new EGMap();
$gMap->setJsName('test_map');
$gMap->width = '100%';
$gMap->height = 300;
$gMap->zoom = 4;
$gMap->setCenter(25.774252, -80.190262);

$coords = array(
    new EGMapCoord(25.774252, -80.190262),
    new EGMapCoord(18.466465, -66.118292),
    new EGMapCoord(32.321384, -64.75737),
    new EGMapCoord(25.754252, -56.190262)
);

$polygon = new EGMapPolygon($coords);
$polygon->addHtmlInfoWindow(new EGMapInfoWindow('Hey! I am a polygon!'));
$gMap->addPolygon($polygon);

$gMap->renderMap();
?>
