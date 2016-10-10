
<div class="search_group">
    <form method="get">
        <div class="search_group_right float_clear initial">
            <h1>查询条件</h1>
            <div class="bton1" title="缩起"><a>缩起</a></div>
            <div class="bton2" id="show_hiden" title="展开"><a>展开</a></div>	
            <div class="search">
                <label class="control_label" >用户名</label>
                <input type="text" name="user_name_like" value="<?php echo $this->input->get('user_name_like'); ?>" class=" input_medium search_query" />
            </div>     
            <div class="search">
                <label class="control_label" >电话</label>
                <input type="text" name="phone_like" value="<?php echo $this->input->get('phone_like'); ?>" class=" input_medium search_query" />
            </div> 
            <div class="search">
                <label class="control_label" >邮箱</label>
                <input type="text" name="email_like" value="<?php echo $this->input->get('email_like'); ?>" class=" input_medium search_query" />
            </div>     
            <div class="search">
                <label class="control_label" >地址</label>
                <input type="text" name="address_like" value="<?php echo $this->input->get('address_like'); ?>" class=" input_medium search_query" />
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

