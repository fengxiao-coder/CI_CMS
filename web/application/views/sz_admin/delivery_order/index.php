<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<?php $this->load->view_part($this->_site_path."/delivery_order/search")?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/default/css/print.css');?>" media="print"/>

<div class="list_box">
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path."/delivery_order/delete_all");?>">

	<table class="table table-striped table-condensed table-bordered">
		<thead>
                            <tr class="table-thbg">
                                <th class="selection_box">
                                    <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                                </th>
                                <th>发货单流水号</th> 
                                <th>订单号</th>                                
                                <th>收货人</th>
                                <th>发货时间</th>
                                <th>店铺</th>
                                <th>配送</th>
                                <th>发货单状态</th>
                                <th>操作</th>
                            </tr>

        </thead>
		<tbody>
		<?php foreach($delivery as $single){?>
			<tr>
				<td>
					<input name="ids[]" value="<?php echo $single['delivery_id']; ?>" type="checkbox" />
				</td>				
                <td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/delivery_order/view/{$single['delivery_id']}"); ?>';"><?php echo $single["delivery_sn"]?></td>   
                <td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/delivery_order/view/{$single['delivery_id']}"); ?>';"><?php echo $single["order_sn"]?></td>         
                <td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/delivery_order/view/{$single['delivery_id']}"); ?>';"><?php echo $single["consignee"]?></td>  
                <td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/delivery_order/view/{$single['delivery_id']}"); ?>';"><?php echo date('Y-m-d H:i:s',$single["update_time"])?></td>
                <td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/delivery_order/view/{$single['delivery_id']}"); ?>';"><?php echo $this->store_model->get_value_by_pk($single["store_id"],"sName")?></td>         
				<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/delivery_order/view/{$single['delivery_id']}"); ?>';"><?php echo $single["shipping_name"]?></td> 
				<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/delivery_order/view/{$single['delivery_id']}"); ?>';">
					<?php 
						$shipping_id= $this->order_info_model->get_value_by_pk($single["order_id"],"shipping_status");
						if($shipping_id==1){
							echo "已发货";
						}elseif ($shipping_id==2){
							echo "已收货";
						}elseif ($shipping_id==3){
							echo "退货";
						}elseif ($shipping_id==0){
							echo "取消发货";
						}
					?>
				</td>
				<td>					
					<?php if($shipping_id==1){?>
                    <a href="<?php echo base_url($this->_site_path . '/delivery_order/cancel'). "/" . $single['order_id'];?>">取消发货</a>
               		<?php }elseif ($shipping_id==0){?>
               		<a href="<?php echo base_url($this->_site_path . '/delivery_order/docheck'). "/" . $single['order_id'];?>">发货</a>
               		<?php }?>
               		<a href="<?php echo base_url($this->_site_path."/delivery_order/edit/{$single['delivery_id']}"); ?>">修改</a>
				</td>
			</tr>
			<?php }?>
	</tbody>
	</table>
	 </div>
                <!-- 表格底部帮助栏-->
                <div class="tips">
                    <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
                    <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
                    <!-- 分页开始-->
                    <?php echo $pagination; ?>
                    <!-- 分页结束-->
                </div>
</form>
            <!--tips 结束-->
</div>