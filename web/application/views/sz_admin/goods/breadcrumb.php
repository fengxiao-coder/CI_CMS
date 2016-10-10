<?php //echo js("js/jquery.js");    ?>
<?php $name_arr = $this->common->get_menu_name($this->auth->get_name_model()); ?>  
<!--  添加信息页面-->
<div class="max_mainbox">
    <div class="add_info">
        <div class="breadcrumb">
            <div class="breadcrumb_i">
                您当前所在的位置：
                <span  id="title_name"><?php echo $name_arr['type_name']; ?></span>
                <span>
                    <?php
                    $rt = $this->auth->get_name_action();
                    if ('up' == $current_type) {
                        $str = "已上架";
                    } elseif ('down' == $current_type) {
                        $str = "已下架";
                    } elseif ('hot' == $current_type) {
                        $str = "热卖";
                    } elseif ('special' == $current_type) {
                        $str = "特价";
                    } elseif ('remind' == $current_type) {
                        $str = "告急";
                    } elseif ('get' == $current_type) {
                        $str = "已采购";
                    } else {
                        $str = "";
                    }
                    ?>
                    <?php
                    if ($str) {
                        echo '<front class="orange">&nbsp;- &nbsp;' . $str . "</front>";
                    }
                    ?>
                </span>
            </div>
			<?php if(!$this->auth->get_user('store_id')){ 
				if (isset($flag) && $flag == 1) { ?>
            <?php } else { ?>
                <div class="breadcrumb_div"><a href="<?php echo base_url($this->_site_path . "/shipment/add"); ?>" target='main' class="breadcrumb-add">商品出库</a></div> 
                <div class="breadcrumb_div"><a href="<?php echo base_url($this->_site_path . "/purchase/add"); ?>" target='main' class="breadcrumb-add">商品采购</a></div> 
                <div class="breadcrumb_div"><a href="<?php echo base_url($this->_site_path . "/" . $this->auth->get_name_model() . "/add"); ?>" target='main' class="breadcrumb-add">添加商品</a></div> 
            <?php }} ?>
            
        </div>
        <script>
            $(function () {
                var a = parent.left.get_check_name();
                $("#title_name").html(a);
            });
        </script>

