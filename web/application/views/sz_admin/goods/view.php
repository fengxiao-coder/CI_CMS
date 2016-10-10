<?php //$this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php 
$button = array("添加"=>array("c_model"=>'goods','url'=> base_url("sz_admin/goods/add")));
$this->common->show_title_breadcrumb("goods",$button);
?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">
        <tr>
            <td class="details_title" width="12%">商品名称</td>
            <td width="88%"colspan="3"><?php echo $goods_data['name']; ?></td>
        </tr> 
        <tr>
            <td width="12%" class="details_title">商品编号</td>
            <td width="38%"><?php echo $goods_data['goods_sn']; ?></td>
            <td width="12%" class="details_title">出入库详情</td>
            <td width="38%" >
                <a href="#"><span id="in" class="span123">入库详情</span></a> &nbsp; &nbsp;
                <a href="#"><span id="out" class="span123"> 出库详情</span></a>
            </td>
        </tr>
        <tr>
            <td width="12%" class="details_title">商品进价</td>
            <td width="38%"><?php
                if ($average_price != 0) {
                    echo $average_price;
                    echo $this->config_model->get_value_by_pk($goods_data['coin_unit'], 'value');
                } else {
                    echo "不详";
                }
                ?></td>
            <td width="12%" class="details_title">活动价</td>
            <td width="38%" > <?php echo $goods_data['activity_price']; ?> &nbsp;<?php echo $this->config_model->get_value_by_pk($goods_data['coin_unit'], 'value'); ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title">商品售价</td>
            <td width="38%" > <?php echo $goods_data['price']; ?> &nbsp;<?php echo $this->config_model->get_value_by_pk($goods_data['coin_unit'], 'value'); ?></td>
            <td class="details_title" width="12%">原价</td>
            <td width="38%"><?php echo $goods_data['original_price']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($goods_data['coin_unit'], 'value'); ?></td>
        </tr>
        <tr>
            <td class="details_title" width="12%">商品英文名</td>
            <td width="88%"colspan="3"><?php echo $goods_data['en_name']; ?></td>
        </tr> 
        <tr>
            <td class="details_title" width="12%">库存量</td>
            <td width="38%" ><?php echo $goods_data['num']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($goods_data['item_unit'], 'value'); ?></td>
            <td class="details_title" width="12%">商品产地</td>
            <td width="38%"><?php echo $goods_data['goods_origin']; ?></td>
        </tr>
        <tr>
            <td class="details_title" width="12%">商品标签名</td>
            <td width="38%"><?php echo $goods_data['tagname']; ?></td>
            <td width="12%" class="details_title">搜索关键字</td>
            <td width="38%" ><?php echo $goods_data['keyword']; ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title">商品品牌</td>
            <td width="38%"><?php echo $brand_name; ?></td>
            <td width="12%" class="details_title">所属类别</td>
            <td width="38%"><?php echo $goods_data['bread']; ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>二维码</strong></td>
            <td width="88%" colspan="3" ><?php $img = $this->common->set_core($goods_data['id']); ?>
                <img  src="<?php echo base_url("uploads/goods_core/" . $img); ?>">
            </td>
        </tr>
        <tr>
            <td  width="12%"class="details_title">商品图片</td>
            <td width="88%"  colspan="3"><img class="goods_view_img" src="<?php echo site_url($goods_data['photo']); ?>" /></td>
        </tr>
        <tr>
            <td width="12%" class="details_title">商品描述</td>
            <td width="88%"colspan="3"  class="Description"> 
                <p style="height:auto; min-height:150px; _height:150px;">&nbsp;<?php echo $goods_data['detail']; ?></p>
            </td>
        </tr>
        <tr>
            <td width="12%" class="details_title">创建时间</td>
            <td width="38%"> <?php echo init_date($goods_data['created']); ?> </td>
            <td width="12%" class="details_title">修改时间</td>
            <td width="38%"><?php echo init_date($goods_data['modified']); ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title">商品评价</td>
            <td width="88%" colspan="3">
                <?php
                if ($good_evaluation == 0 && $medium_evaluation == 0 && $bad_evaluation == 0) {
                    $str = "<div>暂无评价</div>";
                    echo $str;
                }
                ?>
                <?php
                if ($good_evaluation == 0 && $medium_evaluation == 0 && $bad_evaluation == 0) {
                    $str = "<div class='tab_item' style='display:none;'>";
                    echo $str;
                } else {
                    $str = "<div class='tab_item'>";
                    echo $str;
                }
                ?>
                <div class="app_count">
                    <span class="good">好评（<?php echo $good_evaluation; ?>）</span>
                    <span class="medium">中评（<?php echo $medium_evaluation; ?>）</span>
                    <span class="bad">差评（<?php echo $bad_evaluation; ?>）</span>
                </div>
<!--                       <iframe id="div_view" width="100%"></iframe>-->
                <div id="duoduo"></div><!--/*app-list*/-->
                <!-- 分页结束-->
                </div>
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
//出入库详情
    $(".span123").click(function () {
        var id = $(this).attr('id');
        var url = "";
        if (id == 'in') {
            url = "<?php echo base_url($this->_site_path . "/purchase/index/" . $goods_data['id']); ?>";
        } else {
            url = "<?php echo base_url($this->_site_path . "/shipment/index/" . $goods_data['id']); ?>";
        }
        $.fancybox({
            'hideOnOverlayClick': false,
            'hideOnContentClick': false,
            'enableEscapeButton': false,
            'href': url,
            'type': 'iframe',
            'width': '400',
            'height': '500'
        });
    });
//好评
    $(".good").click(function () {
        $(".good").siblings().removeClass("old");
        $(".good").addClass("old");
        $.ajax({
            type: 'get', //可选get
            url: '<?php echo base_url("sz_admin/goods/evaluation"); ?>', //这里是接收数据的程序
            data: "goods_id=" +<?php echo $goods_data['id']; ?> + "&evaluation=0",
            dataType: 'html', //服务器返回的数据类型 可选XML ,Json jsonp script html text等
            success: function (msg) {
                $("#duoduo").html(msg);
            },
            error: function () {
                alert('对不起失败了');
            }
        });
    });
//中评
    $(".medium").click(function () {
        $(this).siblings().removeClass("old");
        $(this).addClass("old");
        $.ajax({
            type: 'get',
            url: '<?php echo base_url("sz_admin/goods/evaluation"); ?>',
            data: "goods_id=" +<?php echo $goods_data['id']; ?> + "&evaluation=1",
            dataType: 'html',
            success: function (msg) {
                $("#duoduo").html(msg);
            },
            error: function () {
                alert('对不起失败了');
            }
        });
    });
//差评
    $(".bad").click(function () {
        $(this).siblings().removeClass("old");
        $(this).addClass("old");
        $.ajax({
            type: 'get',
            url: '<?php echo base_url("sz_admin/goods/evaluation"); ?>',
            data: "goods_id=" +<?php echo $goods_data['id']; ?> + "&evaluation=2",
            dataType: 'html',
            success: function (msg) {
                $("#duoduo").html(msg);
            },
            error: function () {
                alert('对不起失败了');
            }
        });
    });
</script>

