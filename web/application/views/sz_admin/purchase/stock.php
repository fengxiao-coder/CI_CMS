<?php
$data['flag'] = 1;
$this->load->view_part($this->_site_path . "/purchase/breadcrumb", $data);
?>
<div>
    <?php get_messagebox(); // 获取提示框 ?>
    <div class="box box-radius">
        <form method="post" name="form" id="form" >
            <table border="0" cellspacing="0" cellpadding="0" class="addinfo_table">
                <tr>
                    <td width="10%" class="tdbg"><label>入库人</label></td>
                    <td width="37%">
                        <input type="text" disabled="true" class="x_inpt_border"  value="<?php echo $this->auth->get_user('user_name'); ?>">
                    </td>
                    <td width="10%"class="tdbg"><label>入库时间</label></td>
                    <td width="37%">
                        <input type="text" name="ru_time[]" class="x_inpt_border" onfocus="WdatePicker({skin: 'whyGreen', maxDate: '%y-%M-%d'})" value="<?php echo date('Y-m-d') ?>" />
                    </td>
                </tr>
                <tr>
                    <td width="10%" class="tdbg"><label>入库商品</label></td>
                    <td width="84%" colspan="3">
                        <table id="tb" class="table table-striped table-condensed table-bordered" style="margin: 5px;">
                            <thead>
                                <tr class="table-thbg">
                                    <th>名称</th>
                                    <th>采购量</th>
                                    <th>入库数量</th>
                                    <th>采购人</th>
                                    <th>采购价</th>
                                    <th>备注</th>
                                </tr>
                            </thead
                            ><?php foreach ($purchase_data as $k => $single) { ?>
                                <!--  鼠标悬停，整行变色，-->
                                <tr>
                                <input type="hidden" name="ru_person[]" class="x_inpt_border"  value="<?php echo $this->auth->get_user('admin_id'); ?>">
                                <input name="id[]"  value="<?php echo $single['id']; ?>" type="hidden"/>
                                <td  class="align_left" style="cursor:pointer;cursor:hand"><?php echo $single['goods_name']; ?></td>
                                <td  class="align_left" ><?php echo $single['amount']; ?></td>
                                <td style="cursor:pointer;cursor:hand"><input style="width: 40px; " class="activity_price x_inpt_border" type="text" id="amount" name="amount[]" value="<?php echo $single['amount']; ?>"></td>
                                <td style="cursor:pointer;cursor:hand"><?php echo $single['person']; ?></td>
                                <td style="cursor:pointer;cursor:hand"><?php echo $single['price']; ?></td>
                                <td  class="align_left" style="cursor:pointer;cursor:hand"><input type="text" name="remark[]" value="" style="width:160px;" class="x_inpt_border"></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            </td>
            </tr>
            <tr>
                <td width="10%" style="border-right:none"><label></label></td>
                <td width="84%"colspan="3" >                
                    <div class="controls" style="margin:10px;">
                        <button type="submit" id="bt" class="btn btn_style1"><span>提交</span></button>
                    </div>
                </td>
            </tr>
            </table>
            <input type="hidden" name="is_submit" value="1">
        </form>  
        <div class="float_clear"></div>
    </div>  
</div>
<script type="text/javascript">
    //查询输入的数量
    $("#amount").blur(function () {
        var amount = $(this).val();
        var t = /^[1-9]\d*$/;
        if (!t.test(amount)) {
            alert('请输入数字！');
            $(this).val("1");
        }
        ;
    });

    $("#bt").click(function () {
        $('#form').attr('action', '<?php echo base_url($this->_site_path . "/purchase/ruku"); ?>');
        $('#form').submit();
        parent.$.fancybox.close();
        parent.window.location.href = parent.window.location.href;
 
    });
</script>