<?php //$this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php 
$button = array("添加"=>array("c_model"=>'add','url'=> base_url("sz_admin/brand/add")));
$this->common->show_title_breadcrumb("brand",$button);
?>

<?php $this->load->view_part($this->_site_path . "/brand/search") ?>
<div class="list_box">
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
            <form method="post" id="form">
                <div class="list_box">
                    <table id="tb" class="table table-striped table-condensed table-bordered">
                        <thead>
                            <tr class="table-thbg">
                                <th class="selection_box">
                                    <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                                </th>
                                <th>名称</th>
                                <th>网址</th>    
                                <?php if (!$this->auth->get_user('store_id')){?>                  
                                <th style=" width:60px;">操作</th>
                                <?php }?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brand_data as $single) { ?>
                                <!--  鼠标悬停，整行变色，-->
                                <tr>
                                    <td>
                                        <input name="ids[]" value="<?php echo $single['brand_id']; ?>" type="checkbox" />
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/brand/view/{$single['brand_id']}"); ?>';"><?php echo $single['brand_name']; ?></td>
                                    <td style="cursor:pointer;cursor:hand; word-break:break-all; word-wrap:break-word; text-align:left" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/brand/view/{$single['brand_id']}"); ?>';">
                                    <div style="width:800px; height:auto; margin:auto 8px;">  <a href="<?php echo 'http://' . $single['site_url']; ?>"><?php echo $single['site_url']; ?></a></div>
                                      
                                    </td>
                                    <?php if (!$this->auth->get_user('store_id')){?>  
                                    <td><a href="<?php echo base_url($this->_site_path . "/brand/edit/{$single['brand_id']}"); ?>">修改</a></td>
                                    <?php }?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- 表格底部帮助栏-->
                <div class="tips">
                    <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
                    <?php if($this->auth->check("brand","delete_all")):?> 
                    <div class="float_left"><button type="button" id="delete_all" class="btn btn_style1"><span>删 除</span></button></div>
                    <?php endif;?>
                    <!-- 分页开始-->
                    <?php echo $pagination; ?>
                    <!-- 分页结束-->
                </div>
            </form>
            <!--tips 结束-->
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#delete_all").click(function () {
        if ($("input[name='ids[]']:checked").size() === 0) {
            alert("请选中商品！");
            return false;
        } else {
            if (confirmDelete() === true) {
                $.ajax({
                    cache: true,
                    type: "POST",
                    url: '<?php echo base_url($this->_site_path . "/brand/all_delete"); ?>',
                    data: $('#form').serialize(),
                    async: false,
                    error: function (request) {
                        alert("您好，输入错误");
                    },
                    success: function (data) {
                        if (data == 1) {
                            alert("不可以删除！！");
                        }
                        window.location.href = window.location.href;
                    }
                });
            }
        }
    });
</script>
