<?php

Yii::import('ext.egmap.*');

$gMap = new EGMap();
// using the new magic setters
// check available options per class
// objects with setMethod,getMethod and
// options array can be set now this way
$gMap->zoom = 10;
$mapTypeControlOptions = array(
    // yes we can position the controls now
    // where we want
    'position' => EGMapControlPosition::LEFT_BOTTOM,
    'style' => EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
);

$gMap->mapTypeControlOptions = $mapTypeControlOptions;

// enabling KML Service. Second parameter of this 
// function tells whether is localhost or not. GeoXML3.js 
// is needed to read localhost KML files.
$gMap->enableKMLService('http://proposal.wirekom.co.id/uploads/cta.kml');

$gMap->renderMap();
//echo CHtml::normalizeUrl(array('/site/kml1'));
// http://localhost:82/hrd2/site/kml1
?>
