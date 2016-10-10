 
<?php if ( $layout_state['header_state'] != 'close' ) {?>
	<?php  $this->load->view_part( "member/common/header" );?>
<?php }?>
<div class="warp">
	<?php if ( $layout_state['front_top_state'] != 'close' ) {?>
		<?php $this->load->view_part( "member/common/top" );?>
	<?php }?>
        <?php if ( $layout_state['front_nav_state'] != 'close' ) {?>
		<?php $this->load->view_part( "member/common/member_nav" );?>
	<?php }?>
        <div class="main">
    	<div class="rowbox">
       	      
 <?php if ( $layout_state['sidebar_state'] != 'close' ) {?>
				<?php $this->load->view_part( "member/common/sidebar" );?>
			<?php }?>     	      
       	      
           <?php echo $content;?>
            <div class="c"></div>
        </div>
       <?php if ( $layout_state['footer_state'] != 'close' ) {?>
		<?php $this->load->view_part( "member/common/footer" );?>
	<?php }?>
    </div>
    
</div> 
</body>
</html>

     