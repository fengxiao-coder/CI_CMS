<?php 
$button = array("添加店铺"=>array("c_model"=>'add','url'=> base_url("sz_admin/store/add")));
$this->common->show_title_breadcrumb("store",$button);
?>

<?php $this->load->view_part($this->_site_path . "/store/search") ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/default/css/print.css'); ?>" media="print"/>

<div class="list_box">
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
            <form method="post" action="<?php echo base_url($this->_site_path . "/store/delete_all"); ?>" id="form">
                <table class="table table-striped table-condensed table-bordered">
                    <thead>
                        <tr class="table-thbg">
                            <th class="selection_box">
                                <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                            </th>
                            <th>店铺名称</th>
                            <th>邀请码</th>
                            <th>联系人</th>
                            <th>联系电话</th>
                            <th>地址</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($store_data as $single) {
                            $province = $this->user_province_model->get_value_by_pk($single['province'], "province_name");
                            $city = $this->user_city_model->get_value_by_pk($single['city'], "city_name");
                            $area = $this->user_area_model->get_value_by_pk($single['area'], "area_name");
                            ?>
                            <tr>
                                <td>
                                    <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" />
                                </td>				
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/store/view/{$single['id']}"); ?>';"><?php echo $single['sName'] ?></td>   
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/store/view/{$single['id']}"); ?>';"><?php echo $single['bar_code'] ?></td>
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/store/view/{$single['id']}"); ?>';"><?php echo $single['sUser'] ?></td>                        
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/store/view/{$single['id']}"); ?>';"><?php echo $single['sPhone'] ?></td>  
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/store/view/{$single['id']}"); ?>';"><?php echo $province . $city . $area . $single['sAddr'] ?></td>         
                                <td>
                                    <a href="<?php echo base_url($this->_site_path . "/store/edit/{$single['id']}"); ?>">修改</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- 表格底部帮助栏-->
                <div class="tips">
                    <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
                    <?php if($this->auth->check("store","delete_all")):?> 
                    <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
                    <?php endif;?>
                    <a class="printf btn_style1" href='javascript:void(0);' title="请打印店铺二维码" style="line-height: 25px;" id="printf">打&nbsp;印</a>
                    <!-- 分页开始-->
                    <?php echo $pagination; ?>
                    <!-- 分页结束-->
                </div>
                <input type="hidden" name="is_submit" value="1">
            </form>
            <!--tips 结束-->
        </div>
    </div>
</div>
<div style="display:none">    
    <div id="dv" class="Specimen">
        <h1>请输入打印份数</h1>
        <input  class="m_inpt_border" name="div" id="num" type="text" value="1"/>
        <br />
        <input class="btn_s  btn_info" type="button" value="确定" id="bt"/>
    </div>
</div>

</div>
<script type="text/javascript">
    $(function () {
        $("#bt").click(function () {
            var num = $("#num").val();
            var re = /^[1-9]\d{0,2}$/;
            if (re.test(num)) {
                target = "_blank"
                $('#form').attr('target', '_blank');
                $('#form').attr('action', '<?php echo base_url($this->_site_path . "/print_code/print_store") ?>/' + num);
                $('#form').submit();
                $.fancybox.close();
            } else {
                return false;
            }

        });
    })
</script>
<script type="text/javascript">
    $(function () {
        $("#printf").click(function () {
            $.fancybox({
                'type': 'inline',
                'hideOnOverlayClick': false,
                'hideOnContentClick': false,
                'enableEscapeButton': false,
                'autoDimensions': false,
                'width': "100%",
                'height': "100%",
                'href': '#dv',
            });
        });
    });
</script>
<script type="text/javascript">
//$(function () {
//	   $("#printf").click(function () {                        
//	        var num = prompt("请输入您打印份数", "1");
//	        var re = /^[1-9]\d{0,2}$/;
//	        if (re.test(num)) {
//	             target = "_blank"
//	             $('#form').attr('target', '_blank');
//	             $('#form').attr('action', '<?php //echo base_url($this->_site_path . "/print_code/print_store")      ?>/' + num);
//	             $('#form').submit();
//	        } else {
//	              return false;
//	       }
//	   });
//});
</script>