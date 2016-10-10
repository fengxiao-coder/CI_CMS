<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">        
            <tr>
                 <td width="12%" class="details_title">店铺</td>
                <td width="38%" ><?php echo $this->store_model->get_value_by_pk($delivery_data['store_id'],"sName");?></td>
                <td width="12%" class="details_title">订单号</td>
                <td width="38%"><?php echo $delivery_data['order_sn']; ?></td>
            </tr>  
            <tr>
                <td width="12%" class="details_title">购买人</td>
                <td width="38%"><?php echo $this->user_model->get_value_by_pk($delivery_data['user_id'],"user_name");?></td>
                <td width="12%" class="details_title">下单时间</td>
                <td width="38%" ><?php echo date('Y-m-d H:i:s', $delivery_data['add_time']); ?></td>
            </tr>
            <tr>
                <td class="details_title" width="12%">收货人</td>
                <td width="38%"><?php echo $delivery_data['consignee']; ?></td>
                <td class="details_title" width="12%">发货时间</td>
                <td width="38%"><?php echo date('Y-m-d H:i:s', $delivery_data['update_time']); ?></td>
            </tr>
            <tr>
                <td class="details_title" width="12%">配送地址</td>
                <?php 
                	$province=$this->user_province_model->get_value_by_pk($delivery_data['province'],"province_name");
                	$city=$this->user_city_model->get_value_by_pk($delivery_data['city'],"city_name");
                	$district=$this->user_area_model->get_value_by_pk($delivery_data['district'],"area_name");
                ?>
                <td width="38%"><?php echo $province .$city .$district .$delivery_data["address"]; ?></td>
                <td class="details_title" width="12%">电话</td>
                <td width="38%"><?php echo $delivery_data['mobile']; ?></td>
            </tr>
            <tr>
                <td class="details_title" width="12%">配送方式</td>
                <td width="38%"><?php echo $delivery_data["shipping_name"];?></td>
                <td class="details_title" width="12%">发货单号</td>
                <td width="38%"><?php echo $delivery_data['delivery_sn']; ?></td>              
            </tr> 
             <tr>
                <td class="details_title" width="12%">物流单号</td>
                <td colspan="3"><?php echo $delivery_data['invoice_no']; ?></td>               
            </tr>
                                      
            <tr>
                <td class="details_title" width="12%">商品信息</td>
                <td width="88%" colspan="3">
                	<table width="100%" border="0" cellspacing="1" cellpadding="0" class=" details_tab">
                			<tr>
                					<td align="center">商品名称</td>
                					<td align="center">商品货号</td>                					
                					<td align="center">价格</td>
                					<td align="center">购买数量</td>
                			</tr>
                			<?php foreach ($goods_data as $v){?>
                			<tr>
                					<td align="center"><?php echo $this->goods_model->get_value_by_pk($v['goods_id'],"name")?></td>
                					<td align="center"><?php echo $this->goods_model->get_value_by_pk($v['goods_id'],"goods_sn")?></td>
                					<td align="center"><?php echo "￥".$this->goods_model->get_value_by_pk($v['goods_id'],"price")."元"?></td>
                					<td align="center"><?php echo $v['goods_number']."件";?></td>
                			</tr>
                			<?php }?>               			
                	</table>
                </td>               
            </tr>              
    </table>
</div>
</div>