<?php $this->load->view_part($this->_site_path . "/main/breadcrumb_noadd"); ?>
<!--  详情-->
<?php 
if ($current_type=="purchase"){
	$info = $this->purchase_model->get_by_attributes(array("goods_id" => $goods_id));
}else{
	$info = $this->shipment_model->get_by_attributes(array("goods_id" => $goods_id));
}
//p($info);
?>
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">
        <tr>
            <td width="12%" class="details_title">商品名称</td>
            <td width="38%"><?php echo $info['goods_name']?></td>
            <td width="12%" class="details_title">商品类别</td>
            <td width="38%" ><?php echo $this->goods_category_model->get_value_by_pk($info['cat_id'],'cat_name')?></td>
        </tr>
        <tr>
            <td class="details_title" width="12%">品牌</td>
            <td width="38%"><?php echo $this->brand_model->get_value_by_pk($info['brand_id'],'brand_name')?></td>
            <td class="details_title" width="12%">进货均价</td>
            <td width="38%"></td>
        </tr>
        <tr>
            <td class="details_title" width="12%">库存量</td>
            <td width="88%"colspan="3"><?php echo $this->goods_model->get_value_by_pk($goods_id,"num")?></td>
        </tr>  
        <tr>
            <td class="details_title" width="12%">明细表</td>
            <td width="88%"colspan="3">
            <?php if ($current_type=="purchase"){?>
            	<table border="0" cellpadding="0" cellspacing="0"  class="order_product_tab">
                      <thead>                      
                          <tr class="order_hd"> 
                            <th>商品名称</th>
                            <th>供应商</th>
                            <th>入库人</th>
                            <th>入库量</th>
                            <th>入库时间</th>
                            <th>入库价格</th>
                          </tr>
                      </thead>
                      <tbody>                   
                      <?php foreach ($storage_data as $v){?>
                        <tr class="order_item">
                           <td><?php echo $v['goods_name']?></td>
				            <td><?php echo $this->supplier_model->get_value_by_pk($v['supplier_id'],"name")?></td>
				            <td><?php echo $this->admin_model->get_value_by_pk($v['buyer_id'],"user_name")?></td>
				            <td><?php echo $v['amount']?></td>
				            <td><?php echo date("Y-m-d", $v['modified']); ?></td>
				            <td><?php echo $v['price']?></td>            			
						</tr>							
                        <?php }?>
                       </tbody>                    
                   </table>
            <?php }elseif ($current_type=="shipment"){?>
            		<table border="0" cellpadding="0" cellspacing="0"  class="order_product_tab">
                      <thead>                      
                          <tr class="order_hd"> 
                            <th>商品名称</th>
                            <th>出库人</th>
                            <th>出库量</th>
                            <th>出库时间</th>
                          </tr>
                      </thead>
                      <tbody>                   
                      <?php foreach ($storage_data as $v){?>
                        <tr class="order_item">
                           <td><?php echo $v['goods_name']?></td>
				            <td><?php echo $v['person']?></td>
				            <td><?php echo $v['amount']?></td>
				            <td><?php echo date("Y-m-d", $v['created_time']); ?></td>         			
						</tr>							
                        <?php }?>
                       </tbody>                    
                   </table>
            <?php }?>
            </td>
        </tr>  
        
    </table>
</div>
