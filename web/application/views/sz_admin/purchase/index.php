<?php // $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php $this->load->view_part($this->_site_path . "/purchase/search") ?>
<div>
    <?php get_messagebox(); // 获取提示框    ?>
    <form method="post" action="<?php echo base_url($this->_site_path . "/purchase/delete_all"); ?>">
        <div class="list_box">
            <table class="table table-striped table-condensed table-bordered">
                <thead>
                    <tr class="table-thbg">
                        <th class="selection_box">
                            <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                        </th>
                        <th>商品名称</th>
                        <th>商品类别</th>
                        <th>供应商</th>
                        <th>采购量</th>
                        <th>采购价</th>
                        <th>采购人</th>
                        <th>采购时间</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($purchase as $single) { ?>
                        <tr>
                            <td>
                                <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" codeContent="<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>"/>
                            </td>
                            <td class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                <?php echo $single['goods_name']; ?>
                            </td>
                            <td  class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                <?php echo $this->goods_category_model->get_value_by_pk($single['cat_id'], 'cat_name'); ?>
                            </td>
                            <td  class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                <?php echo $this->supplier_model->get_value_by_pk($single['supplier_id'], 'name'); ?>
                            </td>
                            <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                <?php echo $single['amount']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($single['item_unit'], 'value'); ?>
                            </td>
                            <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                <?php echo $single['price']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($single['coin_unit'], 'value'); ?>
                            </td>
                            <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                <?php echo $single['person']; ?>
                            </td>
                            <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                <?php echo date("Y-m-d", $single['created_time']); ?>
                            </td>
                            <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                <?php echo $single['remark']; ?>
                            </td>
                            <td>
                                <?php if ($single['status'] == 1) echo '已入库' ?>
                                <a <?php if ($single['status'] == 1) echo 'style="display:none"' ?> href="<?php echo base_url($this->_site_path . "/purchase/stock/{$single['id']}"); ?>" onclick="return confirm('确定入库 ?')" >入库</a>
                                <a <?php if ($single['status'] == 1) echo 'style="display:none"' ?> href="<?php echo base_url($this->_site_path . "/purchase/edit/{$single['id']}"); ?>">修改</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- 表格底部帮助栏-->
        <div class="tips">
            <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
<!--            <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div>/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
            <!-- 分页开始-->
            <?php echo $pagination; ?>
            <!-- 分页结束-->
        </div>
    </form>
</div>
