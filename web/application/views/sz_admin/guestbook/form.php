<?php $data['flag']=1;$this->load->view_part($this->_site_path."/main/breadcrumb",$data);?>
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

            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">
                <?php foreach ($this->$modelname->form_array as $k => $v): ?>
                <tr>
                    <td width="10%" class="tdbg"><label><?php echo $v ?></label></td>
                    <td width="37%"><input type="text" name="<?php echo $k ?>" id="<?php echo $k ?>" placeholder="" class="x_inpt_border" value="<?php echo isset( $guestbook_data[$k] ) ? $guestbook_data[$k] : '' ; ?>"><span class="span">*</span></td>
                </tr>
                <?php endforeach; ?>
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
