<?php
$user_id = $this->session->userdata('userid');
$user = $this->user_model->get_value_by_pk($user_id,'user_name');
?>
 <footer>
       <ul class="ui_grid_b">
       
       	<?php if($user){?>
          		<li class="foottel"><a href="<?php echo base_url($this->_site_path . '/user/userhome'); ?>" title="我的账户"><p><?php echo $user;?></p></a></li>
             	<li class="footmail"><a href="<?php echo base_url($this->_site_path . '/user/logout');?>" title="退出"><p>退出</p></a></li>
          	<?php }else{ ?>
          		<li class="foottel"><a href="<?php echo base_url($this->_site_path . '/user/register');?>" title="用户注册"><p>注册</p></a></li>
             	<li class="footmail"><a href="<?php echo base_url($this->_site_path . '/user/login');?>" title="用户登录"><p>登录</p></a></li>
          	<?php }?>  
           <li class="footmap"><a href="<?php echo base_url($this->_site_path . '/index/suggest'); ?>" title="意见反馈"><p>意见反馈</p></a></li>
           <li class="footmap " style="border:0"><a href="" title="置顶"><p>置顶</p></a></li>
       </ul>
    </footer>
    
  </body>
</html>