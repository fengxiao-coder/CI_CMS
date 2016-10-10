<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">
        <tr>
            <td class="details_title" width="12%">商品名称</td>
            <td width="88%"colspan="3"><?php echo $this->goods_model->get_value_by_pk($purchase_data['goods_id'], 'name'); ?></td>
        </tr>  
        <tr>
            <td width="12%" class="details_title">产品类别</td>
            <td width="38%"><?php echo $purchase_data['bread']; ?></td>
            <td width="12%" class="details_title">供应商</td>
            <td width="38%" ><?php echo $this->supplier_model->get_value_by_pk($purchase_data['supplier_id'], 'name'); ?> </td>
        </tr>
        <tr>
            <td class="details_title" width="12%">采购数量</td>
            <td width="38%"><?php echo $purchase_data['amount']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($purchase_data['item_unit'], 'value'); ?></td>
            <td class="details_title" width="12%">采购价格</td>
            <td width="38%"><?php echo $purchase_data['price']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($purchase_data['coin_unit'], 'value'); ?></td>
        </tr>
        <tr>
            <td class="details_title" width="12%">采购人</td>
            <td width="38%"><?php echo $purchase_data['person']; ?></td>
            <td  width="12%"class="details_title">状态</td>
            <td width="38%">
                <?php
                if ($purchase_data['status'] == 0) {
                    echo "还未入库";
                } else {
                    echo "已经入库";
                }
                ?></td>
        </tr>
        <tr>
            <td class="details_title" width="12%">采购时间</td>
            <td width="38%"><?php echo date("Y-m-d", $purchase_data['created_time']); ?></td>
            <td width="12%" class="details_title">修改时间</td>
            <td width="38%" ><?php echo date("Y-m-d", $purchase_data['modified']); ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title">备注</td>
            <td width="88%"colspan="3"  class="Description"> 
                <p style="height:auto; min-height:150px; _height:150px;">&nbsp;<?php echo $purchase_data['remark']; ?></p>
            </td>
        </tr>
    </table>
</div>
