<?php

if ($model->parameter !== null)
    echo $this->renderPartial('_param', array('parameter' => json_decode($model->parameter)));
if ($reader !== null) {
    if ($model->bentuk_id == 1)
        echo $this->renderPartial('_table', array('data' => $reader));
    else if ($model->bentuk_id == 2)
        echo $this->renderPartial('_grafik', array('data' => $reader, 'title' => $model->name));
}
?>