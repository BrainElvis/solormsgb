<div class="page-content">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php isset($current_section) ? print $current_section : print'' ?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="content">
                    <p>Drag multiple files to the box below for multi upload or click to select files. This is for demonstration purposes only, the files are not uploaded to any server.</p>
                    <form action="<?php echo site_url('admin/showcase/save_gallery') ?>" class="dropzone" name="dropzone" style="border: 1px solid #e5e5e5; min-height: 300px; ">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <ul class="row">
        <?php if (!empty($gallery_images)): ?>
            <?php foreach ($gallery_images as $image) : ?>    
                <li class="col-md-2">
                    <span class="glyphicon glyphicon-remove-sign gallery-glyphicon title" onclick="deleteGalleryImage(<?php echo $image->id ?>)"></span>
                    <img class="img-responsive" src="<?php echo ASSETS_SITE_GALLERY_IMAGE_PATH . $image->name ?>"><br/>
                    <span>Activate</span>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>             
</div> 
<script>
    function deleteGalleryImage(id) {
        $.ajax({
            url: "<?php echo site_url('admin/showcase/delete_image') ?>",
            data: {
                id: id
            },
            type: "POST",
            dataType: "json",
            beforeSend: function () {
            },
            success: function (json) {
                console.log(json.message);
            },
            error: function (xhr, status, errorThrown) {
                alert("Sorry, there was a problem!");
            },
            complete: function (xhr, status) {
                location.reload();
            }
        });
    }
</script>