<?php echo css("css/style.css");?>     
<?php echo js("js/jquery.js");?>   

<style>
body{
    background: none repeat scroll 0 0 #e3eff6;
    font-family: "微软雅黑";
    font-size: 14px;
    font-weight: normal;
}    
.permission_box1{
	  position: absolute;
	   z-index: 2;
}
.btn_group1 {
  margin: 20px 0 0 260px;
}
</style>
       <div class="box box-headtitle box-radius">
         
     <form method="post" id="admin_group_f_box">

           <!--设置权限弹框-->
           <div class="permission_box1" >
             <h1 class="title">用户角色</h1>

             <div class="box_items">     
             	
                     <ul>
                         <?php foreach($admin_group as  $key =>$val){?>
						 <li><label class="lab">
							 <input type="checkbox" name="group_id[]" value="<?php echo $key;?>" id="checkbox_0"  <?php    if( !empty($check_group_id) && in_array($key,$check_group_id)){ echo "checked=true";}?> />
							 <?php echo $val;?></label>
							 </li>
						 <?php }?>
                         <div class="float_clear"></div>
                      </ul>
             </div>


             
              <div class="control_group btn_group1">
                  <button id="check_ok" type="button" class="btn btn_style1">修改</button>
                  <button type="reset" class="btn btn_style1">重置</button>
              </div>
               <input type="hidden" name="is_submit" value="1">
               <input type="hidden" name="token" value="">
           </div>
           
        </form>  
      </div>          
<script >
	$("#check_ok").click(function(){
		$.ajax({
		   type: "POST",
		   url: "<?php echo base_url("admin/admin_group/select_group_box");?>",
		   data: $("#admin_group_f_box").serialize(),
		   success: function(msg){
		   var val = $("#admin_group_f_box").serialize();
		   var  hf = parent.$("#admin_group_form").attr("href");
		  
		   parent.$("#admin_group_form").attr("href",hf+"?"+val);
		   parent.$("#deal_users_box").html(msg);
		   parent.$.fancybox.close();
		   }
		});
	});
</script>