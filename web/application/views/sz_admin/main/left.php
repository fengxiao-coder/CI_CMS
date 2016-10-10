<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<title>产品管理CMS系统</title>
</head>
<body style="background:#edf8fc;">
<div class="sidebar">
    <div style="margin:0; height:14px;"><img src="<?php echo base_url(); ?>theme/default/images/sidebar_head.jpg" width="205" height="14"></div>
    <?php
    $second_search = array("in" => array("pid" => $top), 'orders' => array("sequence" => 'asc'));
    $second_level = $this->operations_type_model->get_values("type_id", 'type_name', '', $second_search);

    foreach ($second_level as $second_pid => $second_name) {
        ?>
    <div class="menu_box" id="div_group_<?php echo $second_pid;?>" style="display:none">
            <h1><i class="sidebar_icon"></i><?php echo $second_name; ?></h1>
            <ul>
                <?php
                $thd_search = array("in" => array("pid" => $second_pid), 'orders' => array("sequence" => 'asc'));
                $thd_level = $this->operations_type_model->all($thd_search);

                foreach ($thd_level as $thd_list) {
                    //$operations_search = array("in"=>array("operation_type_id"=>$thd_pid,'status'=>1),'opertation_id'=>'asc');   
                    $model_action_str = explode("?", $thd_list['url']);
                    $model_action_arr = explode("/", $model_action_str[0]);
                    if (count($model_action_arr) < 3) {
                        $model = end($model_action_arr);
                        $action = "index";
                    } else {
                        $model = $model_action_arr[count($model_action_arr) - 2];
                        $action = end($model_action_arr);
                    }
                      if($this->auth->check($model,$action)){
//                    if (1 == 1) {
                        ?>	
                        <li <?php echo  $checked_url== $thd_list['url']?"class='active'":"";?> >
                            <i class="icon"></i>
                            <a href="<?php echo base_url() . $thd_list['url'] . "&operation_name=" . $thd_list['type_name'] . "&operations_type_id=" . $thd_list['type_id']; ?>"  target='main' >
                                <?php echo  $thd_list['type_name']; ?>
                            </a>
                        </li>
                        <?php echo "<script>$('#" . $second_pid . "').show();</script>";
                              echo "<script>$('#div_group_" . $second_pid . "').show();</script>";
                    }
                }
                ?>
            </ul>
            <div class="float_clear"></div>
        </div>	
    <?php } ?>
</div>
<!-- sidebar end -->
    </body>
    </html>
<script type="text/javascript">
    $(function () {
        $(".menu_box li").click(function () {
            $(".menu_box li").removeClass('active');
            $(this).addClass('active');
            url = $("a", this).attr("href");
            parent.main.location = url;
        });
        $(".menu_box li").each(function (i) {
            if ($("a", this).attr('href') == parent.main.location) {
                $(".menu_box li").removeClass('active');
                $(this).addClass('active');
                return;
            }
        });
    })
    
    function get_check_name(){
        return $(".active").text();
    }
    
</script>
