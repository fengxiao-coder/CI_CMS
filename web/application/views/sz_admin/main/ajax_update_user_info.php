
<?php echo js("js/kindeditor/kindeditor.js"); ?>
<?php echo js("js/kindeditor/lang/zh_CN.js"); ?>
<script>
    KindEditor.ready(function (K) {
        window.editor = K.create('#editor_id');
    });
</script>
<!--  添加信息页面-->
<div  >
    <?php get_messagebox();// 获取提示框 ?>
    <div class="box box-radius">
        <form method="post">

            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               
                <tr>
                    <td width="15%" class="tdbg"><label for="user_name">姓名</label></td>
                    <td width="85%" colspan="3">
			<input type="text" name="user_name" id="user_name" class="m_inpt_border"  style=" width:420px" readOnly='readOnly' value="<?php echo $user_data['user_name']; ?>">
                        <span class="span"></span>
                    </td>
                </tr>
 
                <tr>
                    <td width="15%" class="tdbg"><label for="prepass">当前密码</label></td>
                    <td width="85%" colspan="3">
                        <input type="password" name="prepass" id="prepass" style=" width:420px"  class="m_inpt_border"> 
                        <span class="span"></span>    
                    </td>
                </tr>
                <tr>
                    <td width="15%" class="tdbg"><label for="password">新密码</label></td>
                    <td width="85%" colspan="3">
                        <input class="m_inpt_border" type="password" id="password" style=" width:420px"  name="password">
                        
                    </td>
                </tr>
                <tr>
                    <td width="15%" class="tdbg"><label for="password2">确认密码</label></td>
                    <td width="85%" colspan="3">
                        <input class="m_inpt_border" type="password" id="password2"style=" width:420px"   name="password2">
                        <span class="span"></span>
                    </td>
                </tr>
                <tr>
                    <td width="15%" class="tdbg"><label for="real_name">真实姓名</label></td>
                    <td width="85%" colspan="3">
			<input type="text" name="real_name" id="real_name" class="m_inpt_border" style=" width:420px"  value="<?php echo $user_data['real_name'] ?>">
                        <span class="span"></span>
                    </td>
                </tr>
                 <tr>
                    <td width="15%" class="tdbg"><label for="real_name">邮箱</label></td>
                    <td width="85%" colspan="3">
			<input type="text" name="button" id="email" class="m_inpt_border" style=" width:420px"  value="<?php echo $user_data['email'] ?>">
                        <span class="span"></span>
                    </td>
                </tr>
                
            </table>

            <!--选填项-->
            <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $user_data['admin_id'];?>">

            <div class="control_group btn_group">
                <label class="control_label" style="width:15%" for="body"></label>
                <div class="controls">
                    <button type="submit"  class="btn btn_style1" id="update_user_info"><span>确定</span></button>
                    <span class="span"></span>
                </div>
            </div>
        </form>  
        <script>
           $(function(){
               $("#update_user_info").click(function(){
                   var admin_id=$("#admin_id").val();
                   var user_name=$("#user_name").val();
                   var prepass=$("#prepass").val();
                   var password=$("#password").val();
                   var password2=$("#password2").val();
                   var real_name=$("#real_name").val();
                   var email=$("#email").val();
                   p={admin_id:admin_id,user_name:user_name,prepass:prepass,password:password,password2:password2,real_name:real_name,email:email};
                   var url="<?php echo base_url('sz_admin/main/ajax_update_user_info');?>";
                   $.post(url,p,function(d){
                       if(d.field){
                            $('#'+d.field).next().html(d.msg);
                        }else{
                           alert(d.msg);
                           parent.$.fancybox.close();
                        };
                   },'json');
                   return false;
               });
               $('input').focus(function(){
                    $(this).next().html('');
                })
           })
        </script>
         <div class="float_clear"></div>
    </div>  
    </div>
</div>


 
