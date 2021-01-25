
<div class="col-md-12 col-sm-4 ">
  <div class="x_panel tile">
    <div class="x_title">
      <h2>New | Ask For Help</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"></a>
        </li>
        <li>
            <a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <div class="col-md-12">
            <?=$this->session->flashdata('message')?>
        </div>

        <form method="post" action="<?=base_url()?>ask_help/submit_helper" enctype="multipart/form-data">

            <?php 
              //$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
              $last = $this->uri->total_segments();
              $actual_link = $this->uri->segment($last);
              //echo $actual_link;
            ?>

            <input type="hidden" name="id_purpose" value="<?=basename($actual_link)?>" required>

            <div class="col-md-12">
              <div class="row">
                  <div class="col-md-12">
                      <textarea class="form-control" name="helper_desc" placeholder="Helper Description" required></textarea>
                  </div>
                  <div class="col-md-6">
                      <hr>
                      <label for="">Date :</label>
                      <div class="input-group date">
                          <input type="text" class="form-control datepicker" name="start_date" required>
                          <div class="input-group-addon">
                              <span class="glyphicon glyphicon-th"></span>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <hr>
                      <label for="">Duration :</label>
                      <div class="input-group date">
                          <input type="number" class="form-control numericOnly" name="interval" placeholder="In Days" required>
                          <div class="input-group-addon">
                              <span class="fa fa-clock-o"></span>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-12">
                      <hr>
                      <select class="form-control" name="email_user">
                          <option>Pilih Helper</option>
                          <?php
                            foreach ($list_helper->result() as $key => $value) {
                              # code...
                              echo '<option value="'.$value->email.'">'.$value->first_name.' '.$value->last_name.'</option>';
                            }
                          ?>
                      </select>
                  </div>
                  <div class="col-md-6">
                      <hr>
                      <label for="">Rating :</label>
                      <input type="text" name="rating" class="star-rating rating-loading" value="0" data-size="md" title="" required>
                  </div>
                  <div class="col-md-6">
                      <hr>
                      <label for="">Attachment :</label>
                      <input type="file" name="upload" class="form-control" required>
                  </div>
                  <div class="col-md-12">
                      <hr>
                      <textarea class="form-control" placeholder="Comment" name="comment" required></textarea>
                  </div>  
                  <div class="col-md-12 text-right">
                      <hr>
                      <a href="<?=base_url()?>ask_help/view_purpose" class="btn btn-outline-secondary">Preview Purpose</a>
                      <button type="submit" class="btn btn-outline-secondary">Save Helper</button>
                  </div>             
              </div>
          </div>
            
        </form>

    </div>

  </div>

</div>