<?php // $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php $this->load->view_part($this->_site_path . "/shipment/search") ?>
<form method="post" action="<?php echo base_url($this->_site_path . "/shipment/delete_all"); ?>">
    <div class="list_box">
        <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                    <th>商品名称</th>
                    <th>商品类别</th>
                    <th>库存量</th>
                    <th>出货量</th>
                    <th>出货人</th>
                    <th>出货时间</th>
                    <th>备注</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($shipment_data as $single) {
                    $cat_id = $this->goods_model->get_value_by_pk($single['goods_id'], 'pid');
                    ?>
                    <tr>
                        <td>
                            <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" codeContent="<?php echo base_url($this->_site_path . "/shipment/view/{$single['id']}"); ?>"/>
                        </td>
                        <td class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/shipment/view/{$single['id']}"); ?>';">
                            <?php echo $this->goods_model->get_value_by_pk($single['goods_id'], 'name'); ?>
                        </td>
                        <td  class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/shipment/view/{$single['id']}"); ?>';">
                            <?php echo $this->goods_category_model->get_value_by_pk($cat_id, 'cat_name'); ?>
                        </td>
                        <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/shipment/view/{$single['id']}"); ?>';">
                            <?php echo $single['num']; ?>
                        </td>
                        <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/shipment/view/{$single['id']}"); ?>';">
                            <?php echo $single['amount']; ?>
                        </td>
                        <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/shipment/view/{$single['id']}"); ?>';">
                            <?php echo $single['person']; ?>
                        </td>
                        <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/shipment/view/{$single['id']}"); ?>';">
                            <?php echo date("Y-m-d", $single['created_time']); ?>
                        </td>
                        <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/shipment/view/{$single['id']}"); ?>';">
                            <?php echo $single['remark']; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- 表格底部帮助栏-->
    <div class="tips">
        <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
<!--        <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div>/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->

        <!-- 分页开始-->
        <?php echo $pagination; ?>
        <!-- 分页结束-->
    </div>
</form>
