<?php echo js("js/jquery.js");?>
<!-- 查询版块-->
<div class="search_group">
    <form method="get">
        <!-- “ initial ”有这个class表示当前是缩起状态
        “initial ”去掉这个class表示当前是展开状态-->
        <div class="search_group_right float_clear initial">
            <h1>查询条件</h1>

            <?php foreach ($this->$modelname->list_array as $k => $v): ?>
                <div class="search">
                    <label class="control_label"><?php echo $v; ?></label>
                    <input type="text" name="<?php echo $k,'_like'; ?>" id="<?php echo $k; ?>" placeholder="" value="<?php echo $this->input->get($k); ?>" class="input_medium search_query">
                </div>
            <?php endforeach; ?>
            
            <div class="search_butGroup float_left">
                <button type="submit" class="btn btn_style1"><span>查询</span></button>
                <button type="reset" class="btn btn_style1"><span>重置</span></button>
            </div>
            <div class="float_clear"></div>
        </div>
    </form>
</div>
<script type="text/javascript">
$(function(){
     $("#show_hiden").toggle(
    function () {
      $(this).parent('div').removeClass('initial');
      $(this).removeClass('bton2');
      $(this).addClass('bton1');
    },
    function () {
      $(this).parent('div').addClass('initial');
      $(this).addClass('bton2');
      $(this).removeClass('bton1');
    }
  );

})

</script>
