<div class="col-md-12 col-sm-4 ">
  <div class="x_panel tile">
    <div class="x_title">
      <h2>Update | Progress Task</h2>
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

        <form method="post" action="<?=base_url()?>task/submit_progress" enctype="multipart/form-data">

            <div class="col-md-12">
                <div class="row">
                    
                    <div class="col-md-4">
                        <hr>
                        <label for="">Purpose :</label>
                        <div class="input-group date">
                            <select name="id_purpose" id="id_purpose" class="form-control">
                            <option disabled selected>Pilih Purpose</option>
                                <?php
                                    foreach ($purpose as $key => $value) {
                                        echo '<option value="'.$value->id.'">'.$value->purpose.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <hr>
                        <label for="">Task :</label>
                        <div class="input-group date">
                            <select name="id_task" id="id_task" class="form-control">
                                <option disabled selected>Pilih Task</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <hr>
                        <label for="">% Progress :</label>
                        <div class="input-group date">
                            <input type="text" name="progress" id="progress" class="form-control numericOnly">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <hr>
                    </div>
                    <div class="col-md-6 text-right">
                        <hr>
                        <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-save"></i> Save</button>
                    </div>              
                </div>
            </div>
            
        </form>

    </div>

  </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#id_purpose').change(function(){

            $('#id_task').val('');

            var id_purpose = $(this).val();
            //alert(id_purpose);
            $.post("<?=base_url()?>task/get_task_by_purpose",
            {
              id_purpose: id_purpose,
            },
            function(resp){
                $.each(resp.data, function(k, v) {
                    $('#id_task').append('<option value="'+v.id+'">'+v.task+'</option>');
                });
            });
        })
    })
</script>