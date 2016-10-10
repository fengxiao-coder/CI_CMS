<?php //$this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php 
$button = array("添加"=>array("c_model"=>'add','url'=> base_url("sz_admin/admin/add")));
$this->common->show_title_breadcrumb("admin",$button);
?>

<?php $this->load->view_part($this->_site_path."/admin/search")?>

<!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path."/admin/delete_all");?>">
    <div class="list_box">
        <table id="tb" class="table table-striped table-condensed table-bordered">
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                    <th>状态</th>
					<th>姓名</th>		
					<th>店铺</th>		
					<th>邮箱</th>		
					<th>角色</th>
                    <th>操作</th>
                </tr>

            </thead>
            <tbody>
                
                <?php foreach ($admin_data as $single) { ?>
                <!--  鼠标悬停，整行变色，-->
                <tr  >
                    <td>
                        <input name="ids[]" value="<?php echo $single['admin_id']; ?>" type="checkbox" />
                    </td>
                    
                   
                    <td>
				<?php if( $single['status'] == 1 ) { ?>
				<span class="label label_success">启用</span>
				<?php } else if( $single['status'] == 0 ) { ?>
				<span class="label label_inverse">停用</span>
				<?php } ?>
			</td>
			<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path."/admin/view/{$single['admin_id']}"); ?>';"><?php echo $single['user_name']; ?></td>
			<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path."/admin/view/{$single['admin_id']}"); ?>';"><?php echo $this->store_model->get_value_by_pk($single['store_id'],"sName"); ?></td>
			<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path."/admin/view/{$single['admin_id']}"); ?>';"><?php echo $single['email']; ?></td>
			
			<td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path."/admin/view/{$single['admin_id']}"); ?>';">
                            <?php echo $this->admin_group_model->get_value_by_pk($single['group_id'],'group_name'); ?></td>
                    <td>
                        <a href="<?php echo base_url($this->_site_path . "/admin/edit/{$single['admin_id']}"); ?>">修改</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- 表格底部帮助栏-->
    <div class="tips">
        <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
        <?php if($this->auth->check("admin","delete_all")):?> 
        <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
		<?php endif;?>
        <!-- 分页开始-->
        <?php echo $pagination; ?>
        <!-- 分页结束-->
    </div>
</form>
<!--tips 结束-->
</div>
</div>
</div>

