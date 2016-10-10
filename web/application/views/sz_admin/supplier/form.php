<?php $data['flag'] = 1;
$this->load->view_part($this->_site_path . "/main/breadcrumb", $data);
?>
<script>
    KindEditor.ready(function (K) {
        window.editor = K.create('#editor_id');
    });
</script>
<div class="box box-radius">
<?php get_messagebox(); // 获取提示框   ?>
    <form method="post">
        <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">  
<?php foreach ($this->$modelname->form_array as $k => $v): ?>

                <tr>
                    <td width="10%" class="tdbg"><label for="<?php echo $k ?>"><?php echo $v ?></label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="<?php echo $k ?>" id="<?php echo $k ?>" class="m_inpt_border" placeholder="" value="<?php echo isset($supplier_data[$k]) ? $supplier_data[$k] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
<?php endforeach; ?>
        </table>
        <div class="control_group btn_group">
            <label class="control_label" for="body"></label>
            <div class="controls">
                <button type="submit" class="btn btn_style1"><span>提交</span></button>
                <button type="reset" class="btn btn_style1"><span>重置</span></button>
            </div>
        </div>
        <input type="hidden" name="is_submit" value="1">
    </form>
</div>

<script type="text/javascript">

    $("input[name=email]").blur(function () {
        var email = $(this).val();
        var isemail = /^[0-9a-zA-Z_]{1,}@[0-9a-zA-Z_]{1,}\.(com|cn|org)$/;
        if (!isemail.test(email)) {
            alert('邮箱格式不正确!');
            $(this).val("");
        }
    });

    $("input[name=phone]").blur(function () {
        var phone = $(this).val();
        var isMob = /^1[3-5,8]{1}[0-9]{9}$/;
        var isTel = /^0\d{2,3}-?\d{7,8}$/;
        if (!isMob.test(phone) && !isTel.test(phone)) {
            alert('电话格式不正确!');
            $(this).val("");
        }
    });

    $("input[name=person_tp]").blur(function () {
        var phone = $(this).val();
        var isMob = /^1[3-5,8]{1}[0-9]{9}$/;
        var isTel = /^0\d{2,3}-?\d{7,8}$/;
        if (!isMob.test(phone) && !isTel.test(phone)) {
            alert('电话格式不正确!');
            $(this).val("");
        }
    });



</script>
