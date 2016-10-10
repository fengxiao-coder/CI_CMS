<?php $this->load->view_part($this->_site_path."/main/breadcrumb_noadd");?>

<?php $this->load->view_part($this->_site_path."/order_info/search")?>

<body >
<form method="post" action="<?php echo base_url($this->_site_path."/order_info/delete_all");?>">
	       <!--列表版块-->
           <div class="list_box">
               <div class="ucenter_tab_box">
               
               <ul id="tag" class="u_tab clearfix">
                      <li <?php if( 'pay' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/order_info/index/pay');?>">待付款</a>
					  </li>
					   <li <?php if( 'ship' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/order_info/index/ship');?>">待发货</a>
					  </li>
					   <li <?php if( 'check' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/order_info/index/check');?>">已发货</a>
					  </li>
					  <li <?php if( 'back' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/order_info/index/back');?>">退货</a>
					  </li>
					   <li <?php if( 'eval' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/order_info/index/eval');?>">待评价</a>
					  </li>
					   <li <?php if( 'success' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/order_info/index/success');?>">成功订单</a>
					  </li>
					  <li <?php if( 'close' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/order_info/index/close');?>">关闭订单</a>
					  </li>
                   </ul> 
                                     
               </div>
               <div id="tab_box">
                  <div class=" display_block">
                  	       <table class="table table-bordered">
                                   <tr class="table-thbg">
	                                 <th class="selection_box">
	                                    <input name="checkAll" type="checkbox" onClick="checkAllfuck()" />
	                                </th>
                                     <th>订单号</th>                                
	                                <th>下单时间</th>
	                                <?php if ($current_type=="check"){?>
                					<th>发货时间</th>
                 					<?php }?>    
	                                <th>收货人</th>
	                                <th>总金额</th>
	                                <th>店铺</th>
	                                <th>操作</th>
                                   </tr>       
                                   
         <?php if ($current_type=="back"){ 
         foreach ($back_order as $v){ ?>
             <tr>		
				<td>
					<input name="ids[]" value="<?php echo $v['order_id']; ?>" type="checkbox" />
				</td>			
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$v['order_id']}/{$current_type}"); ?>';"><?php echo $v['order_sn'] ?></td>   
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$v['order_id']}/{$current_type}"); ?>';"><?php echo date('Y-m-d H:i:s', $v['add_time']); ?></td> 
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$v['order_id']}/{$current_type}"); ?>';"><?php echo $v['consignee'] ?></td>  
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$v['order_id']}/{$current_type}"); ?>';"><?php echo $this->order_info_model->get_value_by_pk($v['order_id'],'pay_fee'); ?></td>  
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$v['order_id']}/{$current_type}"); ?>';"><?php echo $this->store_model->get_value_by_pk($v['store_id'], 'sName'); ?></td>         
				<td>
					<a href="<?php echo base_url($this->_site_path . "/order_info/view/{$v['order_id']}/{$current_type}"); ?>">查看</a>
				</td>
			</tr>               	
         <?php }}else{
          foreach ($order_info_data as $single){
                    $addinfo = $this->user_address_model->get_by_pk($single["address_id"]);
                    $up = $this->delivery_order_model->get_by_attributes(array("add_time" => $single['add_time']));
         ?>
			<tr>		
				<td>
					<input name="ids[]" value="<?php echo $single['order_id']; ?>" type="checkbox" />
				</td>			
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$single['order_id']}/{$current_type}"); ?>';"><?php echo $single['order_sn'] ?></td>   
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$single['order_id']}/{$current_type}"); ?>';"><?php echo date('Y-m-d H:i:s', $single['add_time']); ?></td> 
                <?php if ($current_type=="check"){?>
                		<td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$single['order_id']}/{$current_type}"); ?>';"><?php echo date('Y-m-d H:i:s', $up['update_time']); ?></td>
                 <?php }?>       
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$single['order_id']}/{$current_type}"); ?>';"><?php echo $addinfo['consignee'] ?></td>  
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$single['order_id']}/{$current_type}"); ?>';"><?php echo $single['pay_fee'] ?></td>  
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/order_info/view/{$single['order_id']}/{$current_type}"); ?>';"><?php echo $this->store_model->get_value_by_pk($single['store_id'], 'sName'); ?></td>         
				<td>
				<?php //echo $current_type?>
					<?php if($current_type =="pay"){ //设为付款 ?>
							<a href="<?php echo base_url($this->_site_path . "/order_info/pay"). "/" . $single['order_id']; ?>">付款</a>							
					<?php }elseif ($current_type=="ship"){?>
							<a href="<?php echo base_url($this->_site_path . "/order_info/ship"). "/" . $single['order_id']; ?>">发货</a>
					<?php }elseif ($current_type=="check"){?>
							<a href="<?php echo base_url($this->_site_path . "/order_info/editship"). "/" . $single['order_id']; ?>">物流修改</a>
					<?php }else{?>
							<a href="<?php echo base_url($this->_site_path . "/order_info/view/{$single['order_id']}/{$current_type}"); ?>">查看</a>
					<?php }?>
				</td>
			</tr>
		<?php }}?>
                                   
                                   
		                          
                            </table>
                  </div>
           
           </div>
           
           </div>
	       <!-- 表格底部帮助栏-->
	       <div class="tips">
	         <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
	         <!--  
              <div class="float_left"><button type="submit" class="btn btn_style1" onClick="return confirmDelete()"><span>删 除</span></button></div>
			-->
	         <!-- 分页开始-->
	         <div class="dede_pages float_right">
	         <?php echo $pagination; ?>
             </div>
	         <!-- 分页结束-->
             </div>
             <!--tips 结束-->
</form>
</body>



