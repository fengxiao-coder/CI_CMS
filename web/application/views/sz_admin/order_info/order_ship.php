<?php $this->load->view_part($this->_site_path."/main/breadcrumb_noadd");?>
<?php //p($order_info);?>
<div  >
<?php get_messagebox();// 获取提示框 ?>
<div class="box box-radius">
	<form method="post">
		<table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               
<?php $addinfo = $this->user_address_model->get_by_pk($order_info["address_id"]); ?>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">订单号</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="order_sn" class="m_inpt_border"  style="background:#f7f7f7;" value="<?php echo $order_info["order_sn"]?>" disabled="disabled">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">下单时间</label></td>
                    <td width="84%">
                    <input type="text" class="m_inpt_border" style="background:#f7f7f7;" name="add_time" value="<?php echo  date('Y-m-d H:i:s', $order_info["add_time"]) ?>" disabled="disabled">
                    <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">用户名</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="user_id" class="m_inpt_border" style="background:#f7f7f7;" value="<?php echo $this->user_model->get_value_by_pk($order_info["user_id"],"user_name")?>" disabled="disabled">
                        <span class="span">*</span>
                    </td>
                </tr>                           
                <tr>
                    <td width="10%"class="tdbg"><label>收货人</label></td>
                    <td width="84%">
                    <input type="text" name="consignee" class="m_inpt_border" style="background:#f7f7f7;" value="<?php echo $addinfo["consignee"]?>">
                    <span class="span">*</span>
                    </td>                  
                </tr>
                <tr>
                    <td width="10%"class="tdbg"><label>联系电话</label></td>
                    <td width="84%">
                    <input type="text" name="mobile" class="m_inpt_border" style="background:#f7f7f7;" value="<?php echo $addinfo["mobile"]?>">
                    <span class="span">*</span>
                    </td>                  
                </tr>
                <tr>
                    <td width="10%"class="tdbg"><label>收货省份</label></td>
                    <td width="84%">
							  <select  class="m_inpt_border" style="background:#f7f7f7;" id="province" name="province">
							      <option value="-1">请选择</option>
							      <?php foreach($pro_arr as $v){?>
							      <option value="<?php echo $v['id'];?>" <?php if($v['id']==$addinfo['province']){echo 'selected';}?>><?php echo $v['province_name']?></option>
							     <?php }?>
							  </select>						
                    <span class="span">*</span>
                    </td>                  
                </tr>
                
                <tr>
                    <td width="10%"class="tdbg"><label>收货城市</label></td>
                    <td width="84%">
							    <select  class="m_inpt_border" style="background:#f7f7f7;" id="city" name="city" >
							        <option value="">请选择</option>
							        <?php 
							  		$sql = "select * from user_city where pid={$addinfo['province']}";
							  		$result = mysql_query($sql);
							  		while($rs =  mysql_fetch_assoc($result)){
							  		?>
							         <option value="<?php echo $rs["id"]?>" <?php if($rs['id']==$addinfo['city']){echo 'selected';}?>><?php echo $rs["city_name"]?></option>
							         <?php }?>      
							      </select>						
                    <span class="span">*</span>
                    </td>                  
                </tr>
                
                <tr>
                    <td width="10%"class="tdbg"><label>收货区域</label></td>
                    <td width="84%">
							  <select class="m_inpt_border" style="background:#f7f7f7;" id="area" name="area">
							        <option value="">请选择</option>    
							        <?php 
							  		$sql = "select * from user_area where pid={$addinfo['city']}";
							  		$result = mysql_query($sql);
							  		echo $sql;
							  		while($rs =  mysql_fetch_assoc($result)){
							  		?>
							        <option value="<?php echo $rs["id"]?>" <?php if($rs['id']==$addinfo['area']){echo 'selected';}?>><?php echo $rs["area_name"]?></option>   
							        <?php }?>    
							  </select> 						
                    <span class="span">*</span>
                    </td>                  
                </tr>
                 <tr>
                    <td width="10%" class="tdbg"><label>详细地址</label></td>
                    <td width="84%">
                    <input type="text" name="address" class="m_inpt_border"style="background:#f7f7f7;"  value="<?php echo $addinfo["address"]?>">
                    <span class="span">*</span>
                    </td>
                </tr>
                
                <tr>
                    <td width="10%" class="tdbg"><label>店铺</label></td>
                    <td width="84%">
                    <input type="text" name="store_id" class="m_inpt_border" style="background:#f7f7f7;" value="<?php echo $this->store_model->get_value_by_pk($order_info["store_id"],"sName")?>" disabled="disabled">
                    <span class="span">*</span>
                    </td>
                </tr>           
                <tr>
                    <td width="10%" class="tdbg"><label>配送方式</label></td>
                    <td width="84%">
                    	<select class="m_inpt_border"  name="shipping_id" >
		                        <option value="">--请选择--</option>
		                        <?php foreach ($shipping_data as $k=>$v) {?>
		                        <option value="<?php echo $v['shipping_id'];?>"><?php echo $v['shipping_name'];?></option>
		                        <?php } ?>
		               </select>  
		               <span class="span">*</span>
                    </td>
                </tr>  
                <tr>
                    <td width="10%" class="tdbg"><label>物流单号</label></td>
                    <td width="84%">
                    <input type="text" class="m_inpt_border" name="invoice_no" value="" />
                    <span class="span">*</span>
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
	$("#province").change(function(){
		$.ajax({
			type:"get",
			url:"<?php echo base_url($this->_site_path . '/delivery_order/getcity');?>?random="+Math.random()+"&oneid="+$(this).val(),
			dataType:"html",
			success:function(data){
				$("#city").html(data);
			}
		})
	})

	$("#city").change(function(){
		$.ajax({
			type:"get",
			url:"<?php echo base_url($this->_site_path . '/delivery_order/getarea');?>?random="+Math.random()+"&cityid="+$(this).val(),
			dataType:"html",
			success:function(data){
				$("#area").html(data);
			}
		})
	})
	
})

</script>

