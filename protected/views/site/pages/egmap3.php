<?php
Yii::import('ext.egmap.*');
$gMap = new EGMap();

$gMap->setWidth(512);
// it can also be called $gMap->height = 400;
$gMap->setHeight(400);
$gMap->zoom = 8;

// set center to inca
$gMap->setCenter(39.719588117933185, 2.9087440013885635);

// my house when i was a kid
$home = new EGMapCoord(39.720991014764536, 2.911801719665541);

// my ex-school
$school = new EGMapCoord(39.719456079114956, 2.8979293346405166);

// some stops on the way
$santo_domingo = new EGMapCoord(39.72118906848983, 2.907628202438368);
$plaza_toros = new EGMapCoord(39.71945607911511, 2.9049245357513565);
$paso_del_tren = new EGMapCoord(39.718762871171776, 2.903637075424208);

// Waypoint samples
$waypoints = array(
    new EGMapDirectionWayPoint($santo_domingo),
    new EGMapDirectionWayPoint($plaza_toros, false),
    new EGMapDirectionWayPoint($paso_del_tren, false)
);

// Initialize GMapDirection
$direction = new EGMapDirection($home, $school, 'direction_sample', array('waypoints' => $waypoints));

$direction->optimizeWaypoints = true;
$direction->provideRouteAlternatives = true;

$renderer = new EGMapDirectionRenderer();
$renderer->draggable = true;
$renderer->panel = "direction_pane";
$renderer->setPolylineOptions(array('strokeColor' => '#FFAA00'));

$direction->setRenderer($renderer);

$gMap->addDirection($direction);

$gMap->renderMap();
?>
<div id="direction_pane"></div>