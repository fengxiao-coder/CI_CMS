<?php
$data['flag'] = 1;
$this->load->view_part($this->_site_path . "/main/breadcrumb", $data);
?>
<div>
    <?php get_messagebox(); // 获取提示框    ?>
    <div class="box box-radius">
<!--        <form method="post" name="form" onSubmit="return beforeSubmit(this);">-->
       <form method="post" name="form">
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">
                <tr>
                    <td width="10%" class="tdbg"><label>商品类别</label></td>
                    <td width="37%">
                        <select name="cat_id" class="x_inpt_border">
                            <option value=''>---请选择---</option>
                            <?php foreach ($goods_category_data as $v): ?>
                                <option value='<?php echo $v['cat_id']; ?>' <?php if (isset($shipment_data['cat_id']) && $shipment_data['cat_id'] == $v['cat_id']): ?>selected='selected'<?php endif; ?>><?php echo $v['cat_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="span">*</span>
                    </td>
                    <td width="10%"class="tdbg"><label>商品品牌</label></td>
                    <td width="37%">
                        <select name="brand_id"class="x_inpt_border" id="brand_name">
                            <option value=''>---请选择---</option>
                            <?php foreach ($brand_data as $v): ?>
                                <option value='<?php echo $v['brand_id']; ?>' <?php if (isset($shipment_data['brand_id']) && $shipment_data['brand_id'] == $v['brand_id']): ?>selected='selected'<?php endif; ?>><?php echo $v['brand_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="10%"class="tdbg"><label>商品名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" autoComplete="off" name="goods_name" id="goods_name" class="m_inpt_border" placeholder="商品名称" value="<?php echo isset($shipment_data['goods_id']) ? $this->goods_model->get_value_by_pk($shipment_data['goods_id'], 'name') : $this->input->post('goods_id'); ?>"><span class="span">*</span>
                        <input type="hidden" name="goods_id" id="goods_id" value="<?php echo isset($shipment_data['goods_id']) ? $shipment_data['goods_id'] : $this->input->post('goods_id'); ?>">
                        <div style="position: absolute; float: left;display:none" id="goods_name_select">
                            <ul>
                                <select class='m_inpt_border' style='height:auto' id="goodes" name='select_id' size='3' multiple='multiple'>

                                </select>
                            </ul>
                        </div>                        
                        <span id="ku">库存<label id="stock"></label></span>
                    </td>
                </tr>
                <tr>
                    <td width="10%"class="tdbg"><label>出库数量</label></td>
                    <td width="37%">
                        <input type="text" name="amount" id="amount" class="x_inpt_border" placeholder="入库数量" value="<?php echo isset($shipment_data['amount']) ? $shipment_data['amount'] : $this->input->post('amount'); ?>">
                        <?php echo form_dropdown('item_unit', $this->config_model->get_values('id', 'value', array('key' => 'item'), null), isset($shipment_data['item_unit']) ? $shipment_data['item_unit'] : '', ' '); ?>
                        <span class="span">*</span></td>

                    <td width="10%" class="tdbg"><label>出库人</label></td>
                    <td width="37%">
                        <input type="text" name="person" id="person" class="x_inpt_border" placeholder="出货人" value="<?php echo isset($shipment_data['person']) ? $shipment_data['person'] : $this->input->post('person'); ?>">
                        <input type="hidden" name="oper_id" id="oper_id" class="x_inpt_border" placeholder="操作人" value="<?php echo $this->auth->get_user('admin_id'); ?>">
                        <span class="span">*</span>
                    </td>
                </tr>

                <tr>
                    <td width="10%" class="tdbg"><label>备注</label></td>
                    <td width="84%" colspan="3">
                        <textarea name="remark" id="remark" class="m_inpt_border" style="height:180px;margin:5px;"><?php echo isset($shipment_data['remark']) ? $shipment_data['remark'] : $this->input->post('remark'); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td width="10%" style="border-right:none"><label></label></td>
                    <td width="84%"colspan="3" >                
                        <div class="controls" style="margin:10px;">
                            <button type="submit" class="btn btn_style1"><span>提交</span></button>
                            <button type="reset" class="btn btn_style1"><span>重置</span></button>
                        </div></td>
                </tr>
            </table>
            <input type="hidden" name="is_submit" value="1">
        </form>  
        <div class="float_clear"></div>
    </div>  
</div>
<script type="text/javascript">
    
    $(function () {
        ajax_select_stock();
    });

//检测价格是否合法
    $("input[name=price]").blur(function () {
        var price = $("input[name=price]").val();
        var reg = /^(0|[1-9][0-9]{0,9})(\.[0-9]{1,2})?$/;
        if (!reg.test(price)) {
            alert('产品价格不合法，请重新输入！');
            $("input[name=price]").val("");
        }
    });
    
//检测商品分类
    $("select[name=cat_id]").change(function () {
        var url = "<?php echo base_url('sz_admin/goods/check_type') ?>";
        var id = $("select[name=cat_id]").val();
        if (id !== "")
        {
            $.post(url, {id: id}, function (res) {
                if (!(res.flag))
                {
                    alert("选项错误");
                    $("select[name=cat_id]").val("");
                }
            }, 'json');
        }
        ;
        var href = "<?php echo base_url('sz_admin/goods/select_brand'); ?>";
        $.post(href, {type_id: id}, function (str) {
            $("#brand_name").html(str);
        });
        $("input[name=goods_name]").val("");
        //ajax_select_goods();
    });
    
//选择品牌的时候  商品名称制空
    $("select[name=brand_id]").change(function () {
        $("input[name=goods_name]").val("");
        // ajax_select_goods();
    });
    
//输入商品名称的时候商品值  制空
    $("#goods_name").blur(function () {
        ajax_select_goods();
        $("input[name=goods_id]").val("");
    });
    
//输入完成 查询对应的商品
    $("#goods_name").keyup(function () {
        ajax_select_goods();
    });
    
//查询商品
    function ajax_select_goods() {
        var pid = $("select[name=cat_id]").val();
        if ($("select[name=brand_id]").val()) {
            var brand_id = $("select[name=brand_id]").val();
        } else {
            brand_id = "";
        }
        var name_like = $("#goods_name").val();
        var url = "<?php echo base_url('sz_admin/purchase/search_goods'); ?>";
        $.post(url, {pid: pid, brand_id: brand_id, name_like: name_like}, function (str) {
            $("select[name=select_id]").html(str);
            var obj = $("#goodes option").length;
            if (obj === 0)
            {
                $("select[name=select_id]").attr("size", "1");
                $("#goodes").append("<option value=''>查无此产品!!</option>");  //添加一项option
            }
            else if (obj > 5)
            {
                $("select[name=select_id]").attr("size", "5");
            }
            else
            {
                $("select[name=select_id]").attr("size", obj);
            }
        });
        $("#goods_name_select").css('display', 'block');
    }
    
//选中已经查出的商品
    $("select[name=select_id]").change(function () {
        var goods_id = $(this).val();
        var url = "<?php echo base_url('sz_admin/purchase/select_goods'); ?>";
        $.post(url, {goods_id: goods_id}, function (str) {
            $("input[name=goods_name]").val(str);
        });
        $("input[name=amount]").val("");
        $("input[name=goods_id]").val($(this).val());
        $("#goods_name_select").css('display', 'none');
        ajax_select_stock();
    });
    
//查询库存 
    function ajax_select_stock() {
        var id = $("input[name=goods_id]").val();
        if (id) {
            var href = "<?php echo base_url('sz_admin/shipment/get_goods_data'); ?>";
            $.post(href, {goods_id: id}, function (response) {
                if (response) {
                    var data = eval('(' + response + ')');
                    if (data['num']) {
                        $("#stock").html(data['num']);
                    }
                    if (data['pid']) {
                        $("select[name=cat_id]").val(data['pid']);
                    }
                    if (data['brand_id']) {
                        ;
                        $("select[name=brand_id]").val(data['brand_id']);
                    }
                }
            }, 'html');
        } else {
            $("#kucun").html("暂无库存");
        }
    }
    
//查询输入的数量
    $("input[name=amount]").blur(function () {
        var amount = $("input[name=amount]").val();
        var reg = $("#stock").text();
        var t = /^[1-9]\d*$/;
        if (!t.test(amount)) {
            alert('请输入数字！');
            $("input[name=amount]").val("");
        } else {
            if (eval(amount) > eval(reg)) {
                alert('库存不足，请重新输入！');
                $("input[name=amount]").val("");
            }
        }
    });

//    function beforeSubmit(form) {
//        if (form.goods_id.value == '') {
//            alert('用户名不能为空！');
//            form.username.focus();
//            return false;
//        }
//        if (form.amount.value == '') {
//            alert('出库数量不能为空！');
//            form.amount.focus();
//            return false;
//        }
//        if (form.person.value == '') {
//            alert('出库人不能为空！');
//            form.person.focus();
//            return false;
//        }
//        return true;
//    }
</script>


