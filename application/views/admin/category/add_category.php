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
        <div class="col-md-6 col-md-offset-3">
            <?php echo form_open_multipart('admin/add_category','','') ?>
                <div class="form-group">
                    <?php echo form_input('name', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_upload('image', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_submit('Add Category', 'Add Category', 'class="btn btn-primary"'); ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>