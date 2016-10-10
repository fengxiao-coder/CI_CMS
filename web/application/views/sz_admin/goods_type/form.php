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
                    <td width="10%" class="tdbg"><label for="cat_name">商品类别</label></td>
                    <td width="84%" colspan="3">
                        <select name="type_name"  class="m_inpt_border">
                            <option value='0'>---请选择---</option>
                            <?php foreach ($goods_category_data as $v): ?>
                                <option value='<?php echo $v['cat_id']; ?>' <?php if (isset($goods_type_data['type_name']) && $goods_type_data['type_name'] == $v['cat_id']): ?>selected='selected'<?php endif; ?>><?php echo $v['cat_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td width="10%" class="tdbg"><label for="real_name">备注</label></td>
                    <td width="84%" colspan="3">
                        <textarea name="remark" id="editor_id" style="width:500px;height:300px;"><?php echo isset($goods_type_data['remark'] ) ? $goods_type_data['remark'] : ''; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="email">排序</label></td>
                    <td width="84%" colspan="3">
                        <input class="m_inpt_border" type="text" id="depth" placeholder="排序" name="sort" value="<?php echo isset( $goods_type_data['sort'] ) ? $goods_type_data['sort'] : ''; ?>">
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
