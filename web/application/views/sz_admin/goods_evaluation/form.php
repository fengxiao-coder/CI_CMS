<?php //$this->load->view_part($this->_site_path."/main/breadcrumb");?>
<!--头部-->
<div class="max_mainbox">
    <div class="min_mainbox">
        <!--  添加信息页面-->
        <div class="add_info">
            <div class="breadcrumb">
                <div class="breadcrumb_i">您当前所在的位置：
                    <span>
                        <a href="">用户评价-回复</a>
                    </span>
                </div>
            </div>
<!--头部end-->
<div  >
<?php get_messagebox();// 获取提示框 ?>
<div class="box box-radius">
	<form method="post">
		<table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               

                <tr>
                    <td width="10%" class="tdbg"><label for="password">用户名</label></td>
                    <td width="84%" colspan="3">
                        <input disabled="disabled" type="text" name="user_name" class="m_inpt_border"  value="<?php echo isset( $info['user_id'] ) ? $this->user_model->get_value_by_pk($info["user_id"],"user_name") : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                
                <tr>
                    <td width="10%" class="tdbg"><label for="password">商品名称</label></td>
                    <td width="84%" colspan="3">
                        <input disabled="disabled" type="text" name="goods_name" id="name" class="m_inpt_border" value="<?php echo isset( $info['goods_id'] ) ? $this->goods_model->get_value_by_pk($info["goods_id"],"name") : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>                           
                <tr>
                    <td width="10%" class="tdbg"><label for="password">评价内容</label></td>
                    <td width="84%">
                    <textarea disabled="disabled" name="content" class="textarea_border"><?php echo isset( $info['content'] ) ? $info['content'] : ''; ?></textarea>
                    <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">回复内容</label></td>
                    <td width="84%">
                    <textarea name="content" class="textarea_border"><?php echo isset( $reply_data['content'] ) ? $reply_data['content'] : $this->input->post("content"); ?> </textarea>
                    <span class="span">*</span>
                    <input type="hidden" name="ge_id" value="<?php echo $info["id"];?>" />
                    </td>
                </tr>                         
            </table>
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

    </div>


