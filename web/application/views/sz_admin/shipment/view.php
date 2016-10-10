<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">
        <tr>
            <td class="details_title" width="12%">商品名称</td>
            <td width="88%"colspan="3"><?php echo $this->goods_model->get_value_by_pk($shipment_data['goods_id'], 'name'); ?></td>
        </tr>  

        <tr>
            <td class="details_title" width="12%">出货数量</td>
            <td width="38%"><?php echo $shipment_data['amount']; ?></td>
            <td class="details_title" width="12%">商品类别</td>
            <td width="38%"><?php echo $shipment_data['bread']; ?></td>
        </tr>

        <tr>
            <td class="details_title" width="12%">操作人</td>
            <td width="38%"><?php echo $this->admin_model->get_value_by_pk($shipment_data['oper_id'],'user_name'); ?></td>
            <td class="details_title" width="12%">出货人</td>
            <td width="38%"><?php echo $shipment_data['person']; ?></td>
        </tr>

        <tr>
            <td class="details_title" width="12%">出货时间</td>
            <td width="38%"><?php echo date("Y-m-d", $shipment_data['created_time']); ?></td>
            <td width="12%" class="details_title">修改时间</td>
            <td width="38%" ><?php echo date("Y-m-d", $shipment_data['modified']); ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title">备注</td>
            <td width="88%"colspan="3"  class="Description"> 
                <p style="height:auto; min-height:150px; _height:150px;">&nbsp;<?php echo $shipment_data['remark']; ?></p>
            </td>
        </tr>
    </table>
</div>
