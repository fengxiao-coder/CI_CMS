<link href="<?php echo base_url("theme/default/css/style.css");?>" rel="stylesheet" type="text/css" />  
<?php echo js("js/jquery.js");?>
<style>

 </style>
 
 


 <div class="permission_box">
     <form id='for_group'>
     <?php $group_name =  $this->admin_group_model->get_value_by_pk($g_id,"group_name")?>
             <h1 class="title"><?php echo $group_name = empty($group_name)?"角色":$group_name;?>拥有的权限&nbsp;&nbsp;
                 <input class="i_c" type="checkbox" name="checkAll" onclick="checkAllOptions()" value="复选框" id="复选框组1_0" /><span class="i_s">全选</span>
             </h1>

             <?php 
             
                if($is_guan){
                    $f_search = array('orders'=>array('sequence'=>'asc'),"in"=>array("pid"=>0 ));   
                }else{
                    $f_search = array('orders'=>array('sequence'=>'asc'),"in"=>array("pid"=>0 ,'status'=>0));           
                }
                $f_op_data = $this->operations_type_model->get_values('type_id','type_name','',$f_search);
                foreach( $f_op_data as $k => $v){
                    if($is_guan){
                          $s_search = array('orders'=>array('sequence'=>'asc'),"in"=>array("pid"=>$k));
                    }else{
                        $s_search = array('orders'=>array('sequence'=>'asc'),"in"=>array("pid"=>$k,'status'=>0));
                    }
                    $second_op =  $this->operations_type_model->all($s_search);
                    foreach($second_op as $s_k =>$s_val){
                 ?>
             <div class="box_items">     
                 <h1><input type="checkbox" name="che_box_info[]" onclick="check_box_info(this)"value="复选框" id="复选框组1_0" /><span><?php echo $s_val['type_name'];?></span></h1>
                     <ul style="width:99%">
                         <?php  
                                if($is_guan){
                                    $t_search =  array('orders'=>array('sequence'=>'asc'),"in"=>array("pid"=>$s_val['type_id']));
                                }else{
                                    $t_search =  array('orders'=>array('sequence'=>'asc'),"in"=>array("pid"=>$s_val['type_id'],'status'=>0));
                                }
                                foreach($this->operations_type_model->all($t_search) as $thd_val){ 
                                 $a = $this->operations_model->get_values('operation_id','operation_name','',array('attributes'=>array('operations_type_id'=>$thd_val['type_id'])));
      
                                if(!empty($a)){                             
                                    foreach($a  as $tk=>$tvl){
                             ?>
                            
                         <li>
                             <label class="lab"> 
                                 <input type="checkbox" name="operations[]" value="<?php echo $tk;?>" id="checkbox_<?php echo $tk;?>"
                                         <?php if(isset($old_operations) && in_array($tk, array_keys($old_operations))){ echo "checked=checked";}?>   
                                        /><?php echo $tvl;?>
                             </label>
                         </li>
                         <?php 
                                }
                                }
                         }
                         ?>
                         <div class="float_clear"></div>
                      </ul>
             </div>
             <?php }
             }
             ?>
    <div class="control_group btn_group">
        <button type="button" class="btn btn_style1" style="height:23px" id="bt">提交</button>
                  <button type="button" class="btn btn_style1" style="height:23px">重置</button>
              </div>
     </form>
     
      <script type="text/javascript">
function checkAllOptions(){
	if($("input[name='checkAll']").attr("checked")==='checked'){
		$("input[name='operations[]']").attr('checked','checked');
                $("input[name='che_box_info[]']").attr('checked','checked');
               
	}else{
		$("input[name='operations[]']").removeAttr('checked');
                $("input[name='che_box_info[]']").removeAttr('checked');
	}
}

function check_box_info(obj){
    if($(obj).attr("checked")==='checked'){
       $(obj).parent().parent().find("ul li input[name='operations[]']").attr('checked','checked'); 
    }else{
        $(obj).parent().parent().find("ul li input[name='operations[]']").removeAttr('checked');
    }
}
	$("#bt").click(

            function(){
                $.ajax({
		   type: "POST",
		   url: "<?php echo base_url("sz_admin/admin_group/select_use_group_box");?>",
		   data: $("#for_group").serialize(),
		   success: function(msg){
		   var val = $("#for_group").serialize();
		   parent.$("#operations_arr").html(msg);
		   parent.$.fancybox.close();
		   } 
                   });
	});

</script>
  </div>     
            


