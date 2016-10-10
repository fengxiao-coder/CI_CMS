<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<?php $this->load->view_part($this->_site_path."/admin_group/search")?>
<?php $show_view_url = base_url($this->_site_path."/admin_group/view");?>
<!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path."/admin_group/delete_all");?>">
    <div class="list_box">
        <table id="tb" class="table table-striped table-condensed table-bordered">
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                   <th>名称</th>
                    <th >备注</th>
                    <th class="Operation">操作</th>
                </tr>

            </thead>
            <tbody>
                <?php foreach ($admin_group_data as $single) {  ?>
                <!--  鼠标悬停，整行变色，-->
                <tr  >
                    <td>
                        <input name="ids[]" value="<?php echo $single['group_id']; ?>" type="checkbox" />
                    </td>
                    
                    <td  class="align_left" style="cursor:pointer;cursor:hand" onclick="tiao_url('<?php echo $show_view_url."/".$single['group_id'];?>')"><?php echo $single['group_name']; ?></td>
                    <td  class="align_left" style="cursor:pointer;cursor:hand" onclick="tiao_url('<?php echo $show_view_url."/".$single['group_id'];?>')"><?php echo $single['group_description']; ?></td>
                    <td>
                        <a href="<?php echo base_url($this->_site_path . "/admin_group/edit/{$single['group_id']}"); ?>">修改</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- 表格底部帮助栏-->
    <div class="tips">
        <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
        <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->

        <!-- 分页开始-->
        <?php echo $pagination; ?>
        <!-- 分页结束-->
    </div>
</form>
<!--tips 结束-->


