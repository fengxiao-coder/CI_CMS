

<?php foreach ($goods_evaluationr as $value) { ?>
    <div class="app_list">
        <ul class="userinfo">
            <li class="user_pic"><img src="<?php echo site_url($this->user_model->get_value_by_pk($value['user_id'], 'avatar')); ?>" /></li>
            <li class="blue"><?php echo $this->user_model->get_value_by_pk($value['user_id'], 'user_name'); ?></li>
        </ul>
        <ul class="appinfo">
            <li><?php echo $value['content']; ?></li>
            <li class="c333"><?php echo init_date($value['created_time']); ?></li>
        </ul>
        <?php if ($value['reply'][0]) { ?>
            <?php foreach ($value['reply'] as $key => $val) {
                ?>
                <div class="float_clear" style="color:#900"> 
                    <div class="userinfo"><?php
                        if ($key === 0) {
                            echo "管理员回复：";
                        }
                        ?></div>
                    <div class="appinfo"><?php echo $val['content']; ?><br><?php echo init_date($val['created_time']); ?></div>
                </div>
            <?php } ?>
        <?php } ?>    
        <div class="clear"></div>
    </div>
<?php } ?> 
<div class="row">
    <div class="btn_toolbar">
        <div class="btn_group">
            <?php
            if ($total > $per) {
                echo $pagelist;
            }
            ?>
        </div>
    </div>
</div>



