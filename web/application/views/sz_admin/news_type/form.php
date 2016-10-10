<?php $data['flag']=1;$this->load->view_part($this->_site_path."/main/breadcrumb",$data);?>
<?php echo js("js/kindeditor/kindeditor.js"); ?>
<?php echo js("js/kindeditor/lang/zh_CN.js"); ?>
<?php echo js("js/jquery.js"); ?>
<script>
    KindEditor.ready(function (K) {
        window.editor = K.create('#editor_id');
    });
</script>
<!--  添加信息页面-->
<div  >
    <?php get_messagebox();// 获取提示框 ?>
    <!--  添加-->
    <div class="box box-radius">
        <form method="post">
            <!-- 必填项-->

            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               
                <tr>
                    <td width="10%" class="tdbg"><label for="news_name">名称</label></td>
                    <td width="84%" colspan="3">
			<input type="text" name="type_name" id="type_name" class="m_inpt_border" placeholder="名称" value="<?php echo isset( $news_type_data['type_name'] ) ? $news_type_data['type_name'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>

                <tr>
                    <td width="10%" class="tdbg"><label for="news_type">上级分类</label></td>
                    <td width="84%" colspan="3">                       
                        <select name="pid" class="m_inpt_border" id="news_pid">
                        <option value="">---请选择---</option>    
                        <?php foreach ($options as $k => $v) { ?>
                        <option value="<?php echo $k; ?>" <?php if(isset($news_type_data['pid'])&&$news_type_data['pid']==$k) echo 'selected'; ?>><?php echo $v; ?></option>
                        <?php } ?>
                        <span class="span">*</span>
 
                    </td>
                </tr>
  
                <tr>
                    <td width="10%" class="tdbg"><label for="remark">备注</label></td>
                    <td width="84%" colspan="3">
                        <textarea name="remark" id="editor_id" style="width:500px;height:300px;"><?php echo isset($news_type_data['remark'] ) ? $news_type_data['remark'] : ''; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="depth">排序</label></td>
                    <td width="84%" colspan="3">
                        <input class="m_inpt_border" type="text" id="depth" placeholder="排序" name="depth" value="<?php echo isset( $news_type_data['depth'] ) ? $news_type_data['depth'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
            </table>

            <!--选填项-->


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

    </div>
</div>
<script type="text/javascript">
  $("#news_pid").change(function(){      
    var a=$("#news_pid").val();
    var b=<?php echo  $news_type_data['id']; ?>;
    var p={"id":b,"pid":a};    
    $.ajax({
              async:true,
              type:"get",
              url:"<?php echo base_url("sz_admin/news_type/check_pid");?>",
              data:p,
              dataType:"json",
              success : function(ret){
                    if(ret){

                    }else{
                        alert('父级分类选择有误！');
                        $("#pid").val(<?php echo $news_type_data['pid']; ?>);
                    }
                } 
          });
      })
</script> 