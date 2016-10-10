<?php 
$button = array("添加"=>array("c_model"=>'add','url'=> base_url("sz_admin/shipping/add")));
$this->common->show_title_breadcrumb("shipping",$button);
?>

<?php $this->load->view_part($this->_site_path."/shipping/search")?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/default/css/print.css');?>" media="print"/>

<div class="list_box">
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path."/shipping/delete_all");?>">

	<table class="table table-striped table-condensed table-bordered">
		<thead>
                            <tr class="table-thbg">
                                <th class="selection_box">
                                    <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                                </th>
                                <th>配送方式</th>                                
                                <th>描述</th>     
                                <th>操作</th>                            
                            </tr>

        </thead>
		<tbody>
			<?php foreach($shipping_data as $single){?>
			<tr>
				<td>
					<input name="ids[]" value="<?php echo $single['shipping_id']; ?>" type="checkbox" />
				</td>				
                <td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/shipping/view/{$single['shipping_id']}"); ?>';"><?php echo $single['shipping_name']; ?></td>   
                <td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path . "/shipping/view/{$single['shipping_id']}"); ?>';"><?php echo $single['shipping_desc']; ?></td>         
              	<td>
					<a href="<?php echo base_url($this->_site_path."/shipping/edit/{$single['shipping_id']}"); ?>">修改</a>
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