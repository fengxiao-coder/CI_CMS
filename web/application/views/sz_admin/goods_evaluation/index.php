<?php $this->load->view_part($this->_site_path."/main/breadcrumb_noadd");?>

<?php $this->load->view_part($this->_site_path."/goods_evaluation/search")?>

<body >
<form method="post" action="<?php echo base_url($this->_site_path."/goods_evaluation/delete_all");?>">
	       <!--列表版块-->
           <div class="list_box">
               <div class="ucenter_tab_box">
               
               <ul id="tag" class="u_tab clearfix">
                      <li <?php if( 'goods' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/goods_evaluation/index/goods');?>">好评</a>
					  </li>
					   <li <?php if( 'middle' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/goods_evaluation/index/middle');?>">中评</a>
					  </li>
					   <li <?php if( 'bad' == $current_type ){ ?> class="current"<?php } ?> >
							<a href="<?php echo base_url($this->_site_path . '/goods_evaluation/index/bad');?>">差评</a>
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
                                    <th>用户名</th>                                
	                                <th>商品名称</th>  
	                                <th>商品评价</th>
	                                <th>评价时间</th>
	                                <th>回复次数</th>
	                                <th>操作</th>
                                   </tr>       
                                   
                                   <?php foreach ($goods_evaluation_data as $single){
                                   	$sql="select * from reply_evaluation where ge_id={$single[id]}";
                                   	$result = mysql_query($sql);
                                   	$num = mysql_num_rows($result);
                                   	?>
			<tr>		
				<td>
					<input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" />
				</td>			
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/goods_evaluation/view/{$single['id']}"); ?>';"><?php echo $this->user_model->get_value_by_pk($single["user_id"],"user_name") ?></td>   
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/goods_evaluation/view/{$single['id']}"); ?>';"><?php echo $this->goods_model->get_value_by_pk($single["goods_id"],"name") ?></td>      
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/goods_evaluation/view/{$single['id']}"); ?>';"><?php echo $single['content'] ?></td>  
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/goods_evaluation/view/{$single['id']}"); ?>';"><?php echo date('Y-m-d', $single['created_time']); ?></td>  
                <td onClick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/goods_evaluation/view/{$single['id']}"); ?>';"><?php echo $num;?></td>         
				<td>
					<a href="<?php echo base_url($this->_site_path . "/goods_evaluation/reply"). "/" . $single['id']; ?>">回复</a>
				</td>
			</tr>
		<?php }?>
		                          
                            </table>
                  </div>
           
           </div>
           
           </div>
	       <!-- 表格底部帮助栏-->
	       <div class="tips">
	         <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
              <div class="float_left"><button type="submit" class="btn btn_style1" onClick="return confirmDelete()"><span>删 除</span></button></div>

	         <!-- 分页开始-->
	         <div class="dede_pages float_right">
	         <?php echo $pagination; ?>
             </div>
	         <!-- 分页结束-->
             </div>
             <!--tips 结束-->
</form>
</body>
