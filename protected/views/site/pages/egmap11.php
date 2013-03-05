<?php

Yii::import('ext.egmap.*');

$e = new EGMapElevationInfo(
                array('25.774252, -80.190262',
                    '18.466465, -66.118292',
                    new EGMapCoord(32.321384, -64.75737), /* we can also use EGMapCoord */
                    new EGMapCoord(25.774252, -80.190262)));

$e->elevationRequestJson(new EGMapClient());
$loc = $e->getLocations();

foreach ($loc as $l) {
    echo $l->lat . '<br/>';
    echo $l->lng . '<br/>';
    echo $l->resolution . '<br/>';
    echo $l->elevation . '<br/>';
    echo '--------------<br/>';
}
?>
