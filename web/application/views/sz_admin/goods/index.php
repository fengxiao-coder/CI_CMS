<?php $this->load->view_part($this->_site_path . "/goods/breadcrumb"); ?>
<?php $this->load->view_part($this->_site_path . "/goods/search") ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme/default/css/print.css'); ?>" media="print"/>
<div class="list_box">
    <div class="ucenter_tab_box">
        <ul id="tag" class="u_tab clearfix">
            <li <?php if ('up' == $current_type) { ?> class="current"<?php } ?> >
                <a href="<?php echo base_url($this->_site_path . '/goods/index/up'); ?>">已上架</a>
            </li>
            <li <?php if ('down' == $current_type) { ?> class="current"<?php } ?> >
                <a href="<?php echo base_url($this->_site_path . '/goods/index/down'); ?>">已下架</a>
            </li>
            <li <?php if ('hot' == $current_type) { ?> class="current"<?php } ?> >
                <a href="<?php echo base_url($this->_site_path . '/goods/index/hot'); ?>">热卖</a>
            </li>
            <li <?php if ('special' == $current_type) { ?> class="current"<?php } ?> >
                <a href="<?php echo base_url($this->_site_path . '/goods/index/special'); ?>">特价</a>
            </li>
            <li <?php if ('remind' == $current_type) { ?> class="current"<?php } ?> >
                <a href="<?php echo base_url($this->_site_path . '/goods/index/remind'); ?>">告急</a>
            </li>
            <?php if(!$this->auth->get_user('store_id')){?>
            <li <?php if ('get' == $current_type) { ?> class="current"<?php } ?> >
                <a href="<?php echo base_url($this->_site_path . '/goods/index/get'); ?>">已采购</a>
            </li>
            <?php }?>
        </ul>                
    </div>
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
            <?php if ($goods_data) { ?>
                <form method="post" action="<?php echo base_url($this->_site_path . "/goods/deleted"); ?>" id="form">
                    <table id="tb" class="table table-striped table-condensed table-bordered">
                        <thead>
                            <tr class="table-thbg">
                                <th class="selection_box">
                                    <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                                </th>
                                <th>名称</th>
                                <?php if ('hot' == $current_type) { ?> <th>销量</th><?php } ?>
                                <?php if ('special' == $current_type) { ?> <th>活动价</th><?php } ?>
                                <th>原价</th>
                                <th>品牌</th>
                                <th>库存</th>
                                <th>评价</th>
                                <th>状态</th>
                                <?php if(!$this->auth->get_user('store_id')){ ?>
                                <th>操作</th>
                                <?php }?>
                            </tr>
                        </thead>
                        <?php foreach ($goods_data as $k => $single) { ?>
                            <!--  鼠标悬停，整行变色，-->
                            <tr>
                                <td>
                                    <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox"  tagname="<?php echo $single['tagname']; ?>" en_name="<?php echo $single['en_name']; ?>" goods_sn="<?php echo $single['goods_sn']; ?>" codeContent="<?php echo base_url($this->_site_path . "/goods/view/{$single['id']}"); ?>"/>
                                </td>
                                <td  class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods/view/{$single['id']}"); ?>';"><?php echo $single['name']; ?></td>
                                <?php if ('hot' == $current_type) { ?><td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods/view/{$single['id']}"); ?>';"><?php echo $single['sales']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($single['item_unit'], 'value'); ?></td><?php } ?>
                                <?php if ('special' == $current_type) { ?><td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods/view/{$single['id']}"); ?>';"><?php echo $single['activity_price']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($single['coin_unit'], 'value'); ?></td><?php } ?>
                                <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods/view/{$single['id']}"); ?>';"><?php echo $single['price']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($single['coin_unit'], 'value'); ?></td>
                                <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods/view/{$single['id']}"); ?>';">
                                    <?php echo $this->brand_model->get_value_by_pk($single['brand_id'], 'brand_name'); ?> 
                                </td>
                                <td  class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods/view/{$single['id']}"); ?>';"><?php echo $single['num']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($single['item_unit'], 'value'); ?></td>
                                <td  class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods/view/{$single['id']}"); ?>';">
                                    <?php
                                    echo $this->goods_evaluation_model->total(array('goods_id' => $single['id']), NULL, NULL);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($single['is_special'] == 1) {
                                        echo '特价';
                                    }
                                    ?>
                                </td>
                                <?php if(!$this->auth->get_user('store_id')){ ?>
                                <td>
                                    <a href="<?php echo base_url($this->_site_path . "/purchase/add/{$single['id']}"); ?>">采购</a>                                    
                                    <a href="<?php echo base_url($this->_site_path . "/goods/edit/{$single['id']}"); ?>">修改</a>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div id="test"></div>
                    <div class="tips">
                        <div class="float_left">
                        	<?php if ('up' == $current_type) { ?><a class="printf btn_style1" style="line-height: 25px;" href='javascript:void(0);'title="打印产品二维码" id="printf">打&nbsp;印</a><?php } ?>
                           
                        	<?php if (!$this->auth->get_user('store_id')){ ?>
                        		<?php if ('special' == $current_type) { ?> <input type="button" value="取消特价" id="cancel_special" class="cencle btn_style1"><?php } ?>	                           
	                            <?php if ('down' == $current_type) { ?><input type="submit" value="删除" class="btn btn_style1" onclick="return confirmDelete()"><?php } ?>
	                            <?php if ('up' == $current_type || 'hot' == $current_type) { ?> <input type="button" value="特价" id="special" class="cencle btn_style1"> <input type="button" value="下架" id="down" class="cencle btn_style1"><?php } ?>
	                            <?php if ('down' == $current_type) { ?> <input type="button" value="上架" id="up" class="cencle btn_style1"><?php } ?>
                        	<?php }?>                         
                            
                        </div>
                        <?php echo $pagination; ?>
                    </div>
                    <input type="hidden" name="is_submit" value="1">
                </form>
            <?php } else { ?>
                <form method="post" action="<?php echo base_url($this->_site_path . "/purchase/delete_all"); ?>" id="form1" >
                    <table class="table table-striped table-condensed table-bordered">
                        <thead>
                            <tr class="table-thbg">
                                <th class="selection_box">
                                    <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                                </th>
                                <th>商品名称</th>
                                <th>商品类别</th>
                                <th>供应商</th>
                                <th>采购量</th>
                                <th>采购价</th>
                                <th>采购人</th>
                                <th>采购时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($purchase as $single) { ?>
                                <tr>
                                    <td>
                                        <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" codeContent="<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>"/>
                                    </td>
                                    <td class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                        <?php echo $single['goods_name']; ?>
                                    </td>
                                    <td  class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                        <?php echo $this->goods_category_model->get_value_by_pk($single['cat_id'], 'cat_name'); ?>
                                    </td>
                                    <td  class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                        <?php echo $this->supplier_model->get_value_by_pk($single['supplier_id'], 'name'); ?>
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                        <?php echo $single['amount']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($single['item_unit'], 'value'); ?>
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                        <?php echo $single['price']; ?>&nbsp;<?php echo $this->config_model->get_value_by_pk($single['coin_unit'], 'value'); ?>
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                        <?php echo $single['person']; ?>
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/purchase/view/{$single['id']}"); ?>';">
                                        <?php echo date("Y-m-d", $single['created_time']); ?>
                                    </td>
                                    <td>
<!--                                        <?php if ($single['status'] == 1) echo '已入库' ?>
                                        <a <?php if ($single['status'] == 1) echo 'style="display:none"' ?> href="<?php echo base_url($this->_site_path . "/purchase/stock/{$single['id']}"); ?>" onclick="return confirm('确定入库 ?')" >入库</a>-->
                                        <a <?php if ($single['status'] == 1) echo 'style="display:none"' ?> href="<?php echo base_url($this->_site_path . "/purchase/edit/{$single['id']}"); ?>">修改</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- 表格底部帮助栏-->
                    <div class="tips">
                        <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
                        <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
                        <?php if ('get' == $current_type) { ?> <input type="button" value="入库" id="get_out" class="cencle btn_style1"><?php } ?>
                        <!-- 分页开始-->
                        <?php echo $pagination; ?>
                        <!-- 分页结束-->
                    </div>

                </form>
            <?php } ?>
        </div>
        <div style="display:none">    
            <div id="dv" class="Specimen">
                <h1>请输入打印份数</h1>
                <input  class="m_inpt_border" name="div" id="num" type="text" value="1"/>
                <br />
                <input class="btn_s  btn_info" type="button" value="确定" id="bt"/>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $(".cencle").click(function () {
                    var href = "";
                    var id = $(this).attr('id');
                    if (id == 'down') {
                        href = '<?php echo base_url($this->_site_path . "/goods/down") ?>';
                    } else if (id == 'up') {
                        href = '<?php echo base_url($this->_site_path . "/goods/up") ?>';
                    } else if (id == 'cancel_special') {
                        href = '<?php echo base_url($this->_site_path . "/goods/cancel_special") ?>';
                    } else {
                        href = '<?php echo base_url($this->_site_path . "/goods/special") ?>';
                    }
                    if (id == 'get_out') {
                        var data = $('#form1').serialize();
                    } else {
                        var data = $('#form').serialize();
                    }
                    if ($("input[name='ids[]']:checked").size() === 0) {
                        alert("请选中商品！");
                        return false;
                    } else {
                        if (id == 'special') {
                            var data = $('#form').serialize();
                            //检验库存
                            $.ajax({
                                type: "post",
                                url: '<?php echo base_url($this->_site_path . "/goods/get_stock") ?>/?' + data,
                                data: data,
                                success: function (msg) {
                                    if (msg) {
                                        alert("库存为0不可以特价！");
                                    } else {
                                        special(data);
                                    }
                                }
                            });
                        } else if (id == 'get_out') {
                         var data = $('#form1').serialize();
                            $.fancybox({
                                'hideOnOverlayClick': false,
                                'hideOnContentClick': false,
                                'enableEscapeButton': false,
                                'href': '<?php echo base_url($this->_site_path . "/purchase/stock") ?>/?' + data,
                                'ajax': {
                                    type: "GET"
                                },
                                'type': 'iframe',
                                'width': '800',
                                'height': '1000'
                            });

                        } else if (id == 'up') {
                            var data = $('#form').serialize();
                            //检验库存
                            $.ajax({
                                type: "post",
                                url: '<?php echo base_url($this->_site_path . "/goods/get_stock") ?>/?' + data,
                                data: data,
                                success: function (msg) {
                                    if (msg) {
                                        alert("库存为0不可以上架！");
                                    } else {
                                        up(data);
                                    }
                                }
                            });
                        } else {
                            $.ajax({
                                cache: true,
                                type: "POST",
                                url: href,
                                data: data,
                                async: false,
                                error: function (request) {
                                    alert("您好，输入错误");
                                },
                                success: function (data) {
                                    window.location.href = window.location.href;
                                }
                            });
                        }
                    }
                });

                $("#bt").click(function () {
                    var num = $("#num").val();
                    var re = /^[1-9]\d{0,2}$/;
                    if (re.test(num)) {
                        target = "_blank";
                        $('#form').attr('target', '_blank');
                        $('#form').attr('action', '<?php echo base_url($this->_site_path . "/print_code/print_all") ?>/' + num);
                        $('#form').submit();
                        $.fancybox.close();
                    } else {
                        return false;
                    }

                });

                $("#printf").click(function () {
                    if ($("input[name='ids[]']:checked").size() === 0) {
                        alert("请选中要打印的商品！");
                        return false;
                    } else {
                        $.fancybox({
                            'type': 'inline',
                            'hideOnOverlayClick': false,
                            'hideOnContentClick': false,
                            'enableEscapeButton': false,
                            'autoDimensions': false,
                            'width': "100%",
                            'height': "100%",
                            'href': '#dv'
                        });
                    }
                });

                function special(data) {
                    $.fancybox({
                        'hideOnOverlayClick': false,
                        'hideOnContentClick': false,
                        'enableEscapeButton': false,
                        'href': '<?php echo base_url($this->_site_path . "/goods/special") ?>/?' + data,
                        'ajax': {
                            type: "GET"
                        },
                        'type': 'iframe',
                        'width': '800',
                        'height': '1000'
                    });
                }
                function up(data) {
                    $.fancybox({
                        'hideOnOverlayClick': false,
                        'hideOnContentClick': false,
                        'enableEscapeButton': false,
                        'href': '<?php echo base_url($this->_site_path . "/goods/up") ?>/?' + data,
                        'ajax': {
                            type: "GET"
                        },
                        'type': 'iframe',
                        'width': '800',
                        'height': '1000'
                    });
                }

            });
        </script>
