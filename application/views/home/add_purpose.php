<div class="col-md-12 col-sm-4 ">
  <div class="x_panel tile">
    <div class="x_title">
      <h2>New | Add Purpose</h2>
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

        <form method="post" action="<?=base_url()?>purpose/submit_purpose" enctype="multipart/form-data">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control" name="purpose" placeholder="Purpose Description" required><?=!empty($purpose_data) ? $purpose_data[0]['purpose'] : ''?></textarea>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Start Date :</label>
                        <div class="input-group date">
                            <input value="<?=!empty($purpose_data) ? $purpose_data[0]['start_date'] : ''?>" type="text" class="form-control datepicker" name="start_date" id="start_date" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">End Date :</label>
                        <div class="input-group date">
                            <input value="<?=!empty($purpose_data) ? $purpose_data[0]['end_date'] : ''?>" type="text" class="form-control datepicker" name="end_date" id="end_date" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Rating :</label>
                        <input type="text" name="rating" class="star-rating rating-loading" value="<?=!empty($purpose_data) ? $purpose_data[0]['rating'] : 0?>" data-size="md" title="" required>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Attachment :</label>
                        <input type="file" name="upload" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <label for="">Helper :</label>
                        <select class="form-control selectpicker" name="helper[]" multiple data-live-search="true" id="helper" required>
                          <?php
                            foreach ($helper_list->result() as $key => $value) {
                                echo '<option value="'.$value->email.'">'.$value->first_name.' '.$value->last_name.'</option>';
                            }
                          ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <textarea class="form-control" placeholder="Comment" name="comment" required><?=!empty($purpose_data) ? $purpose_data[0]['comment'] : ''?></textarea>
                    </div>
                    <div class="col-md-6">
                        <hr>
                    </div>
                    <div class="col-md-6 text-right">
                        <hr>
                        <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-share-alt"></i> Share</button>
                    </div>              
                </div>
            </div>
            
        </form>

    </div>

  </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){

        $('.selectpicker').selectpicker('val', [<?=json_encode($helper[0]['email_helper'])?>]);
        
        $('#start_date,#end_date').change(function(){
            var start = $('#start_date').val();
            var end = $('#end_date').val();

            if(end < start && end != ''){
                alert('End Date tidak boleh kurang dari Start Date !');
                $("#end_date").val("");
            }
        })

    })
</script>