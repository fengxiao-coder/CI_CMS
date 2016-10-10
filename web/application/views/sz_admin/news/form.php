<?php $data['flag']=1;$this->load->view_part($this->_site_path."/main/breadcrumb",$data);?>
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
                
                <tr>
                    <td width="10%" class="tdbg"><label for="category">类型</label></td>
                    <td width="84%" colspan="3">                                                                    
                        <select name="pid" class="m_inpt_border">
                        <option value="">---请选择---</option>    
                        <?php foreach ($options as $k => $v) { ?>
                        <option value="<?php echo $k; ?>" <?php echo isset($news_data['pid']) && $news_data['pid']== $k?"selected='selected'":"";?>><?php echo $v; ?></option>
                        <?php } ?>
                        </select>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="title">标题</label></td>
                    <td width="84%" colspan="3">
                        <input class="m_inpt_border" type="text" id="title" placeholder="标题" name="title" value="<?php echo isset($news_data['title'] ) ? $news_data['title'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="author">作者</label></td>
                    <td width="84%" colspan="3">
                        <input name="author" class="m_inpt_border" value="<?php echo $this->auth->get_user('user_name'); ?>" readonly="readonly">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">关键字</label></td>
                    <td width="84%" colspan="3">
                        <input class="m_inpt_border" type="text" id="keywords" placeholder="关键字" name="keywords" value="<?php echo isset($news_data['keywords'] ) ? $news_data['keywords'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="description">描述</label></td>
                    <td width="84%" colspan="3">
                        <textarea id="description" class="textarea_border" cols="80" rows="5" name="description"><?php echo isset($news_data['description'] ) ? $news_data['description'] : ''; ?></textarea>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="content">内容</label></td>
                    <td width="84%" colspan="3">
                        <textarea name="content" id="editor_id" style="width:500px;height:300px;"><?php echo isset($news_data['content'] ) ? $news_data['content'] : ''; ?></textarea>
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



