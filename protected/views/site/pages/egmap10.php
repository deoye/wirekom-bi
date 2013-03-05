<?php

Yii::import('ext.egmap.*');

$gMap = new EGMap();
$gMap->setWidth(500);
$gMap->setHeight(400);
$gMap->zoom = 5;

$sample_address = 'Czech Republic, Prague, Olivova';

// Create geocoded address
$geocoded_address = new EGMapGeocodedAddress($sample_address);
$geocoded_address->geocode($gMap->getGMapClient());

// Center the map on geocoded address
$gMap->setCenter($geocoded_address->getLat(), $geocoded_address->getLng());

// Add marker on geocoded address
$gMap->addMarker(
        new EGMapMarker($geocoded_address->getLat(), $geocoded_address->getLng())
);

$gMap->renderMap();
?>
