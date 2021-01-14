
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Helper</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <form method="post" action="<?=base_url()?>ask_help/add_helper">

          <div class="modal-body">
            
                
            <div class="col-md-12">
              <div class="row">
                  <div class="col-md-12">
                      <textarea class="form-control" name="description" placeholder="Helper Description"></textarea>
                  </div>
                  <div class="col-md-6">
                      <hr>
                      <label for="">Date :</label>
                      <div class="input-group date">
                          <input type="text" class="form-control datepicker" value="">
                          <div class="input-group-addon">
                              <span class="glyphicon glyphicon-th"></span>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <hr>
                      <label for="">Duration :</label>
                      <div class="input-group date">
                          <input type="text" class="form-control" value="" placeholder="In Days">
                          <div class="input-group-addon">
                              <span class="fa fa-clock-o"></span>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-12">
                      <hr>
                      <select class="form-control">
                          <option>Pilih Dari Kontak</option>
                      </select>
                  </div>
                  <div class="col-md-12">
                      <hr>
                      <select class="form-control">
                          <option>Pilih Kota</option>
                      </select>
                  </div>
                  <div class="col-md-6">
                      <hr>
                      <label for="">Rating :</label>
                      <input type="text" name="rating" class="star-rating rating-loading" value="0" data-size="md" title="">
                  </div>
                  <div class="col-md-6">
                      <hr>
                      <label for="">Attachment :</label>
                      <input type="file" name="file" class="form-control">
                  </div>
                  <div class="col-md-12">
                      <hr>
                      <textarea class="form-control" placeholder="Comment" name="comment"></textarea>
                  </div>              
              </div>
          </div>
                

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="icofont-close"></i> Close</button>
            <button type="submit" class="btn btn-sm btn-primary"><i class="icofont-login"></i> Save</button>
          </div>

        </form>

    </div>

  </div>