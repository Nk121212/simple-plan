<style>
    .fs-big{
        font-size : large;
        margin-top: 10px;
    }
</style>
<div class="col-md-12 col-sm-4 ">
  <div class="x_panel tile">
    <div class="x_title">
      <h2>New | Add Task</h2>
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

        <form method="post" action="<?=base_url()?>task/submit_task" enctype="multipart/form-data">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <select name="id_purpose" id="id_purpose" class="form-control">
                            <option disabled selected>Pilih Purpose</option>
                            <?php
                                foreach ($purpose as $key => $value) {
                                    echo '<option value="'.$value->id.'">'.$value->purpose.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12 text-center" id="myTask">
                        
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <textarea class="form-control" name="task" placeholder="Task Description" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Start Date :</label>
                        <div class="input-group date">
                            <input value="" type="text" class="form-control datepicker" name="start_date" id="start_date" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">End Date :</label>
                        <div class="input-group date">
                            <input value="" type="text" class="form-control datepicker" name="end_date" id="end_date" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Rating :</label>
                        <input type="text" name="rating" class="star-rating rating-loading" value="0" data-size="md" title="" required>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Attachment :</label>
                        <input type="file" name="upload" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <textarea class="form-control" placeholder="Comment" name="comment"></textarea>
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
        
        $('#start_date,#end_date').change(function(){
            var start = $('#start_date').val();
            var end = $('#end_date').val();

            if(end < start && end != ''){
                alert('End Date tidak boleh kurang dari Start Date !');
                $("#end_date").val("");
            }
        })

        $('#id_purpose').change(function(){

            $("#myTask").html("");
            //alert($(this).val());
            var id_purpose = $(this).val();

            $.post("<?=base_url()?>task/getMyTask",
            {
                id_purpose: id_purpose,
            },
            function(response){
                console.log(response);
                $('#myTask').append('<h3>List My Task</h3>');
                $.each(response, function(i, task){
                    $('#myTask').append('<span class="badge badge-primary fs-big">'+task.task+'</span>&nbsp;&nbsp;&nbsp;&nbsp;');
                });
            });
        })

    })
</script>