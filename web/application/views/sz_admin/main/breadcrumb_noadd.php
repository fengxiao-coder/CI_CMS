<?php //echo js("js/jquery.js");?>
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
                    if ($rt == 'view') {
                        $str = "详情";
                    } elseif ($rt == 'add') {
                        $str = "添加";
                    } elseif ($rt == 'edit') {
                        $str = "修改";
                    } elseif ($rt == 'delete') {
                        $str = "删除";
                    } else {
                        $str = "";
                    }   
                    ?>
                    <?php  if($str){
                   echo '<front class="orange">&nbsp;- &nbsp;'.$str."</front>";
                    }?>
                </span>

            </div>
        </div>
 <script>
     var a = parent.left.get_check_name();
     //  alert(a)
     $("#title_name").html(a);
</script>

