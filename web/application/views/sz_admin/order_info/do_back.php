<?php $this->load->view_part($this->_site_path."/main/breadcrumb_noadd");?>
<?php //p($delivery_info);?>
<div  >
<?php get_messagebox();// 获取提示框 ?>
<div class="box box-radius">
	<form method="post">
		<table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               

                <tr>
                    <td width="10%" class="tdbg"><label for="password">订单号</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" class="m_inpt_border" style="background:#f7f7f7;"  name="order_sn" value="<?php echo $delivery_order['order_sn']?>" disabled="disabled">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">下单时间</label></td>
                    <td width="84%">
                    <input type="text" class="m_inpt_border" style="background:#f7f7f7;"  name="add_time" value="<?php echo  date('Y-m-d H:i:s', $delivery_order["add_time"])?>" disabled="disabled">
                    <span class="span">*</span>
                    </td>
                </tr>  
                  <tr>
                    <td width="10%" class="tdbg"><label>商品名称</label></td>
                    <td width="84%">
                    <input type="text" class="m_inpt_border"  name="goods_name" value="<?php echo $order_goods['goods_name']?>" disabled="disabled"/>
                    <span class="span">*</span>
                    </td>
                </tr>    
                <tr>
                    <td width="10%" class="tdbg"><label>商品编码</label></td>
                    <td width="84%">
                    <input type="text" class="m_inpt_border"  name="goods_sn" value="<?php echo $order_goods['goods_sn']?>" disabled="disabled"/>
                    <span class="span">*</span>
                    </td>
                </tr> 
                <tr>
                    <td width="10%" class="tdbg"><label>商品价格</label></td>
                    <td width="84%">
                    <input type="text" class="m_inpt_border"  name="price" value="<?php echo $order_goods['price']?>" disabled="disabled"/>
                    <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label>商品属性</label></td>
                    <td width="84%">
                    <input type="text" class="m_inpt_border"  name="goods_attr" value="<?php echo $order_goods['goods_attr']?>" disabled="disabled"/>
                    <span class="span">*</span>
                    </td>
                </tr>                              
                <tr>
                    <td width="10%" class="tdbg"><label>所属店铺</label></td>
                    <td width="84%">
                   <select name="store_id" class="m_inpt_border" disabled="disabled">
		                        <option value="">--请选择--</option>
		                        <?php foreach ($store_data as $k=>$v) {?>
		                        <option value="<?php echo $v['id'];?>" <?php if($v['id']==$delivery_order['store_id']){echo 'selected';}?>><?php echo $v['sName'];?></option>
		                        <?php } ?>
		             </select>  
                    <span class="span">*</span>
                    </td>
                </tr>           
                <tr>
                    <td width="10%" class="tdbg"><label>配送方式</label></td>
                    <td width="84%">
                    	<select name="shipping_id" class="m_inpt_border" disabled="disabled">
		                        <option value="">--请选择--</option>
		                        <?php foreach ($shipping_data as $k=>$v) {?>
		                        <option value="<?php echo $v['shipping_id'];?>" <?php if($v['shipping_id']==$delivery_order['shipping_id']){echo 'selected';}?>><?php echo $v['shipping_name'];?></option>
		                        <?php } ?>
		               </select>  
		               <span class="span">*</span>
                    </td>
                </tr>                    
                <tr>
                    <td width="10%" class="tdbg"><label>物流单号</label></td>
                    <td width="84%">
                    <input type="text" class="m_inpt_border"  name="invoice_no" value="<?php echo $delivery_order['invoice_no']?>" disabled="disabled"/>
                    <span class="span">*</span>
                    </td>
                </tr>   
                   
                <tr>
                    <td width="10%" class="tdbg"><label>退货理由</label></td>
                    <td width="84%">                  
                    <textarea class="textarea_border" name="how_oos" disabled="disabled"><?php echo $order_goods['how_oos']?></textarea>
                    <span class="span">*</span>
                    </td>
                </tr>    
                <tr>
                    <td width="10%" class="tdbg"><label>同意退货</label></td>
                    <td width="84%">
                    	<select name="agree" class="m_inpt_border" id="agree">                   			
		                        <option value="1">是</option>		
		                        <option value="0">否</option>                        		                        		                        
		               </select>  
		               <span class="span">*</span>
                    </td>
                </tr>    
                <tr id="back">
                    <td width="10%" class="tdbg"><label>回复理由</label></td>
                    <td width="84%">
                    <textarea class="textarea_border" name="reply" ></textarea>
                    </td>
                </tr>            
            </table>

            <div class="control_group btn_group">
                <label class="control_label" for="body"></label>
                <div class="controls">
                    <button type="submit" class="btn btn_style1"><span>提交</span></button>
                    <button type="reset" class="btn btn_style1"><span>重置</span></button>
                </div>
            </div>
            <input type="hidden" name="is_submit" value="1">
        </form>  
        <div class="float_clear"></div>

    </div>          

    </div>
<script type="text/javascript">
$(function(){
	$("#back").hide();
	$("#agree").change(function(){
		if($(this).val()==1){
			$("#back").hide(); 
		}else{
			$("#back").show(); 
		}
	})
	
})

</script>

