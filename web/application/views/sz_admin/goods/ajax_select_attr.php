<style type="text/css">
    .x_span {
       // background-color:#fc0;
        display:-moz-inline-box;
        display:inline-block;
        width:80px; 
    }
</style>
<?php if ($select_item_data) { ?>
    <?php foreach ($select_item_data as $key => $value) { ?>
        <?php if ($value['attr_input_type'] == 3) { ?>
            <div>
                <span>&nbsp;<?php echo $this->goods_attribute_model->get_value_by_pk($value['attr_id'], 'attr_name'); ?></span>
                <?php foreach ($value['attr_value'] as $key1 => $value1) { ?>
                    <label>
                        <input name="attr_value[<?php echo $value['attr_id']; ?>][<?php echo $key1; ?>]" <?php
                        foreach ($goods_attr as $k => $v) {
                            if ($v['attr_id'] == $value['attr_id'] && $v['attr_value'] == $value1) {
                                ?> checked="checked" <?php
                                   }
                               }
                               ?> type="checkbox" value="<?php echo $value1; ?>" /><?php echo $value1; ?> 
                    </label> 
                <?php } ?>
                <?php echo"</br>" ?> 
            </div>
        <?php } else { ?>
            <div>
                <span class="x_span">&nbsp;<?php echo $this->goods_attribute_model->get_value_by_pk($value['attr_id'], 'attr_name'); ?></span>
                <label>
                    <input class="x_inpt_border" name="attr_value[<?php echo $value['attr_id']; ?>][<?php echo $key; ?>]" type="text" value="<?php
                           foreach ($goods_attr as $ke => $val) {
                               if ($val['attr_id'] == $value['attr_id']) {
                                   echo $val['attr_value'];
                               } else {
                                   echo $value[0];
                               }
                           }
                           ?>" /> 
                </label> 
                <?php echo"</br>" ?> 
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>



