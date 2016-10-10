<?php $this->load->view_part($this->_site_path."/main/breadcrumb");?>

<?php $this->load->view_part($this->_site_path."/link/search")?>

<!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path."/link/delete_all");?>">
    <div class="list_box">
        <table id="tb" class="table table-striped table-condensed table-bordered">
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                    <?php foreach ($this->$modelname->list_array as $k => $v): ?>
                    <th><?php echo $v; ?></th>
                    <?php endforeach; ?>
                    <th>操作</th>
                </tr>

            </thead>
            <tbody>
                
                <?php foreach ($link_data as $single) { ?>
                <!--  鼠标悬停，整行变色，-->
                <tr  >
                    <td>
                        <input name="ids[]" value="<?php echo $single['link_id']; ?>" type="checkbox" />
                    </td>
                    
                    <?php foreach ($this->$modelname->list_array as $k => $v): ?>
                    <td onclick="javascript:window.location.href='<?php echo base_url($this->_site_path."/link/view/{$single['link_id']}"); ?>';"><?php echo $single[$k]; ?></td>
                    <?php endforeach; ?>
                    
                    <td>
                        <a href="<?php echo base_url($this->_site_path."/link/edit/{$single['link_id']}"); ?>">修改</a>
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
