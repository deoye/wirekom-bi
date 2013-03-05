<?php
Yii::import('ext.kml.*');
 
$kml = new EGMapKMLFeed();
// create a line style
$lineStyle = new EGMapKMLLineStyle('lineStyleID', 'lineID', 'FFAA00FF', '4');
 
$kml->addTag($lineStyle);
 
// create a Placemark LineString, specifying its info and style
$placemark = new EGMapKMLPlacemark('LineString','Just testing this line', '#lineStyleID');
 
// create the linestring and give it the coordinates
// coordinates go on LONGITUDE, LATITUDE, ELEVATION
$line = new EGMapKMLLineString(
array(
'-87.89289951324463,41.97881025520548,0',
'-87.89184808731079,41.97788506340239,0',
'-87.89150476455688,41.97762983571196,0',
'-87.8912901878357,41.97750222148314,0',
'-87.89090394973755,41.977326751500996,0',
'-87.89047479629517,41.97719913666485,0',
'-87.88987398147583,41.97707152157296,0',
'-87.88912296295166,41.97702366584759,0',
'-87.88856506347656,41.97708747347342,0',
'-87.88757801055908,41.977326751500996,0',
'-87.87487506866455,41.982574690129766,0',
'-87.87399530410767,41.9828777493635,0',
'-87.87305116653442,41.983101055244255,0',
'-87.87238597869873,41.983196757524844,0',
'-87.87172079086304,41.98327650931544,0'
));
 
// add Child Node to the placemark
$placemark->addChild( $line );
 
// add Placemark to the Feed Generator
$kml->addTag($placemark);
 
// generate feed
$kml->generateFeed();
?>
