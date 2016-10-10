<?php //echo js("js/jquery.js"); ?>
<!-- 查询版块-->
<div class="search_group">
    <form method="get">
        <!-- “ initial ”有这个class表示当前是缩起状态
        “initial ”去掉这个class表示当前是展开状态-->
        <div class="search_group_right float_clear initial">
            <h1>查询条件</h1>
            <div class="bton1" title="缩起"><a>缩起</a></div>
            <div class="bton2" id="show_hiden" title="展开"><a>展开</a></div>	
                      
            <div class="search">
                <label class="control_label" >品牌</label>
                    <select name="brand_id" >
                        <option value="">--请选择--</option>>
                        <?php foreach ($brand_name as $k=>$v) {?>
                        <option value="<?php echo $v['brand_id'];?>" <?php echo $this->input->get('brand_id') == $v['brand_id']?"selected='selected'":"";?>><?php echo $v['brand_name'];?></option>
                        <?php } ?>
                    </select>            
            </div>
            
            <div class="search">
                <label class="control_label" >类别</label>
                    <select name="pid" >
                        <option value="">--请选择--</option>>
                        <?php foreach ($goods_category as $k=>$v) {?>
                        <option value="<?php echo $k;?>" <?php echo $this->input->get('pid') == $k?"selected='selected'":"";?>><?php echo $v;?></option>
                        <?php } ?>
                    </select>              </div>
            <div class="search">
                <label class="control_label" >商品名称</label>
                <input type="text" name="name_like" value="<?php echo $this->input->get('name_like'); ?>" class=" input_medium search_query" />
            </div>
            <div class="search">
                <label class="control_label" >商品编码</label>
                <input type="text" name="goods_sn_like" value="<?php echo $this->input->get('goods_sn_like'); ?>" class=" input_medium search_query" />
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

    })

</script>


