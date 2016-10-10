<?php $data['flag']=1;$this->load->view_part($this->_site_path."/main/breadcrumb",$data);


?>
<!--  添加信息页面-->

<div class="box box-headtitle box-radius">
<?php get_messagebox();// 获取提示框 ?>
	<form method="post" id="fom_group">

		<!--<div class="control_group">
			<label class="control_label" for="group_name">名称</label>
			<div class="controls">
				<input type="text" class="m_inpt_border" name="group_name" id="group_name" placeholder="" value="<?php echo isset($admin_group_data['group_name'] ) ? $admin_group_data['group_name'] : ''; ?>">
			</div>
		</div>
		
		<div class="control_group">
			<label class="control_label" for="group_description">备注</label>
			<div class="controls">
                            <textarea id="group_description" class="m_inpt_border" cols="80" rows="5" name="group_description" style="height: 100px; width: 520px;"><?php echo isset($admin_group_data['group_description'] ) ? $admin_group_data['group_description'] : ''; ?></textarea>
			</div>
		</div>
		
		
            
		<div class="control_group">
			<label class="control_label" for="group_id">权限设置</label>
                        <div class="controls" style="width:84%">
                             
                                <div style="clear:both">
                                <?php $group_id = isset($admin_group_data['group_id'])?$admin_group_data['group_id']:0;?>
                                    <a  id="admin_group_form" href="<?php echo base_url("sz_admin/admin_group/show_admin_group/{$group_id}");?>" style="color:green">请<?php echo isset($admin_group_data['group_id'])?'修改' : '设置' ;?></a>
                                <?php if(isset($admin_group_data['group_id'])){?>
                                <div style="float:right"><a href="javascript:show_operations()">展开权限</a></div>
                                <?php  }?>
                                </div>
                             
				<div  id="deal_users_box" style="margin-left:120px">
						<?php if(isset($admin_data['admin_id'])){
							foreach($admin_data['group_id'] as $vale ){
						?>
							<label style="float:left"><input type="checkbox" checked="checked" value="<?php echo $vale;?>" name="group_id[]">
								<?php echo $this->admin_group_model->get_value_by_pk($vale,"group_name");?>
							</label>
						<?php }
							}
						?>
				</div>
                                <div style="clear:both"></div>
                                <div id="operations_div" style='display: none'>
                                <?php 
                                   if(isset($show_c_op)){
                                    foreach($show_c_op as $k_name=> $value){?>  
                                <div class="box_items" style="width:850px;margin: 0 0 0;" >
                                    <h1><span><?php echo $k_name;?></span></h1>
                                    <ul>
                                        <?php foreach($value as $v){?>
                                        <li > <label class="lab"> <?php echo $v;?></label></li>
                                        <?php  } ?>
                                        <div class="float_clear"></div>
                                    </ul>
                                </div>
                               <?php  
                                    }
                                        }?>
                                  </div>  
			</div>
		</div>
            
                <div class="control_group">
			<label class="control_label" for="group_description">常用菜单设置</label>
			<div class="controls" style="width:84%">
                            
                            <div style="clear:both">
                                <a  id="show_menu_offten" href="<?php echo base_url("sz_admin/admin_group/show_menu_offten/{$group_id}");?>" style="color:green">请<?php echo isset($admin_group_data['group_id'])?'修改' : '设置' ;?></a>
                                <?php if(isset($admin_group_data['group_id'])){?>
                                <div style="float:right"><a href="javascript:show_menu_operations()">展开常用菜单</a></div>
                                <?php  }?>
                             </div>  
                            
                             <div style="clear:both"></div>
                              <div id="menu_div"  style='display: none'>
                                <?php foreach($show_menu_office as $k_name=> $value){?>  
                                <div class="box_items" style="width:850px;margin: 0 0 0;" >
                                    <h1><span><?php echo $k_name;?></span></h1>
                                    <ul>
                                        <?php foreach($value as $k=>$v){
                                            ?>
                                        <li > <label class="lab"> <?php echo $v;?></label></li>
                                        <?php  
                                        }
                                        ?>
                                        <div class="float_clear"></div>
                                    </ul>
                                </div>
                               <?php  }?>
                               </div>
			</div>
		</div>
                <div id="operations_arr" style='display:none'></div>
                <div id="offten_arr" style='display:none'></div>-->
	
                
                
                 <table cellspacing="0" cellpadding="0" border="0" class="addinfo_table">
            <tbody>
                <tr>
                    <td width="10%" class="tdbg"><label for="group_name">名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" class="m_inpt_border" name="group_name" id="group_name" placeholder="" value="<?php echo isset($admin_group_data['group_name'] ) ? $admin_group_data['group_name'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="group_description">备注</label></td>
                    <td width="84%" colspan="3">
                        <textarea id="group_description" class="textarea_border" cols="80" rows="5" name="group_description" ><?php echo isset($admin_group_data['group_description'] ) ? $admin_group_data['group_description'] : ''; ?></textarea>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="group_id">权限设置</label></td>
                    <td width="84%" colspan="3">
                                                   <div style="clear:both;width:84%"  >
                                <?php $group_id = isset($admin_group_data['group_id'])?$admin_group_data['group_id']:0;?>
                                    <a  id="admin_group_form" href="<?php echo base_url("sz_admin/admin_group/show_admin_group/{$group_id}");?>" style="color:green">请<?php echo isset($admin_group_data['group_id'])?'修改' : '设置' ;?></a>
                                <?php if(isset($admin_group_data['group_id'])){?>
                                <div style="float:right"><a href="javascript:show_operations()" id="operations_a">展开权限</a></div>
                                <?php  }?>
                                </div>
                              <div style="clear:both"></div>
				<div  id="deal_users_box" style="margin-left:120px">
						<?php if(isset($admin_data['admin_id'])){
							foreach($admin_data['group_id'] as $vale ){
						?>
							<label style="float:left"><input type="checkbox" checked="checked" value="<?php echo $vale;?>" name="group_id[]">
								<?php echo $this->admin_group_model->get_value_by_pk($vale,"group_name");?>
							</label>
						<?php }
							}
						?>
				</div>
                                <div style="clear:both"></div>
                                <div id="operations_div" style='display: none'>
                                <?php 
                                   if(isset($show_c_op)){
                                    foreach($show_c_op as $k_name=> $value){?>  
                                <div class="box_items" style="width:99%;margin: 0 0 0;" >
                                    <h1><span><?php echo $k_name;?></span></h1>
                                    <ul>
                                        <?php foreach($value as $v){?>
                                        <li > <label class="lab"> <?php echo $v;?></label></li>
                                        <?php  } ?>
                                        <div class="float_clear"></div>
                                    </ul>
                                </div>
                               <?php  
                                    }
                                        }?>
                                  </div>  
                    </td>
                </tr>
              <!--  <tr>
                    <td width="10%" class="tdbg"><label for="title">常用菜单设置</label></td>
                    <td width="84%" colspan="3">
                        <div class="controls" style="width:84%">
                            
                            <div style="clear:both">
                                <a  id="show_menu_offten" href="<?php echo base_url("sz_admin/admin_group"
                                        . "/show_menu_offten/{$group_id}");?>" style="color:green">请<?php echo isset($admin_group_data['group_id'])?'修改' : '设置' ;?></a>
                                <?php if(isset($admin_group_data['group_id'])){?>
                                <div style="float:right"><a href="javascript:show_menu_operations()">展开常用菜单</a></div>
                                <?php  }?>
                             </div>  
                            
                             <div style="clear:both"></div>
                              <div id="menu_div"  style='display: none'>
                                <?php foreach($show_menu_office as $k_name=> $value){?>  
                                <div class="box_items" style="width:99%;margin: 0 0 0;" >
                                    <h1><span><?php echo $k_name;?></span></h1>
                                    <ul>
                                        <?php foreach($value as $k=>$v){
                                            ?>
                                        <li > <label class="lab"> <?php echo $v;?></label></li>
                                        <?php  
                                        }
                                        ?>
                                        <div class="float_clear"></div>
                                    </ul>
                                </div>
                               <?php  }?>
                               </div>
			</div>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="type">描述</label></td>
                    <td width="84%" colspan="3">
                        <input class="m_inpt_border"  type="text" name="content" id="content" placeholder="" value="<?php echo isset($config_data['content']) ? $config_data['content'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>-->
            </tbody>
        </table>
		 <div id="operations_arr" style='display:none'></div>
            <div id="offten_arr" style='display:none'></div>
            
            <div class="control_group btn_group">
                <label class="control_label" for="body"></label>
                <div class="controls">
                    <button type="submit" class="btn btn_style1"><span>提交</span></button>
                    <button type="reset" class="btn btn_style1"><span>重置</span></button>
                </div>
            </div>
		<input type="hidden" name="is_submit" value="1">
		<!--__TOKEN__-->
	</form>
</div>
</div>
<script>
       	$("#admin_group_form").fancybox({
		'hideOnOverlayClick':false,
		'hideOnContentClick':false,
		'enableEscapeButton':false,
		'autoDimensions':false,
                'autoScale':true,
		'width':790,
		'height':1000,
		'type':'iframe',
		
	});
         $("#show_menu_offten").fancybox({
		'hideOnOverlayClick':false,
		'hideOnContentClick':false,
		'enableEscapeButton':false,
		'autoDimensions':false,
                'autoScale':true,
		'width':790,
		'height':1000,
		'type':'iframe',
		'ajax':{
			'type':'post',
			'cache' : false,
			'data':$("#fom_group").serialize(),
		}
	});
        function show_operations(){
            var a =$("#operations_a").html();
            if(a =="展开权限"){
                $("#operations_a").html("收起权限")
            }else{
                $("#operations_a").html("展开权限");
            }
            $('#operations_div').toggle()
        }
         function show_menu_operations(){
            $('#menu_div').toggle()
        }
</script>
