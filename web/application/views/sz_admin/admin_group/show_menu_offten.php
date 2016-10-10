 <?php echo css("css/style.css");?>
<?php echo js("js/jquery.js");?>   
 <div class="permission_box">
     <form id='for_group'>
         <h1 class="title">常用菜单栏&nbsp;&nbsp;
             <input class="i_c" type="checkbox" name="checkAll" onclick="checkAllOptions()" value="复选框" id="复选框组1_0" /><span class="i_s">全选</span>
             </h1>
             <?php  
             foreach($this->office_left->power as $k => $v){ 
                 ?>
             <div class="box_items">     
             	<h1><input type="checkbox" name="che_box_info[]" onclick="check_box_info(this)" value="复选框" id="复选框组1_0" /><span><?php echo  $k;?></span></h1>
                     <ul>
                         <?php    
                         foreach($v as $kt => $thd_val){ 
                             ?>
                              
                         <li>
                             <label class="lab"> 
                                 <input type="checkbox" name="offtens[]" value="<?php echo $thd_val['office_id'];?>" id="checkbox_<?php echo $thd_val['office_id'];?>"
                                         <?php 
                                         
                                         if(isset($old_menu_office) && in_array($thd_val['office_id'], array_keys($old_menu_office))){ echo "checked=checked";}?>   
                                        /><?php echo $kt;?>
                             </label>
                         </li>
                         <?php 
                                
                         }
                         ?>
                         <div class="float_clear"></div>
                      </ul>
             </div>
             <?php 
             }
             ?>
              <div class="control_group btn_group">
                  <button type="button" class="btn btn_style1" id="btn">修改</button>
                  <button type="button" class="btn btn_style1">重置</button>
              </div>
     </form>
  </div>     
            

<script type="text/javascript">
function checkAllOptions(){
	if($("input[name='checkAll']").attr("checked")==='checked'){
		$("input[name='operations[]']").attr('checked','checked');
	}else{
		$("input[name='operations[]']").removeAttr('checked');
	}
}

	$("#btn").click(

            function(){
                $.ajax({
		   type: "POST",
		   url: "<?php echo module_url("admin_group/main/select_menu_offtens_box");?>",
		   data: $("#for_group").serialize(),
		   success: function(msg){
		   var val = $("#for_group").serialize();
		   parent.$("#offten_arr").html(msg);
		   parent.$.fancybox.close();
		   } 
                   });
	});


function check_box_info(obj){
    if($(obj).attr("checked")==='checked'){
       $(obj).parent().parent().find("ul li input[name='offtens[]']").attr('checked','checked'); 
    }else{
        $(obj).parent().parent().find("ul li input[name='offtens[]']").removeAttr('checked');
    }
}
</script>
