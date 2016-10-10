<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php $shipping_status=$this->order_info_model->get_value_by_pk( $delivery_data["order_id"],"shipping_status" );?>
<!--  详情-->
<div class="box box-headtitle box-radius">
<?php get_messagebox();// 获取提示框 ?>
<form action="" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">        
            <tr>
                    <td width="10%" class="tdbg"><label for="password">订单号</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="order_sn" value="<?php echo $delivery_data["order_sn"]?>" disabled="disabled">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">发货单号</label></td>
                    <td width="84%">
                    <input type="text" name="add_time" value="<?php echo $delivery_data["delivery_sn"]?>" disabled="disabled">
                    <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label>店铺</label></td>
                    <td width="84%">
                    <input type="text" name="store_id" value="<?php echo $this->store_model->get_value_by_pk($delivery_data["store_id"],"sName")?>" disabled="disabled">
                    <span class="span">*</span>
                    </td>
                </tr>           
                <tr>
                    <td width="10%" class="tdbg"><label>配送方式</label></td>
                    <td width="84%">
                    	<select name="shipping_id" >
		                        <option value="">--请选择--</option>
		                        <?php foreach ($shipping_data as $k=>$v) {?>
		                        <option value="<?php echo $v['shipping_id'];?>"<?php if ($v['shipping_id'] == $delivery_data["shipping_id"]) echo "selected" ?>><?php echo $v['shipping_name'];?></option>
		                        <?php } ?>
		               </select>  
		               <span class="span">*</span>
                    </td>
                </tr>            
                <tr>
                    <td width="10%" class="tdbg"><label>物流单号</label></td>
                    <td width="84%">
                    <input type="text" name="invoice_no" value="<?php echo $delivery_data["invoice_no"]?>" />
                    <span class="span">*</span>
                    </td>
                </tr>                			
   </table>
  <div class="control_group btn_group">
                <label class="control_label" for="body"></label>
                <div class="controls">
                    <button type="submit" class="btn btn_style1"><span>更改物流</span></button>
                    <?php if($shipping_status==1){?>
                    <a href="<?php echo base_url($this->_site_path . '/delivery_order/cancel'). "/" . $delivery_data['order_id'];?>"><button type="button" class="btn btn_style1"><span>取消发货</span></button></a>
               		<?php }elseif ($shipping_status==0){?>
               		<a href="<?php echo base_url($this->_site_path . '/delivery_order/docheck'). "/" . $delivery_data['order_id'];?>"><button type="button" class="btn btn_style1"><span>发货</span></button></a>
               		<?php }?>
                </div>
</div>
<input type="hidden" name="is_submit" value="1">
</form>
</div>