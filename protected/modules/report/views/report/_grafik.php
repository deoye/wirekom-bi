<?php

if (!empty($data)) {
    $tmp = array();
    foreach ($data as $key => $row)
        foreach ($row as $skey => $value)
            $tmp[$skey][$key] = is_numeric($value) ? intval($value) : $value;
    $arr = array();
    foreach ($data[0] as $key => $value)
        $arr[] = array('name' => $key, 'data' => $tmp[$key]);

    $categories = $arr[0]['data'];
    $x_title = $arr[0]['name'];
    array_splice($arr, 0, 1);

    $this->widget('ext.highcharts.HighchartsWidget', array(
        'id' => 'grafik',
        'options' => array(
            'chart' => array('defaultSeriesType' => 'bar'),
            'title' => array('text' => $title),
            'legend' => array('enabled' => true),
            'xAxis' => array(
                'categories' => $categories,
                'title' => array(
                    'text' => $x_title,
                )
            ),
            'yAxis' => array(
                'min' => 0,
                'max' => 100,
                'title' => array(
                    'text' => 'Qty'
                ),
            ),
            'series' => $arr,
//        'tooltip' => array('formatter' => 'js:function() {return "<b>"+ this.x +"</b><br/>"+"Jumlah : "+ this.y; }'),
            'plotOptions' => array(
                'line' => array(
                    'allowPointSelect' => true,
                    'showInLegend' => true,
                    'cursor' => 'pointer',
                )
            ),
            'credits' => array('enabled' => false),
        )
    ));
}
?>