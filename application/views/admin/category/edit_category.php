<div class="content-wrapper">
<div>
                    <?php if($this->session->flashdata('class')): ?>
                    <div class="<?php echo $this->session->flashdata('class'); ?> alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-lable="Close"><span aria-hidden="true">x</span></button>
                        <?php echo $this->session->flashdata('message'); ?>

                    </div>
                    <?php endif; ?>
                </div>
    <div class="row admin-padding">
        <div class="col-md-6 col-md-offset-1">
            <h3>Edit Category</h3>
            <?php echo form_open_multipart('admin/update_category','','') ?>
            <input name="category_id" type="hidden" value="<?php echo $category[0]['id']; ?>">
            <input name="old_image" type="hidden" value="<?php echo $category[0]['image']; ?>">
                <div class="form-group">
                    <?php echo form_input('name', $category[0]['name'], 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_upload('image', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_submit('Update Category', 'Update Category', 'class="btn btn-primary"'); ?>
                </div>
            <?php echo form_close(); ?>
        </div>
        <div class="col-md-3">
            <img src="<?php echo base_url('assets/images/categories/'.$category[0]['image']) ?>" alt="">
        </div>
    </div>
</div>