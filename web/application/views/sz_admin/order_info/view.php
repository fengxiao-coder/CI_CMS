<?php $this->load->view_part($this->_site_path . "/main/breadcrumb_noadd"); ?>
<?php 
//$order_status = $this->order_info_model->order_status($order_info['order_status']);
//$shipping_status = $this->order_info_model->shipping_status($order_info['shipping_status']);
//$pay_status = $this->order_info_model->pay_status($order_info['pay_status']);
?>
<?php //p($current_type)?>
         <!--  详情-->
       <div class="box box-radius">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">
              <tr>
                <td width="12%" class="details_title">订单编号</td>
                <td width="21%"><?php echo $order_info['order_sn']; ?></td>
                <td class="details_title" width="12%">下单时间</td>
                <td width="21%"><?php echo date('Y-m-d H:i:s', $order_info['add_time']); ?></td>
                <td width="12%" class="details_title">订单状态</td>
                <td width="21%">
                		<?php 
                			if($current_type =="pay"){
                				echo "未付款";
                			}elseif ($current_type =="ship"){
                				echo "待发货";
                			}elseif ($current_type =="check"){
                				echo "待收货";
                			}elseif ($current_type =="eval"){
                				echo "待评价";
                			}elseif ($current_type =="success"){
                				echo "交易成功";
                			}elseif ($current_type =="close"){
                				echo "交易关闭";
                			}elseif ($current_type=="back"){
                				echo "退货";
                			}
                		?>
                </td>
              </tr>
              
              
              <tr>
                <td width="12%" class="details_title">订单金额</td>
                <td width="21%"><?php echo $order_info['goods_amount']; ?></td>
                <td class="details_title" width="12%">卖家</td>
                <td width="62%" colspan="3">跨境购物平台—<?php echo $this->store_model->get_value_by_pk($order_info['store_id'],"sName");?></td>
              </tr>
              <tr>
                <td width="12%" class="details_title">商品信息</td>
                <td width="88%"colspan="5">
                     <table border="0" cellpadding="0" cellspacing="0"  class="order_product_tab">
                      <colgroup>
                             <!-- 货号 -->
                            <col class="col1">
                            <!-- 宝贝 -->
                            <col class="col2">
                            <!-- 商品属性 -->
                            <col class="col3">
                            <!-- 单价（元） -->
                            <col class="col4">
                            <!-- 数量 -->
                            <col class="col5">
                            <!-- 合计（元） -->
                            <col class="col6">
                            <!-- 运费（元） -->
                            <col class="col7">
                            </colgroup>
                      <thead>
                      
                          <tr class="order_hd"> 
                            <th class="item_cord">商品货号</th>
                            <th class="item">商品</th>
                            <th class="sku">商品属性</th>
                            <th class="price">单价(元)</th>
                            <th class="num">数量</th>
                            <th class="order_price">商品总价(元)</th>
                            <?php if ($current_type=="back"){?>                            
                            <th class="post_fee">操作</th>
                            <?php }?>
                          </tr>
                      </thead>
                      <tbody>
                      
                      <?php foreach ($goods_info as $v){
                      	//p($v);
                			//$totalpay+=$v['goods_number']*($this->goods_model->get_value_by_pk($v['goods_id'],"price"));
                	 ?>
                        <tr class="order_item">
                           <td class="item_cord"><?php echo $v['goods_sn']?></td>
        					<td class="item">
        						<div class="pic_info">
									<a hidefocus="true" href="" target="_blank" title="商品图片">
									<img alt="" src="<?php echo base_url().$this->goods_model->get_value_by_pk($v['goods_id'],"photo"); ?>"></a>
        						</div>
        						<div class="txt_info">
        							<div class="desc">
        								<a href="" title="单鞋女春秋2015粗码女鞋子" target="_blank"><?php echo $v['goods_name']?></a>
						            </div>
							  </div>
        					</td>
        					<td class="sku">
        						<div class="props">
                                <span><?php echo $v['goods_attr'];?></span>
      
                                </div>                          
                            </td>
        					<td class="price"><?php echo $v['price']?></td>
        					<td class="num"><?php echo $v['goods_number'];?></td>
							<td class="order_price" rowspan="1"><?php echo $v['goods_number']*$v['price'];?>
                            </td>
                            <?php if ($current_type=="back"){?>                            
                            <td class="post_fee" rowspan="1">
									 <span><a href="<?php echo base_url($this->_site_path . '/order_info/do_back')."/".$v['rec_id'];?>"><?php echo $status=($v['status']==1)?"同意退货":"已操作"?></a></span>
							 </td>
                            <?php }?>
            				<!--  
            				<td class="post_fee" rowspan="1">
									 	<span>0.00</span>
    									<span>( 快递 )</span>
							 </td>
							 -->
							</tr>
							
                        <?php }?>
                       </tbody>
                       <tfoot>
                       	 <tr>
                       	 	 <?php if ($current_type=="back"){?>                            
                            <td colspan="7" class="total">
                            <?php }else{?>
                         	<td colspan="6" class="total">
                         	<?php }?>
                         	合计：<?php echo $order_info["pay_fee"];?>&nbsp;(含总运费:<?php echo $order_info["shipping_fee"];?>)</td>
                         </tr>
                       </tfoot>
                   </table>

                </td>
              </tr>
              <?php $addinfo = $this->user_address_model->get_by_pk($order_info["address_id"]);
              //p($addinfo);
              //p($delivery_info);
              ?>
              <tr>
                <td width="12%" class="details_title">物流信息</td>
                <td width="88%"colspan="5">
                <?php if(!$delivery_info){ ?> <!-- 如果没发货读取订单表的收货信息 -->
                	<ul class="order_post">
                    	<li>收件人：<?php echo $addinfo["consignee"]?></li>
                        <li>联系电话：<?php echo $addinfo["mobile"]?></li>
                        <li>收货地址：<?php 
				                	$province=$this->user_province_model->get_value_by_pk($addinfo['province'],"province_name");
				                	$city=$this->user_city_model->get_value_by_pk($addinfo['city'],"city_name");
				                	$district=$this->user_area_model->get_value_by_pk($addinfo['district'],"area_name");
				                	echo $province.$city.$district.$addinfo["address"];
				                ?>
                		</li>
                        <li>运送方式：快递</li>
                        <li>物流公司：-------</li>
                        <li>运单号：-------</li>
                    </ul>
                <?php }else{?>
                	<ul>
                    	<li>收件人：<?php echo $delivery_info["consignee"]?></li>
                        <li>联系电话：<?php echo $delivery_info["mobile"]?></li>
                        <li>收货地址：<?php 
				                	$province=$this->user_province_model->get_value_by_pk($delivery_info['province'],"province_name");
				                	$city=$this->user_city_model->get_value_by_pk($delivery_info['city'],"city_name");
				                	$district=$this->user_area_model->get_value_by_pk($delivery_info['district'],"area_name");
				                	echo $province.$city.$district.$delivery_info["address"];
				                ?>
                		</li>
                        <li>运送方式：快递</li>
                        <li>物流公司：<?php echo $delivery_info["shipping_name"];?></li>
                        <li>运单号：<?php echo $delivery_info['invoice_no']; ?></li>
                    </ul>
                <?php }?>
                </td>
              </tr>
        </table>

        
      </div>  
       <!-- box  -->     

    </div>
</div>

