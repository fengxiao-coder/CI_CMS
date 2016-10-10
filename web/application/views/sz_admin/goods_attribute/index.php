<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php $this->load->view_part($this->_site_path . "/goods_attribute/search") ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/default/css/print.css'); ?>" media="print"/>
<div class="list_box">
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
            <form method="post" action="<?php echo base_url($this->_site_path . "/goods_attribute/delete_all"); ?>">

                <table class="table table-striped table-condensed table-bordered">
                    <thead>
                        <tr class="table-thbg">
                            <th class="selection_box">
                                <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                            </th>
                            <th>属性名称</th>
                            <th>所属类型</th>
<!--                            <th>是否可以多选</th>-->
                            <th>录入方式</th>
                            <th>属性值</th>
                            <th>排序依据</th>
                            <th>操作</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php foreach ($goods_attribute_data as $single) { ?>
                            <tr>
                                <td>
                                    <input name="ids[]" value="<?php echo $single['attr_id']; ?>" type="checkbox" />
                                </td>				
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_attribute/view/{$single['attr_id']}"); ?>';"><?php echo $single['attr_name'] ?></td>   
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_attribute/view/{$single['attr_id']}"); ?>';">
                                    <?php echo $this->goods_category_model->get_value_by_pk($single['type_id'], 'cat_name'); ?> 
                                </td>         
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_attribute/view/{$single['attr_id']}"); ?>';">
                                    <?php
                                    if ($single['attr_input_type'] == 1) {
                                        echo"手工录入";
                                    } elseif ($single['attr_input_type'] == 2) {
                                        echo "在列表中选择";
                                    } else {
                                        echo "多选";
                                    };
                                    ?></td>  
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_attribute/view/{$single['attr_id']}"); ?>';"><?php
                                    if ($single['attr_input_type'] == 1) {
                                        echo"";
                                    } else {
                                        echo $single['attr_value'];
                                    }
                                    ?></td>
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_attribute/view/{$single['attr_id']}"); ?>';"><?php echo $single['sort_order'] ?></td>
                                <td>
                                    <a href="<?php echo base_url($this->_site_path . "/goods_attribute/edit/{$single['attr_id']}"); ?>">修改</a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
        <!-- 表格底部帮助栏-->
        <div class="tips">
            <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
            <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span  class="btn-Bulkdelete">删除</span></button></div>
            <!-- 分页开始-->
            <?php echo $pagination; ?>
            <!-- 分页结束-->
        </div>
        </form>
        <!--tips 结束-->
    </div>
