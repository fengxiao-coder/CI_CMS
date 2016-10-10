<?php
$data['flag'] = 1;
$this->load->view_part($this->_site_path . "/main/breadcrumb", $data);
?>
<?php echo js("js/kindeditor/kindeditor.js"); ?>
<?php echo js("js/kindeditor/lang/zh_CN.js"); ?>

<script type="text/javascript">
    KindEditor.ready(function (K) {
        window.editor = K.create('#editor_id');
    });
    $(function () {
        var type_id = $("select[name=pid]").val();
        var goods_id = "<?php echo $goods_data['id']; ?>";
        var url = "<?php echo base_url('sz_admin/goods/select_attr'); ?>";
        $.post(url, {type_id: type_id, goods_id: goods_id}, function (str) {
            $("#duoduo").html(str);
        });
    });
</script>

<!--  添加信息页面-->
<div  >
    <?php get_messagebox(); // 获取提示框    ?>
    <!--  添加-->
    <div class="box box-radius">
        <form method="post" enctype="multipart/form-data" id="form" name="form">
            <!-- 必填项-->
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">               
                <tr>
                    <td width="10%" class="tdbg"><label for="password">商品名称</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="name" id="name" class="m_inpt_border" placeholder="名称" value="<?php echo isset($goods_data['name']) ? $goods_data['name'] : $this->input->post('name'); ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">标签名</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="tagname" id="name" class="m_inpt_border" placeholder="标签名" value="<?php echo isset($goods_data['tagname']) ? $goods_data['tagname'] : $this->input->post('tagname'); ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">英文名</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="en_name" id="name" class="m_inpt_border" placeholder="英文名" value="<?php echo isset($goods_data['en_name']) ? $goods_data['en_name'] : $this->input->post('en_name'); ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="keyword">搜索关键字</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="keyword" id="keyword" class="m_inpt_border" placeholder="搜索关键字" value="<?php echo isset($goods_data['keyword']) ? $goods_data['keyword'] : $this->input->post('keyword'); ?>">
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="goods_origin">商品产地</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="goods_origin" id="goods_origin" class="m_inpt_border" placeholder="商品编码" value="<?php echo isset($goods_data['goods_origin']) ? $goods_data['goods_origin'] : $this->input->post('goods_origin'); ?>">
                    </td>
                </tr> 
                <tr>
                    <td width="10%" class="tdbg"><label for="goods_sn">商品编码</label></td>
                    <td width="84%" colspan="3">
                        <input type="text" name="goods_sn" id="goods_sn" class="m_inpt_border" placeholder="商品编码" value="<?php echo isset($goods_data['goods_sn']) ? $goods_data['goods_sn'] : $this->input->post('goods_sn'); ?>">
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="cat_name">商品类别</label></td>
                    <td width="84%" colspan="3">
                        <select name="pid" onChange="ajax_select_category()" class="m_inpt_border">
                            <option value=''>---请选择---</option>
                            <?php foreach ($goods_category_data as $v): ?>
                                <option value='<?php echo $v['cat_id']; ?>' <?php if (isset($goods_data['pid']) && $goods_data['pid'] == $v['cat_id']): ?>selected='selected'<?php endif; ?>><?php echo $v['cat_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr id="attrbution" class="active">
                    <td width="10%" class="tdbg" style="height:90px;"><label>属性</label></td>
                    <td width="84%" colspan="3"  class="item_class" id="duoduo">
                    </td>
                </tr>
                <tr>
                    <td width="10%"class="tdbg"><label>商品品牌</label></td>
                    <td width="84%">
                        <select name="brand_id"class="m_inpt_border" id="brand_id" >
                            <option value=''>---请选择---</option>
                            <?php
                            foreach ($brand_data as $k => $v) {
                                if ($this->brand_model->get_value_by_pk($v['brand_id'], 'brand_name')) {
                                    ?> <option value='<?php echo $v['brand_id']; ?>' <?php if (isset($goods_data['brand_id']) && $goods_data['brand_id'] == $v['brand_id']): ?>selected='selected'<?php endif; ?>><?php echo $this->brand_model->get_value_by_pk($v['brand_id'], 'brand_name'); ?></option> <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label>商品原价</label></td>
                    <td width="37%" colspan="3"><input name="original_price" type="text" class="x_inpt_border" value="<?php echo isset($goods_data['original_price']) ? $goods_data['original_price'] : $this->input->post('original_price'); ?>" > 
                        <?php echo form_dropdown('coin_unit', $this->config_model->get_values('id', 'value', array('key' => 'coin'), null), isset($goods_data['coin_unit']) ? $goods_data['coin_unit'] : '', ' '); ?>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label>商品售价</label></td>
                    <td width="37%" colspan="3"><input name="price" type="text" class="x_inpt_border" value="<?php echo isset($goods_data['price']) ? $goods_data['price'] : $this->input->post('price'); ?>" > 
                        <?php echo form_dropdown('coin_unit', $this->config_model->get_values('id', 'value', array('key' => 'coin'), null), isset($goods_data['coin_unit']) ? $goods_data['coin_unit'] : '', ' '); ?>
                        <span class="span">*</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="password">邮费</label></td>
                    <td width="37%" colspan="3"><input name="shipping_fee" type="text" class="x_inpt_border" value="<?php echo isset($goods_data['shipping_fee']) ? $goods_data['shipping_fee'] : $this->input->post('shipping_fee'); ?>" > 
                        <?php echo form_dropdown('coin_unit', $this->config_model->get_values('id', 'value', array('key' => 'coin'), null), isset($goods_data['coin_unit']) ? $goods_data['coin_unit'] : '', ' '); ?>
                        <span class="span">包邮请写0</span>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label>服务承诺</label></td>
                    <td width="84%" colspan="3">&nbsp;
                        <?php foreach ($this->goods_service_model->get_values('id', 'name') as $key => $val) { ?>
                            <label style="float:left">
                                &nbsp;<input type="checkbox" <?php if (isset($service[$key]) && $key == $service[$key]) { ?> checked="checked" <?php } ?> value="<?php echo $key; ?>" name="service[]"><?php echo $val; ?>
                            </label>
                        <?php } ?>
                    </td>
                </tr> 
                <tr>
                    <td width="10%" class="tdbg" style="height:90px;"><label>商品图片</label></td>
                    <td width="84%" colspan="3" >
                        <input name="photo[]" type="file" multiple="true" class="x_inpt_border" style="height:25px;" />
                        <span class="span">*</span>
                        <div class="images" style="<?php echo 'display:', isset($goods_photo) ? 'display;' : 'none;'; ?>">
                            <?php foreach ($goods_photo as $key => $single) { ?>
                                <img src="<?php echo site_url(isset($single) ? $single : ''); ?>"/>
                            <?php } ?>  
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label for="real_name">商品描述</label></td>
                    <td width="84%" colspan="3">
                        <textarea name="detail" id="editor_id" style="width:500px;height:300px;margin:5px;"><?php echo isset($goods_data['detail']) ? $goods_data['detail'] : $this->input->post('detail'); ?></textarea>
                    </td>
                </tr>
            </table>
            <!--选填项-->
            <div class="control_group btn_group">
                <label class="control_label" for="body"></label>
                <div class="controls">
                    <button type="submit" class="btn btn_style1" id="submit"><span>提交</span></button>
                    <button type="reset" class="btn btn_style1"><span>重置</span></button>
                </div>
            </div>
            <input type="hidden" name="is_submit" value="1">
        </form>  
        <div class="float_clear"></div>
    </div>     
</div>
<script type="text/javascript">
    //检验售价价格
    $("input[name=price]").blur(function () {
        var price = $("input[name=price]").val();
        var reg = /^[\d]+(\.[\d]+)?$/;
        if (!reg.test(price)) {
            alert('商品价格不合法，请重新输入！');
            $("input[name=price]").val("");
        }
    });
    //检验原价价格
    $("input[name=original_price]").blur(function () {
        var price = $("input[name=original_price]").val();
        var reg = /^[\d]+(\.[\d]+)?$/;
        if (!reg.test(price)) {
            alert('商品价格不合法，请重新输入！');
            $("input[name=original_price]").val("");
        }
    });
    //检验邮费价格
    $("input[name=shipping_fee]").blur(function () {
        var price = $("input[name=shipping_fee]").val();
        var reg = /^[\d]+(\.[\d]+)?$/;
        if (!reg.test(price)) {
            alert('商品价格不合法，请重新输入！');
            $("input[name=shipping_fee]").val("");
        }
    });
    //检验商品类型是否为第三级
    function ajax_select_category() {
        var url = "<?php echo base_url('sz_admin/goods/check_type') ?>";
        var id = $("select[name=pid]").val();
        if (id !== "")
        {
            $.post(url, {id: id}, function (res) {
                if (!(res.flag))
                {
                    alert("选项错误");
                    $("select[name=pid]").val("");
                }
            }, 'json');
        }
    }
    //根据商品类型获取对应的属性和品牌
    $("select[name=pid]").change(function () {
        var type_id = $("select[name=pid]").val();
        var goods_id = "<?php echo $goods_data['id']; ?>";
        var url = "<?php echo base_url('sz_admin/goods/select_attr'); ?>";
        $.post(url, {type_id: type_id, goods_id: goods_id}, function (str) {
            $("#duoduo").html(str);
        });
        ajax_select_brand();
    });
//    $("select[name=brand_id]").click(function () {
//        ajax_select_brand();
//    });
    //获取品牌
    function ajax_select_brand() {
        var type_id = $("select[name=pid]").val();
        var goods_id = "<?php echo $goods_data['id']; ?>";
        var url = "<?php echo base_url('sz_admin/goods/select_brand'); ?>";
        $.post(url, {type_id: type_id, goods_id: goods_id}, function (str) {
            $("#brand_id").html(str);
        });
    }

    $("#submit").click(function () {
        //parent.$.fancybox.close();
        $.ajax({
            cache: true,
            type: "POST",
            url: "<?php echo base_url('sz_admin/goods/add'); ?>",
            data: $('#form').serialize(),
            async: false,
            error: function (request) {
                alert("添加成功");
                parent.$.fancybox.close();
            },
            success: function (data) {
                alert("添加失败");
            }
        });
    });
</script>


