<?php
$data['flag'] = 1;
$this->load->view_part($this->_site_path . "/purchase/breadcrumb", $data);
?>
<div>
    <?php get_messagebox(); // 获取提示框    ?>
    <div class="box box-radius">
        <form method="post" name="form" onSubmit="return beforeSubmit(this);">
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">
                <tr>
                    <td width="10%" class="tdbg"><label>商品类别</label></td>
                    <td width="37%">
                        <select name="cat_id" class="x_inpt_border">
                            <option value=''>---请选择---</option>
                            <?php foreach ($goods_category_data as $v): ?>
                                <option value='<?php echo $v['cat_id']; ?>' <?php if (isset($purchase_data['cat_id']) && $purchase_data['cat_id'] == $v['cat_id']): ?>selected='selected'<?php endif; ?>><?php echo $v['cat_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="span">*</span>
                    </td>
                    <td width="10%"class="tdbg"><label>商品品牌</label></td>
                    <td width="37%">
                        <select name="brand_id"class="x_inpt_border" id="brand_name">
                            <option value=''>---请选择---</option>
                            <?php foreach ($brand_data as $v): ?>
                                <option value='<?php echo $v['brand_id']; ?>' <?php if (isset($purchase_data['brand_id']) && $purchase_data['brand_id'] == $v['brand_id']): ?>selected='selected'<?php endif; ?>><?php echo $v['brand_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="10%"class="tdbg"><label>商品名称</label></td>
                    <td width="64%" colspan="3">
                        <input type="text" autoComplete="off" name="goods_name" id="goods_name" class="m_inpt_border" placeholder="商品名称" value="<?php echo isset($purchase_data['goods_id']) ? $this->goods_model->get_value_by_pk($purchase_data['goods_id'], 'name') : $this->input->post('goods_id'); ?>"><span class="span">*</span>
                        <input type="hidden" name="goods_id" id="goods_id" value="<?php echo isset($purchase_data['goods_id']) ? $purchase_data['goods_id'] : $this->input->post('goods_id'); ?>">
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
                    <td width="10%"class="tdbg"><label>供应商</label></td>
                    <td width="37%">  
                        <?php echo form_dropdown('supplier_id', $this->supplier_model->get_values('id', 'name'), isset($purchase_data['supplier_id']) ? $purchase_data['supplier_id'] : $this->input->post('supplier_id'), ' class="x_inpt_border" ', '--请选择--'); ?>
                        <span class="span">*</span>
                    </td>
                    <td width="10%" class="tdbg"><label>采购人</label></td>
                    <td width="37%">
                        <input type="text" name="person" id="person" class="x_inpt_border" placeholder="采购人" value="<?php echo isset($purchase_data['person']) ? $purchase_data['person'] : $this->input->post('person'); ?>">
                        <input type="hidden" name="buyer_id" id="buyer_id" class="x_inpt_border" placeholder="操作人" value="<?php echo $this->auth->get_user('admin_id'); ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%"class="tdbg"><label>采购数量</label></td>
                    <td width="37%">
                        <input type="text" name="amount" id="amount" class="x_inpt_border" placeholder="采购数量"  style="width:270px;" value="<?php echo isset($purchase_data['amount']) ? $purchase_data['amount'] : $this->input->post('amount'); ?>">
                        <?php echo form_dropdown('item_unit', $this->config_model->get_values('id', 'value', array('key' => 'item'), null), isset($purchase_data['item_unit']) ? $purchase_data['item_unit'] : '', ' '); ?>
                        <span class="span">*</span></td>
                    <td width="10%" class="tdbg"><label>采购价格</label></td>
                    <td width="37%">
                        <input name="price" type="text" class="x_inpt_border" placeholder="采购价格" style="width:270px;"  value="<?php echo isset($purchase_data['price']) ? $purchase_data['price'] : $this->input->post('price'); ?>" > 
                        <?php echo form_dropdown('coin_unit', $this->config_model->get_values('id', 'value', array('key' => 'coin'), null), isset($purchase_data['coin_unit']) ? $purchase_data['coin_unit'] : '', ' '); ?>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label>备注</label></td>
                    <td width="84%" colspan="3">
                        <textarea name="remark" id="remark" class="m_inpt_border" style="height:180px;margin:5px;"><?php echo isset($purchase_data['remark']) ? $purchase_data['remark'] : $this->input->post('remark'); ?></textarea>
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
//修改的时候部分置灰
    $(function () {
        var purchase = "<?php echo $purchase_data['id']; ?>";
        if (purchase) {
            $("select[name=cat_id]").attr("disabled", "disabled");
            $("select[name=brand_id]").attr("disabled", "disabled");
            $("input[name=goods_name]").attr("disabled", "disabled");
        }
        ajax_select_stock();
    });
//检测数量是否合法
    $("input[name=amount]").blur(function () {
        var amount = $("input[name=amount]").val();
        var reg = /^[1-9]\d*$/;
        if (!reg.test(amount)) {
            alert('数量不合法，请重新输入！');
            $("input[name=amount]").val("");
        }
    });
//检测价格是否合法
    $("input[name=price]").blur(function () {
        var price = $("input[name=price]").val();
        var reg = /^(0|[1-9][0-9]{0,9})(\.[0-9]{1,2})?$/;
        if (!reg.test(price)) {
            alert('价格不合法，请重新输入！');
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
        //ajax_select_goods();
    });
    
//输入商品名称的时候商品值  制空
    $("#goods_name").blur(function () {
        if ($("#goods_name").val()) {
            ajax_select_goods();
        } else {
            $("input[name=goods_id]").val("");
        }

    });
    
//输入完成 查询对应的商品
    $("#goods_name").keyup(function () {
        if ($("#goods_name").val()) {
            ajax_select_goods();
        }
        $("input[name=goods_id]").val("");
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
            else if (obj > 30)
            {
                $("select[name=select_id]").attr("size", "30");
            }
            else
            {
                $("select[name=select_id]").attr("size", obj);
            }
        });
        //ajax_select_stock();
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
                        $("select[name=brand_id]").val(data['brand_id']);
                    }
                }
            }
            , 'html');
        } else {
            $("#kucun").html("暂无库存");
        }
    }

    function beforeSubmit(form) {
        if (form.goods_id.value == '') {
            alert('用户名不能为空！');
            form.username.focus();
            return false;
        }
        if (form.supplier_id.value == '') {
            alert('供货商不能为空！');
            form.supplier_id.focus();
            return false;
        }
        if (form.person.value == '') {
            alert('采购人不能为空！');
            form.person.focus();
            return false;
        }
        if (form.amount.value == '') {
            alert('采购数量不能为空！');
            form.amount.focus();
            return false;
        }
        if (form.price.value == '') {
            alert('采购价格不能为空！');
            form.price.focus();
            return false;
        }
        return true;
    }
</script>
