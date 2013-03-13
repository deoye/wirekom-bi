<form id="param-form" method="post">
    <div class="form">
        <?php foreach ($parameter as $val) : ?>
            <div class="row">
                <label for="<?php echo $val->name; ?>"><?php echo $val->label; ?></label>
                <?php if ($val->type == 1) : ?>
                    <input id="param-<?php echo $val->name; ?>" type="text" name="params[<?php echo $val->name; ?>]" />
                <?php elseif ($val->type == 2) : ?>

                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'id' => 'param-' . $val->name,
                        'name' => 'params[' . $val->name . ']',
                        'attribute' => 'outset_movable',
                        'options' => array(
                            'rows' => 1,
                            'cols' => 10,
                            'showAnim' => 'fold',
                            'showButtonPanel' => true,
                            'autoSize' => true,
                            'dateFormat' => 'yy-mm-dd',
                        ),
                    ));
                    ?>(yyyy-mm-dd)
                <?php elseif ($val->type == 3) : ?>
                    <select id="param-<?php echo $val->name; ?>" name="params[<?php echo $val->name; ?>]">
                    </select>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="row buttons">
            <input type="submit" name="submit-param" value="Submit" />               
        </div>
    </div>
</form>