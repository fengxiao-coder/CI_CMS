<?php echo js("js/jquery.js"); ?>
<!-- 查询版块-->
<div class="search_group">
    <form method="get">
        <div class="search_group_right float_clear initial">
            <h1>查询条件</h1>	 
            <div class="search">
                <label class="control_label" >名称</label>
                <input type="text" name="name_like" value="<?php echo $this->input->get('name_like'); ?>" class=" input_medium search_query" />
            </div>
            <div class="search_butGroup float_left">
                <button type="submit" class="btn btn_style1"><span>查询</span></button>
                <button type="reset" class="btn btn_style1"><span>重置</span></button>
            </div>
            <div class="float_clear"></div>
        </div>
    </form>
</div>


