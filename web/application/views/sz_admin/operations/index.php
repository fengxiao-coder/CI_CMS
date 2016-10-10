<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<?php  $this->load->view_part($this->_site_path."/operations/search");
 $show_view_url = base_url($this->_site_path."/operations/view");
?>

<!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path."/operations/delete_all"); ?>" >
    <div class="list_box">
         <table id="tb" class="table table-striped table-condensed table-bordered" >
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                    <th>名称</th>
                    <th>控制器</th>
                    <th>动作</th>
                    <th>权限类别</th>
			
                   <th>操作</th>
                </tr>

            </thead>
            <tbody>
                
                <?php foreach ($operations_data as $single) { ?>
                <!--  鼠标悬停，整行变色，-->
                <tr  >
                    <td>
                        <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" />
                    </td>
                    <td  class="align_left" style="cursor:pointer;cursor:hand" onclick="tiao_url('<?php echo $show_view_url."/".$single['operation_id'];?>')"><?php echo $single['operation_name']; ?></td>
                    <td  class="align_left" style="cursor:pointer;cursor:hand" onclick="tiao_url('<?php echo $show_view_url."/".$single['operation_id'];?>')"><?php echo $single['module']; ?></td>
                    <td  class="align_left" style="cursor:pointer;cursor:hand" onclick="tiao_url('<?php echo $show_view_url."/".$single['operation_id'];?>')"><?php echo $single['action']; ?></td>
                    <td  class="align_left" style="cursor:pointer;cursor:hand" onclick="tiao_url('<?php echo $show_view_url."/".$single['operation_id'];?>')"><?php echo $this->operations_type_model->get_value_by_pk($single['operations_type_id'],'type_name'); ?></td>
               
                    
                    <td>
                        <a href="<?php echo base_url($this->_site_path . "/operations/edit/{$single['operation_id']}"); ?>">修改</a>
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
</div>
</div>
</div>

    <script>
        function tiao_url(url){
            location=url;
        }
    </script>
