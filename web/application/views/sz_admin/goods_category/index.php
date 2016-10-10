<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php $this->load->view_part($this->_site_path . "/goods_category/search") ?>
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
                                <th>所属类别</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($goods_category_data as $single) { ?>
                                <!--  鼠标悬停，整行变色，-->
                                <tr  >
                                    <td>
                                        <input name="ids[]" value="<?php echo $single['cat_id']; ?>" type="checkbox" />
                                    </td>
                                    <td class="align_left" style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_category/view/{$single['cat_id']}"); ?>';"><?php echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $single['lev']) . $single['cat_name']; ?></td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_category/view/{$single['cat_id']}"); ?>';">
                                        <?php echo $this->goods_category_model->get_value_by_pk($single['pid'], 'cat_name'); ?> 
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url($this->_site_path . "/goods_category/edit/{$single['cat_id']}"); ?>">修改</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- 表格底部帮助栏-->
                <div class="tips">
                    <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
                    <div class="float_left"><button type="button" id="delete_all" class="btn btn_style1" ><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
                    <!-- 分页开始-->
                    <?php echo $pagination; ?>
                    <!-- 分页结束-->
                </div>
            </form>
            <!--tips 结束-->
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
                            url: '<?php echo base_url($this->_site_path . "/goods_category/all_delete"); ?>',
                            data: $('#form').serialize(),
                            async: false,
                            error: function (request) {
                                alert("您好，输入错误");
                            },
                            success: function (data) {
                                if(data==1){
                                 alert("不可以删除！！");  
                                }
                                window.location.href = window.location.href;
                            }
                        });
                    }
                }
            });
        </script>