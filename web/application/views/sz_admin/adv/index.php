<?php 
$button = array("添加"=>array("c_model"=>'add','url'=> base_url("sz_admin/adv/add")));
$this->common->show_title_breadcrumb("adv",$button);
?>
<?php $this->load->view_part($this->_site_path . "/adv/search") ?>
<!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path . "/adv/delete_all"); ?>">
    <div class="list_box">
        <table id="tb" class="table table-striped table-condensed table-bordered">
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                    <th>名称</th>
                    <th>内容</th>
                    <th>链接</th>
                    <th>点击量</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adv_data as $single) { ?>
                    <!--  鼠标悬停，整行变色，-->
                    <tr  >
                        <td>
                            <input name="ids[]" value="<?php echo $single['adv_id']; ?>" type="checkbox" />
                        </td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/adv/view/{$single['adv_id']}"); ?>';"><?php echo $single['adv_title']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/adv/view/{$single['adv_id']}"); ?>';"><?php echo $single['adv_content']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/adv/view/{$single['adv_id']}"); ?>';"><?php echo $single['adv_url']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/adv/view/{$single['adv_id']}"); ?>';"><?php echo $single['click_num']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/adv/view/{$single['adv_id']}"); ?>';"><?php echo $single['sort']; ?></td>
                        <td>
                            <a href="<?php echo base_url($this->_site_path . "/adv/edit/{$single['adv_id']}"); ?>">修改</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- 表格底部帮助栏-->
    <div class="tips">
        <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
        <?php if($this->auth->check("adv","delete_all")):?> 
        <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
        <?php endif;?>
        <!-- 分页开始-->
        <?php echo $pagination; ?>
        <!-- 分页结束-->
    </div>
</form>
<!--tips 结束-->
