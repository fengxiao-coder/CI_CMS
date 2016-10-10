<?php 
$data['flag']=1;$this->load->view_part($this->_site_path."/main/breadcrumb",$data);
 ?>
<?php echo js("js/jquery.js") ?>
<!--  添加信息页面-->
<div  >
    <?php get_messagebox();// 获取提示框 ?>
    <!--<div class="breadcrumb">
        <div class="breadcrumb_i">您当前所在的位置：<span>配送中心</span>&nbsp;-&nbsp;<span>售前检测管理</span>&nbsp;-&nbsp;<span class="orange">添加</span></div>
        <div class="breadcrumb_div"><a href="#" class="breadcrumb-return">返回</a></div>
        <div class="breadcrumb_div"><a href="list.htm"  target="home"class="breadcrumb-list">列表</a></div>    
        <div class="breadcrumb_div"><a href="addinfo.htm" target="home" class="breadcrumb-add">添加</a></div> 
    </div>-->
    <!--  添加-->
    <div class="box box-radius">
        <form method="post">
            <!-- 必填项-->

             <table cellspacing="0" cellpadding="0" border="0" class="addinfo_table">
            <tbody>
                <tr>
                    <td width="10%" class="tdbg"><label for="type_name">名称</label></td>
                    <td width="84%" colspan="3">
                        <input  class="m_inpt_border" type="text" name="type_name" id="type_name" placeholder="" value="<?php echo isset($operations_type_data['type_name'] ) ? $operations_type_data['type_name'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="url">url地址</label></td>
                    <td width="84%" colspan="3">
                        <input  class="m_inpt_border" type="text" name="url" id="url" placeholder="" value="<?php echo isset($operations_type_data['url'] ) ? $operations_type_data['url'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="type_name">权限类别</label></td>
                    <td width="84%" colspan="3">
                         <select name="pid" id="pid"  onchange="p_show()" class="m_inpt_border_m" >
                                    <option value="0" >最大类别</option>
                                    <?php 
                                           $f_pid = $operations_type_data['pid'];
                                           $edit_pid = 0 ;
                                           $selet_pid = $this->operations_type_model->get_values("type_id",'type_name','',array("in"=>array('pid'=>0)));
                                            if(isset($operations_type_data['type_id']) ){
                                               $checked_x = $this->operations_type_model->get_by_pk($operations_type_data['pid']);
                                               if(!empty($checked_x) && $checked_x['pid']){
                                                   $checked_f = $this->operations_type_model->get_by_pk($checked_x['pid']);
                                                       $edit_pid = $f_pid = $checked_f['type_id'];
                                                      // echo "<script>p_show($f_pid)</script>";
                                               }
                                           }
                                        
                                           foreach($selet_pid as $pid=>$type_name){
                                    ?>
                                    <option value= '<?php  echo $pid;?>'<?php  if(isset($operations_type_data['type_id'])&&  $f_pid==$pid){ echo "selected='selected'";}?>><?php echo $type_name ;?></option> 
                                    <?php }
                                    ?>
                                </select>
                            <select name="pid_second" id="pid1" style="display:none" class="m_inpt_border_m" >
                                    <option value="" >请选择</option>
                                </select> 
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="title">操作类型</label></td>
                    <td width="84%" colspan="3">
                        		 <select name="status"  class="m_inpt_border" >
                                     <option value="0"  <?php echo  (isset($operations_type_data['status'])&&$operations_type_data['status']==0)?"selected=selected":""?> >普通管理员</option>
                                    <option value="1"  <?php echo  (isset($operations_type_data['status'])&&$operations_type_data['status']==1)?"selected=selected":""?> >系统管理员</option>
                                </select> 
                        <span class="span">*</span>
                    </td>
                </tr>
                <!--  
                <tr>
                    <td width="10%" class="tdbg"><label for="img">图片</label></td>
                    <td width="84%" colspan="3">
                       <input type="file" class="m_inpt_border"  name="img" id="remark" placeholder="" value="">
                        <span class="span">*</span>
                    </td>
                </tr>
                -->
				<tr>
                    <td width="10%" class="tdbg"><label for="remark">备注</label></td>
                    <td width="84%" colspan="3">
                        <textarea id="remark" class="textarea_border" cols="80" rows="5" name="remark"><?php echo isset($operations_type_data['remark'] ) ? $operations_type_data['remark'] : ''; ?></textarea>
                        
                    </td>
                </tr>
				<tr>
                    <td width="10%" class="tdbg"><label for="sequence">排序</label></td>
                    <td width="84%" colspan="3">
                       <input type="text"  class="m_inpt_border" name="sequence" id="sequence" placeholder="" value="<?php echo isset($operations_type_data['sequence'] ) ? $operations_type_data['sequence'] : ''; ?>">
                        
                    </td>
                </tr>
				

		
	
            </tbody>
        </table>

            <!--选填项-->
<!--__TOKEN__-->

            <div class="control_group btn_group">
                <label class="control_label" for="body"></label>
                <div class="controls">
                    <button type="submit" class="btn btn_style1"><span>提交</span></button>
                    <button type="reset" class="btn btn_style1"><span>重置</span></button>
                </div>
            </div>
            <input type="hidden" name="is_submit" value="1">
        </form>  
        <div class="float_clear"></div>

    </div>          
    <script type="text/javascript">
        var p_html = $("#pid1").html()
        function p_show(checked){
             if(!arguments[0]) checked = 0;
            var  pid = $("#pid").val();
            var  str = "";
            if(checked){
               str += "&checked="+checked;
            }
            if(pid ==0){
               $("#pid1").css("display","none");
               $("#pid1").html(p_html)
            }else{
                $.ajax({
                    type :'get',
                    url : <?php echo "'". base_url("sz_admin/operations_type/ajax_get_operations_type") . "'";?>,
                    data :"pid="+pid+str,
                    success : function(ret){
                        if(ret){
                          $("#pid1").html(p_html+ret)
                          $("#pid1").show() ;
                        }
                    }    
                })
            }
        }
    </script>
     <?php if($edit_pid){
           echo "<script>p_show('{$operations_type_data['pid']}')</script>";
     }?>

    </div>
</div>


