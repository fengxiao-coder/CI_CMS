<?php //echo js("js/jquery.js");      ?>
<?php $name_arr = $this->common->get_menu_name($this->auth->get_name_model()); ?>  
<!--  添加信息页面-->
<div class="max_mainbox">
    <div class="add_info">
        <div class="breadcrumb">
            <div class="breadcrumb_i">
                您当前所在的位置：
                <span  id="title_name"><?php echo $name_arr['type_name']; ?></span>
                <span>
                    <front class="orange">&nbsp;- &nbsp;入库</front>
                </span>
            </div>
<!--            <div class="breadcrumb_div"><a href="#" onClick="up(this);" target='main' class="breadcrumb-add">添加商品</a></div>
-->        </div>
        <script>
            $(function () {
                var a = parent.left.get_check_name();
                $("#title_name").html(a);
            });

            function up(){
                $.fancybox({
                    'hideOnOverlayClick': false,
                    'hideOnContentClick': false,
                    'enableEscapeButton': false,
                    'href': '<?php echo base_url($this->_site_path . "/goods/add"); ?>',
                    'ajax': {
                        type: "GET"
                    },
                    'type': 'iframe',
                    'width': '800',
                    'height': '1000'
                });
            }
        </script>





