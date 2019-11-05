<?php 
    require "header.php";

    $photos = Photo::find_all();
?>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg mx-auto" id="photo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-gallery modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Photo Gallery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-body-gallery">
        <div class="container">
        <div class="col-md-9">
              <div class="row">
                  <?php foreach($photos as $photo):?>
                  <div class="col-sm-2">
                      <a role="checkbox" aria-checked="false" tabindex="0" href="#">
                          <img class="modal_thumbnails img-fluid img-thumbnail d-block photo_lib" src="<?= $photo->picture_path(); ?>" data="<?= $photo->id; ?>">
                      </a>
                      <div class="photo-id hidden"></div>
                  </div>
                  <?php endforeach; ?>

              </div>
            </div>
            
           
          </div>
          <hr>
          <div class="container">
            <div class="col-md-3 d-block mx-auto">
                <div id="modal_sidebar"></div>
            </div>
          </div>
      </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" disabled="true" id="btn_imgsave">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
