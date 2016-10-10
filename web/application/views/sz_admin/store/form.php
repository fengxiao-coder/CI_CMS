<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>

<div  >
    <?php get_messagebox(); // 获取提示框 ?>
    <div class="box box-radius">
        <form method="post">
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               

                <tr>
                    <td width="10%" class="tdbg"><label for="password">店铺名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="sName" class="m_inpt_border" placeholder="店铺名称"  value="<?php echo isset($store_data['sName']) ? $store_data['sName'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">省份</label></td>
                    <td width="84%" colspan="3">
                        <select id="province" name="province" class="m_inpt_border" >
                            <option value="">请选择</option>
                            <?php foreach ($pro_arr as $v) { ?>
                                <option value="<?php echo $v['id']; ?>" <?php
                                if ($v['id'] == $store_data['province']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $v['province_name'] ?></option>
                                    <?php } ?>
                        </select>
                        <span class="span">*</span>
                    </td>
                </tr>

                <tr>
                    <td width="10%" class="tdbg"><label for="password">城市</label></td>
                    <td width="84%" colspan="3">
                        <select id="city" name="city" class="m_inpt_border" >
                            <option value="">请选择</option>      
                            <?php
                            $sql = "select * from user_city where pid={$store_data['province']}";
                            $result = mysql_query($sql);
                            while ($rs = mysql_fetch_assoc($result)) {
                                ?> 
                                <option value="<?php echo $rs["id"] ?>" <?php
                                if ($rs['id'] == $store_data['city']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $rs["city_name"] ?></option>
                                    <?php } ?>
                        </select>  
                        <span class="span">*</span>
                    </td>
                </tr>

                <tr>
                    <td width="10%" class="tdbg"><label for="password">区域</label></td>
                    <td width="84%" colspan="3" >
                        <select id="area" name="area" class="m_inpt_border" >
                            <option id="" value="">请选择</option> 
                            <?php
                            $sql = "select * from user_area where pid={$store_data['city']}";
                            $result = mysql_query($sql);
                            echo $sql;
                            while ($rs = mysql_fetch_assoc($result)) {
                                ?>
                                <option value="<?php echo $rs["id"] ?>" <?php
                                if ($rs['id'] == $store_data['area']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $rs["area_name"] ?></option>   
                                    <?php } ?>     
                        </select>  

                    </td>
                </tr>

                <tr>
                    <td width="10%" class="tdbg"><label for="password">店铺地址</label></td>
                    <td width="84%">
                        <textarea name="sAddr" placeholder="店铺地址"  class="m_inpt_border"><?php echo isset($store_data['sAddr']) ? $store_data['sAddr'] : ''; ?></textarea>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">联系电话</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="sPhone" id="sPhone" placeholder="xxx-xxxxxxx"  class="m_inpt_border" value="<?php echo isset($store_data['sPhone']) ? $store_data['sPhone'] : ''; ?>">
                        <span class="span">*</span>
                    </td>
                </tr>                           
                <tr>
                    <td width="10%"class="tdbg"><label>联系人</label></td>
                    <td width="84%">
                        <input name="sUser" type="text" placeholder="联系人"  class="m_inpt_border" value="<?php echo isset($store_data['sUser']) ? $store_data['sUser'] : ''; ?>" >
                        <span class="span">*</span>
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
<script type="text/javascript">

    $("input[name=sPhone]").blur(function () {
        var phone = $("input[name=sPhone]").val();
        var isMob = /^1[3-5,8]{1}[0-9]{9}$/;
        var isTel = /^0\d{2,3}-?\d{7,8}$/;
        if (!isMob.test(phone) && !isTel.test(phone)) {
            alert('电话格式不正确!');
            $("input[name=sPhone]").val("");
        }
    });

    $(function () {
        $("#province").change(function () {
            $.ajax({
                type: "get",
                url: "<?php echo base_url($this->_site_path . '/delivery_order/getcity'); ?>?random=" + Math.random() + "&oneid=" + $(this).val(),
                dataType: "html",
                success: function (data) {
                    $("#city").html(data);
                }
            });
        });

        $("#city").change(function () {
            $.ajax({
                type: "get",
                url: "<?php echo base_url($this->_site_path . '/delivery_order/getarea'); ?>?random=" + Math.random() + "&cityid=" + $(this).val(),
                dataType: "html",
                success: function (data) {
                    $("#area").html(data);
                }
            });
        });
    });

</script>

