	<?php $this->load->view_part( $this->_site_path."/common/banner" );?>
	
	<?php $this->load->view_part( $this->_site_path."/common/left" );?>
	
<!-- main -->
<div class="main float-left">

	<!-- top-bar -->
	<?php //$this->load->view_part( $this->_site_path.'/common/top_bar');?>
	<!-- top-bar -->
	
	<!-- headline -->
	<?php //$this->load->view_part( $this->_site_path.'/common/classify');?>
	<!-- headline -->
			
	<!-- main-wrap -->
	<div class="guestbook">
		
		<table class="table table-comment">
			<?php foreach ($msgs as $v):?>
			<tr class="tr-grey">
				<td width="7%">&nbsp;</td>
				<td width="7%"><i class="icon icon-talkbox"><?php echo $v['status'] ? 1 : 0;?></i></td>
				<td class="td-content" width="60%">
                     <p></p><div class="rebox"><?php echo $v['comment'];?></div><p></p>
				</td>	
                <td>
					<ul>
						<li><?php echo date('Y-m-d H:i', $v['comment_time']);?></li>
						<li class="comment-user"><i class="icon icon-user"></i><?php echo $v['visitor_name'];?></li>
					</ul>
				</td>
			</tr>
			<?php if($v['status']):?>
			<tr class="tr-reply">
				<td width="7%">&nbsp;</td>
				<td width="7%">&nbsp;</td>
				<td class="td-content"><span>管理员回复：</span><?php echo $v['reply_content'];?></td>
				<td>
					<ul>
						<li><i class="icon icon-comment"></i><?php echo date('Y-m-d H:i', $v['reply_time']);?></li>
					</ul>
				</td>
			</tr>
			<?php endif;endforeach;?>
		</table>
		
		<div class="pagelist pagelist-blue"><?php echo $pagination; ?></div>

		<form class="comment-form" url='<?php echo base_url($this->_site_path . '/message/reply_msg');?>'>
			<h3>发表您的留言</h3>
			<p><label for="uname">您的名字 <input type="text" name="uname" id="uname" value='' maxlength='20'></label><span class='form-uname'></span></p>
			<p><textarea name="msg" cols="38" rows="5" class="textarea"  id='textarea_area'></textarea></p>
			<p>
				<label>验证码&nbsp;&nbsp;</label>
				<input class="input-min" name="validate" type="text" id="vdcode2" maxlength='4'> <img src="<?php echo base_url($this->_site_path . '/message/get_captcha?r=' . md5(rand(0,1000)));?>" width="50" height="20">
				<a href='javascript:void(0);' onclick='changeCode();'>看不清?</a>　<span class='form-validate'></span>
			</p>
			<input type="button" value="发 表" class="submit-btn" onclick='reply_msg(this.form);' />
			<input type="hidden" name="is_submit" value="1">
		</form>
		<?php echo js('js/nicEdit.js')?>
		<script type="text/javascript">
			bkLib.onDomLoaded(function() {
				new nicEditor({iconsPath : '<?php echo base_url('theme/front/images/nicEditorIcons.gif')?>'}).panelInstance('textarea_area');
			});
			//刷新验证码
			function changeCode(){
				$('.comment-form').find('img').attr({'src' : '<?php echo base_url($this->_site_path . '/message/get_captcha?r=');?>' + Math.random()})
			}
			//回复留言
			function reply_msg(form){
				var name = (form.uname.value).replace(/(^\s+)|(\s+$)/g, '');
				var msg = ($(".nicEdit-main").html()).replace(/(^\s+)|(\s+$)/g, ''); 
				var validate = (form.validate.value).replace(/(^\s+)|(\s+$)/g, ''); 
				if(!name){
					$('.form-uname').html('请填写您的名字！');
					return false;
				}
				$('.form-uname').html('');
				if(!msg){
					alert('请填写您要回复的内容！');
					return false;
				}
				if(!validate){
					$('.form-validate').html('验证码不能为空！');
					return false;
				}
				if(validate.length != 4){
					$('.form-validate').html('验证码长度必须为4位！');
					return false;
				}
				$('.form-validate').html('');
				var query = {name : name, msg : msg, validate : validate};
				getMsg($('.table-comment'), form, query);
				return true;
			}
		</script>
		
	</div>
	<!-- main-wrap -->
</div>		
<!-- main -->
