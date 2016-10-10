<?php $this->load->view_part($this->_site_path . "/main/breadcrumb_noadd"); ?>

<?php $this->load->view_part($this->_site_path . "/suggest/search") ?>

<form method="post" action="<?php echo base_url($this->_site_path . "/suggest/delete_all"); ?>">
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
            <?php 
            foreach ($suggest_data as $single) { ?>
                <tr>
                    <td>
                        <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" />
                    </td>
                    <?php foreach ($this->$modelname->list_array as $k => $v): ?>
                        <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/suggest/view/{$single['id']}"); ?>';"><?php echo $single[$k]; ?></td>
                    <?php endforeach; ?>
                    <td>
                        <a href="<?php echo base_url($this->_site_path . "/suggest/delete/{$single['id']}"); ?>" onclick="return confirmDelete()">删除</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="tips">
        <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
        <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
        <!-- 分页开始-->
        <?php echo $pagination; ?>
        <!-- 分页结束-->
    </div>
</form>
