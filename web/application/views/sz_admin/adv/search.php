<?php //echo js("js/jquery.js"); ?>
<!-- 查询版块-->
<div class="search_group">
    <form method="get">
        <div class="search_group_right float_clear initial">
            <h1>查询条件</h1>
           
            <div class="search">
                <label class="control_label" >名称</label>
                <input type="text" name="adv_title_like" value="<?php echo $this->input->get('adv_title_like'); ?>" class=" input_medium search_query" />
            </div>
            <div class="search">
                <label class="control_label" >内容</label>
                <input type="text" name="adv_content_like" value="<?php echo $this->input->get('adv_content_like'); ?>" class=" input_medium search_query" />
            </div>
           
            <div class="search_butGroup float_left">
                <button type="submit" class="btn btn_style1"><span>查询</span></button>
                <button type="reset" class="btn btn_style1"><span>重置</span></button>
            </div>
            <div class="float_clear"></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(function () {
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
    });
</script>

