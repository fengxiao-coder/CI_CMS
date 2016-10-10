<?php
$data['flag'] = 1;
$this->load->view_part($this->_site_path . "/main/breadcrumb", $data);
?>
<?php echo js("js/jquery.md5.js"); ?>
<!--  添加信息页面-->
<div  >
    <?php get_messagebox(); // 获取提示框  ?>
    <!--  添加-->
    <div class="box box-radius">
        <form method="post">
            <!-- 必填项-->
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">
                <?php $group_data = $this->admin_group_model->get_values('group_id', 'group_name'); ?>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">姓名</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="user_name" id="user_name" autoComplete="off" class="m_inpt_border" placeholder="姓名" value="<?php echo isset($admin_data['user_name']) ? $admin_data['user_name'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">密码</label></td>
                    <td width="84%" colspan="3">
                        <input name="password" type="text" id="showPwd" placeholder="密码" class="m_inpt_border" tabindex="2"value="" />
                        <input name="password" type="password" id="password" placeholder="密码" class="m_inpt_border" style="display: none;" value="" />
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">确认密码</label></td>
                    <td width="84%" colspan="3">
                        <input class="m_inpt_border" type="password" size="6" id="password2" placeholder="确认密码" name="password2" value="">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="real_name">真实姓名</label></td>
                    <td width="84%" colspan="3">
                        <input class="m_inpt_border" type="text" name="real_name" id="real_name" placeholder="真实姓名" value="<?php echo isset($admin_data['real_name']) ? $admin_data['real_name'] : ''; ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="real_name">所属店铺</label></td>
                    <td width="84%" colspan="3">
                        <select name="store_id" class="m_inpt_border" >
                            <option value="">--请选择类别--</option>
                            <?php foreach ($store_name as $k => $v) { ?>
                                <option value="<?php echo $v['id']; ?>" <?php echo $admin_data['store_id'] == $v['id'] ? "selected='selected'" : ""; ?>><?php echo $v['sName']; ?></option>
                            <?php } ?>
                        </select>   
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="email">E-mail</label></td>
                    <td width="84%" colspan="3">
                        <input class="m_inpt_border" type="email" id="email" placeholder="E-mail" name="email" value="<?php echo isset($admin_data['email']) ? $admin_data['email'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="email">权限组</label></td>
                    <td width="84%" colspan="3">
                        <?php
                        ?>
                        <?php foreach ($group_data as $key => $val) { ?>
                            <label style="float:left"><input type="checkbox"
                                <?php if (isset($admin_data['group_id']) && in_array($key, $admin_data['group_id'])) { ?>           
                                                                 checked="checked"
                                                             <?php } ?>
                                                             value="<?php echo $key; ?>" name="group_id[]"><?php echo $val; ?></label>
                            <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="sectionids">是否启用</label></td>
                    <td width="84%" colspan="3">
                        <select name="status" id="status" class="input-small m_inpt_border" >
                            <option value="1"
                            <?php if (isset($admin_data['status']) && $admin_data['status'] == '1') { ?>
                                        selected="true" <?php } ?>>是</option>
                            <option value="0"
                            <?php if (isset($admin_data['status']) && $admin_data['status'] == '0') { ?>
                                        selected="true" <?php } ?>>否</option>
                        </select>
                        <span class="span">*</span>
                    </td>
                </tr>
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
</div>

<script type="text/javascript">
    $("#showPwd").focus(function () {
        var text_value = $(this).val();
        if (text_value == this.defaultValue) {
            $("#showPwd").hide();
            $("#password").show().focus();
        }
    });
    $("#password").blur(function () {
        var text_value = $(this).val();
        if (text_value == "") {
            $("#showPwd").show();
            $("#password").hide();
        }
    });

    $("input[name=password2]").blur(function () {
        var password = $("#password").val();
        var password2 = $(this).val();
        if (password !== password2) {
            alert('密码错误！');
            $(this).val("");
        }
    });
    
    
    
    
    
</script>

<script>
    $("input[name=user_name]").blur(function () {
        $("input[name=password]").val("");
    });

    $("input[name=password2]").blur(function () {
        var password = $("#password").val();
        var password2 = $(this).val();
        if (password !== password2) {
            alert('密码错误！');
            $(this).val("");
        }
    });
</script>
