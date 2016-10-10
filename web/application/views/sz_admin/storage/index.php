<?php $this->load->view_part($this->_site_path."/main/breadcrumb_noadd");?>

<?php $this->load->view_part($this->_site_path."/storage/search")?>

<body >
<form method="post" action="<?php echo base_url($this->_site_path."/order_info/delete_all");?>">
	       <!--列表版块-->
           <div class="list_box">
               <div class="ucenter_tab_box">
               
               <ul id="tag" class="u_tab clearfix">
                      <li <?php if( 'purchase' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/storage/index/purchase');?>">入库统计</a>
					  </li>
					   <li <?php if( 'shipment' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/storage/index/shipment');?>">出库统计</a>
					  </li>					  
               </ul> 
                                     
               </div>
<div id="tab_box">
<div class=" display_block">
<table class="table table-bordered">
    <tr class="table-thbg">
	    <th>商品名称</th>                                
		<th>商品类别</th>         
		<?php if($current_type=="purchase"){?>    
		<th>入库量</th>
		<?php }elseif ($current_type=="shipment"){?>
		<th>出库量</th>
		<?php }?>
		<th>销售量</th>
		<th>库存量</th>
    </tr>      
    <?php $order = $this->order_info_model->all(array("attributes"=>array("order_status"=>1)));
    			foreach ($order as $single){
    				$og_id .= $single['order_id'].",";
    			}
    			$order = rtrim($og_id, ','); 
    ?> 
    <?php foreach($storage_data as $k=>$v){
    	//p($v);
    	//销售量
    	$sql="select count(goods_id),goods_id,order_id from order_goods where goods_id={$v['goods_id']} and order_id in({$order}) GROUP BY goods_id";		
    	$result = mysql_query($sql);
		$info = mysql_fetch_row($result);
    ?>                                   
    <tr>				
       <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/storage/view/{$v['goods_id']}/{$current_type}"); ?>';"><?php echo $v['goods_name']?></td>   
       <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/storage/view/{$v['goods_id']}/{$current_type}"); ?>';"><?php echo $this->goods_category_model->get_value_by_pk($v['cat_id'],'cat_name')?></td> 
       <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/storage/view/{$v['goods_id']}/{$current_type}"); ?>';"><?php echo $v['sum(amount)']?></td>  
       <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/storage/view/{$v['goods_id']}/{$current_type}"); ?>';"><?php echo $info[0]?></td>  
       <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/storage/view/{$v['goods_id']}/{$current_type}"); ?>';"><?php echo $this->goods_model->get_value_by_pk($v['goods_id'],"num")?></td>         
	</tr>               	
	<?php }?>	                          
</table>
</div>           
</div>           
</div>
	       <!-- 表格底部帮助栏-->
	       <div class="tips">

	         <!-- 分页开始-->
	         <div class="dede_pages float_right">
	         <?php echo $pagination; ?>
             </div>
	         <!-- 分页结束-->
             </div>
             <!--tips 结束-->
</form>
</body>



