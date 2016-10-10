<script type="text/javascript">
function setMain(i,url){
  parent.middle.left.location = url;
}
</script>
<div class="header">
    <div class="top">
<!--        <div class="logo float_left">
            <img class="logo_text" src="../../theme/default/images/name.png" />
        </div>-->
        <div class="navbar float_right">
            <ul>
                <li class="icon icon_exit"><a href="<?php echo base_url($this->_site_path . '/login/login_out'); ?>" target="_top"  onclick="if (confirm('确定要退出吗?'))
                            return true;
                        else
                            return false;" ><i class="icon-off"></i>退出系统</a></li>
                    <li class="icon icon_update"><a href="javascript:ajax_update_user_password('<?php echo base_url($this->_site_path .'/main/main_user_info'); ?>');" onclick="self.parent.frames['middle'].location=href;return false;">修改基本信息</a></li>
                <li class="icon icon_home"><a href="<?php echo base_url() . "sz_admin"; ?>" target="_top">首页</a></li>
                <li class="icon icon_user"><span>【<?php echo $this->auth->get_user('user_name'); ?>】</span> <?php echo $username; ?></li>
            </ul>
        </div>
    </div>
    <!--  top结束-->
    <div class="nav">
        <div class="date float_left"><i class="icon_date"></i><span> <?php echo date('Y年m月d日', time()) ?></span> <span>
                <?php
                $datearr = array('天', '一', '二', '三', '四', '五', '六');
                echo '星期' . $datearr[date("w", time())];
                ?></span></div>

        <div class="top_menu">
            <ul id='top_menu'>
                <?php
                p($this->abc);
                $p_list = $this->operations_type_model->all(array("in" => array("pid" => 0), 'orders' => array('sequence' => 'asc')));
                //pe($this);
                foreach ($p_list as $key => $value) {
                    $flag = 0;
                    $second_search = array("in" => array("pid" => $value['type_id']), 'orders' => array("sequence" => 'asc'));
                    $second_level = $this->operations_type_model->get_values("type_id", 'type_name', '', $second_search);
                    foreach ($second_level as $second_pid => $second_name) {
                        $thd_search = array("in" => array("pid" => $second_pid), 'orders' => array("sequence" => 'asc'));
                        $thd_level = $this->operations_type_model->all($thd_search);
                        foreach ($thd_level as $thd_list) {
                            $model_action_str = explode("?", $thd_list['url']);
                            $model_action_arr = explode("/", $model_action_str[0]);
                            if (count($model_action_arr) < 3) {
                                $model = end($model_action_arr);
                                $action = "index";
                            } else {
                                $model = $model_action_arr[count($model_action_arr) - 2];
                                $action = end($model_action_arr);
                            }

                            if ($this->auth->check($model, $action)) {
//                            if (1==1) {
                                $flag = 1;
                            }
                        }
                    }
                    if ($flag) {
                        ?>
                        <li id="top<?php echo "_" . $value['type_id']; ?>"  class='<?php echo $key == 0 ? "active" : ""; ?>' 
                            rel=<?php echo $key + 1; ?> onClick='setMain(<?php echo $key+1; ?>, "<?php echo base_url('sz_admin/main/left/' . ($value['type_id'])); ?>" )' >
                            <a target="main" href="<?php echo site_url($value['url']); ?>" >
                                <?php echo $value['type_name']; ?>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>         
            </ul>
        </div>
        <div class="float_clear"></div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#top_menu li").click(function () {
            $("#top_menu li").removeClass('active');
            $(this).addClass('active');
            //url = $("a", this).attr("href");
            //parent.middle.left.location = url;
        });
    });

   
</script>
