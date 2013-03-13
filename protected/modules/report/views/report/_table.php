<?php

if (!empty($data)) {
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'data-grid',
        'dataProvider' => new CArrayDataProvider($data, array(
            'keyField' => key($data[0]),
            'pagination' => array(
                'pageSize' => 5,
            ),
        )),
    ));
}
?>