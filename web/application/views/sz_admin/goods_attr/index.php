<?php $this->load->view_part($this->_site_path . "/main/breadcrumb_noadd"); ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/default/css/print.css'); ?>" media="print"/>
<div class="list_box">
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
            <form method="post" action="<?php echo base_url($this->_site_path . "/goods_attr/delete_all"); ?>">

                <table class="table table-striped table-condensed table-bordered">
                    <thead>
                        <tr class="table-thbg">
                            <th class="selection_box">
                                <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                            </th>
                            <th>属性名称</th>
                            <th>所属值</th>
                            <th>属性价格</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($goods_attr_data as $single) { ?>
                            <tr>
                                <td>
                                    <input name="ids[]" value="<?php echo $single['goods_attr_id']; ?>" type="checkbox" />
                                </td>				
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_attr/view/{$single['attr_id']}"); ?>';">
                                    <?php echo $this->goods_attribute_model->get_value_by_pk($single['attr_id'], 'attr_name'); ?> 
                                </td>     
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_attr/view/{$single['attr_id']}"); ?>';"><?php echo $single['attr_value'] ?></td>    
                                <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_attr/view/{$single['attr_id']}"); ?>';"><?php echo $single['attr_price'] ?></td> 
                                <td>
<!--                                    <a href="<?php echo base_url($this->_site_path . "/goods_attr/edit/{$single['attr_id']}"); ?>">修改</a>-->
                                    <a href="<?php echo base_url($this->_site_path . "/goods_attr/delete/{$single['goods_attr_id']}"); ?>" onclick="return confirmDelete()">删除</a>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
        <!-- 表格底部帮助栏-->
        <div class="tips">
            <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
            <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span  class="btn-Bulkdelete">批量删除</span></button></div>
            <!-- 分页开始-->
            <?php echo $pagination; ?>
            <!-- 分页结束-->
        </div>
        </form>
        <!--tips 结束-->
    </div>
