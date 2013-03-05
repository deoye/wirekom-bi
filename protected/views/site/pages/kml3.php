<?php
Yii::import('ext.kml.*');
$kml = new EGMapKMLFeed();
// create a line style
// colors of Styles are compound like this:
// OPACITY[2]=FF - RED[2]=AA - GREEN[2]=00 - BLUE[2]=FF
// in hexadecimal code
$lineStyle = new EGMapKMLLineStyle('lineStyleID', 'lineID', 'FFAA00FF', '4');
 
$kml->addTag($lineStyle);
 
// create the Polygon Placemark
$placemark = new EGMapKMLPlacemark('Polygon','Just testing polygon', '#lineStyleID');
 
// Add a Polygon Child dynamically.
// Please see how the first coordinate is equal to
// the last coordinate, this is necessary to close 
// the polygon on the map
$placemark->addChild(new EGMapKMLPolygon(true, array('-122.1,37.4,0',
            '-122.0,37.4,0', '-122.0,37.5,0', '-122.1,37.5,0', '-122.1,37.4,0')));
 
$kml->addTag($placemark);
 
 
// generate feed
$kml->generateFeed();
?>
