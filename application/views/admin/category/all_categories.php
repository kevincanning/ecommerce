<div class="content-wrapper">
    <div>
        <?php if($this->session->flashdata('class')): ?>
        <div class="<?php echo $this->session->flashdata('class'); ?> alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-lable="Close">
                <span
                    aria-hidden="true">x</span></button>
            <?php echo $this->session->flashdata('message'); ?>

        </div>
        <?php endif; ?>
    </div>
    <div class="row admin-padding">
        <div class="col-md-6 col-md-offset-3">
            <h2>All Categories</h2>
            <table class="table table-dashed">
                <?php if($all_categories): ?>
                <?php foreach($all_categories as $category) : ?>
                <tr>
                    <td>
                        <?php echo $category->id; ?>
                    </td>
                    <td>
                        <?php echo $category->name; ?>
                    </td>
                    <td>
                        <a href="<?php echo site_url('admin/edit_category/' . $category->id); ?> " class="btn btn-info">
                            Edit
                        </a>
                    </td>
                    <td>
                        <a href="" class="btn btn-danger">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $links; ?>
            <?php else: ?>
            Categories not available.
            <?php endif; ?>
        </div>
    </div>
</div>