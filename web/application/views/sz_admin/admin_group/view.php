<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>
<!--  详情-->
<div class="box box-headtitle box-radius">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">

		<tr>
			<td width="12%" class="details_title"><strong>名称</strong></td>
            <td width="88%"><?php echo $admin_group_data["group_name"] ?></td>
		</tr>
		
		<tr>
			<td width="12%" class="details_title"><strong>备注</strong></td>
            <td width="88%"><?php echo $admin_group_data["group_description"] ?></td>
		</tr>
		
		<tr>
			<td width="12%" class="details_title"><strong>权限</strong></td>
            <td width="88%">           
            	<?php 
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
                <?php  }?>
            </td>
		</tr>
		
		<tr>
			<td width="12%" class="details_title"><strong>创建时间</strong></td>
            <td width="88%"><?php echo init_date($admin_group_data['created']); ?></td>
		</tr>

		<tr>
			<td width="12%" class="details_title"><strong>修改时间</strong></td>
            <td width="88%" ><?php echo init_date($admin_group_data['modified']); ?></td>
		</tr>
	</table>
</div>
