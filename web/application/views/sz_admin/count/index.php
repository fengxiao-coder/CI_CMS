<?php $this->load->view_part($this->_site_path."/main/breadcrumb_noadd");?>
<?php $this->load->view_part($this->_site_path."/count/search")?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/default/css/print.css');?>" media="print"/>

<div class="list_box">
    <div id="tab_box">
    <form method="post" action="<?php echo base_url($this->_site_path."/store/delete_all");?>">
    <div class=" display_block">
	<table class="table table-striped table-condensed table-bordered">
		<thead>
                            <tr class="table-thbg">           
                            	<th>货号</th>                  
                                <th>商品名称</th>                                
                                <th>销售量</th>
                                <th>销售额</th>
                                <th>单价</th>
                            </tr>

        </thead>
		<tbody>
		<?php foreach ($goods_data as $single){ ?>
			<tr>				
				<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/count/view/{$single['goods_id']}"); ?>';"><?php echo $single["goods_sn"]?></td>				
                <td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/count/view/{$single['goods_id']}"); ?>';"><?php echo $single["goods_name"]?></td>    				
				<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/count/view/{$single['goods_id']}"); ?>';"><?php echo $single["sum(goods_number)"]?></td>
				<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/count/view/{$single['goods_id']}"); ?>';">￥<?php echo $single["sum(goods_number)"]*$single["price"]?>元</td>
				<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/count/view/{$single['goods_id']}"); ?>';">￥<?php echo $single["price"]?>元</td>
			</tr>
		<?php }?>
	</tbody>
	</table>
	 </div>
                <!-- 表格底部帮助栏-->
                <div class="tips">
                    <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/
                    <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div>/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
                    <!-- 分页开始-->
                    <?php echo $pagination; ?>
                    <!-- 分页结束-->
                </div>
</form>
</div>
</div>