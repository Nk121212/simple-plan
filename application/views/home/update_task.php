<style>
    .notactive {
        pointer-events: none;
        cursor: default;
    }
    .hidden{
        display:none;
    }
</style>
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

        <form id="frmProgress" method="post" action="<?=base_url()?>task/submit_progress" enctype="multipart/form-data">

            <div class="col-md-12">
                <div class="row">
                    
                    <div class="col-md-6">
                        <hr>
                        <label for="">Purpose :</label>
                        <div class="input-group">
                            <select name="id_purpose" id="id_purpose" class="form-control" required>
                            <option disabled selected>Pilih Purpose</option>
                                <?php
                                    foreach ($purpose as $key => $value) {
                                        echo '<option value="'.$value->id.'">'.$value->purpose.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Task :</label>
                        <div class="input-group">
                            <select name="id_task" id="id_task" class="form-control" required>
                                <option disabled selected>Pilih Task</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 text-center chart-history hidden">
                        <canvas id="myChart" width="800" height="400"></canvas>
                    </div>

                    <div class="col-md-6">
                        <hr>
                        <label for="">Attachment :</label>
                        <div class="input-group">
                            <input type="file" name="upload" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <hr>
                        <label for="">% Progress :</label>
                        <div class="input-group">
                            <input type="text" name="progress" id="progress" class="form-control numericOnly maxHundred" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <label for="">Comment :</label>
                        <div class="input-group">
                            <textarea name="comment" id="comment" class="form-control"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <hr>
                    </div>
                    <div class="col-md-6 text-right">
                        <hr>
                        <button type="submit" class="btn btn-outline-secondary" onclick="checkProgress()"><i class="fa fa-save"></i> Save</button>
                    </div>              
                </div>
            </div>
            
        </form>

        <!--Menyimpan terakhir set progress persen-->
        <input type="hidden" id="recent_progress">

    </div>

  </div>

</div>

<script type="text/javascript" src="<?=base_url()?>assets/template/vendor/Chart.js/dist/Chart.bundle.js"></script>

<script type="text/javascript">

    $('form#frmProgress').each(function(){
        $(this).submit(function(e){

            var recent = parseInt($('#recent_progress').val());
            var now = parseInt($('#progress').val());

            if(now <= recent){
                e.preventDefault();
                swal("Progress Notice !", "Progress tidak boleh sama dengan atau kurang dari progress terakhir");
                $('#progress').val(recent).trigger('change');
                return false;
            }else{
                //alert('oke');
                return true;
            }
            
        })
    }) 

    $(document).ready(function(){

        $('#id_purpose').change(function(){

            $('.chart-history').addClass('hidden');
            $('#id_task').html('');

            var id_purpose = $(this).val();
            //alert(id_purpose);
            $.post("<?=base_url()?>task/get_task_by_purpose",
            {
              id_purpose: id_purpose,
            },
            function(resp){
                $('#id_task').append('<option value="" disabled selected>Pilih Task</option>');
                $.each(resp.data, function(k, v) {
                    $('#id_task').append('<option value="'+v.id+'">'+v.task+'</option>');
                });
            });
        })

        $('#id_task').change(function(){

            $('.chart-history').removeClass('hidden');

            var id_purpose = $('#id_purpose').val();
            var id_task = $(this).val();

            $.post("<?=base_url()?>json_print/getDataHistoryProgress",
            {
                id_purpose: id_purpose,
                id_task: id_task,
            },
            function(resp){

                var randomColorFactor = function() {
                    return Math.round(Math.random() * 255);
                };
                var randomColor = function() {
                    return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
                };

                var ctx = document.getElementById("myChart");

                var Graph_config = {
                    type: 'bar',
                    data: {
                        //labels: ["2015-01", "2015-02", "2015-03", "2015-04", "2015-05", "2015-06", "2015-07", "2015-08", "2015-09", "2015-10", "2015-11", "2015-12"],
                        labels: resp.label,
                        datasets: [{
                        label: '# History Progress',
                        //data: [12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1],
                        data: resp.data,
                        backgroundColor: resp.color,
                        borderColor: resp.color,
                        borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: false,
                        scales: {
                        xAxes: [{
                            ticks: {
                            maxRotation: 90,
                            minRotation: 80
                            },
                            gridLines: {
                            offsetGridLines: true // à rajouter
                            }
                        },
                        {
                            position: "top",
                            ticks: {
                            maxRotation: 90,
                            minRotation: 80
                            },
                            gridLines: {
                            offsetGridLines: true // et matcher pareil ici
                            }
                        }],
                        yAxes: [{
                            ticks: {
                            beginAtZero: true
                            }
                        }]
                        }
                    }
                }

                if(typeof Graph ==="undefined"){
                    window.Graph = new Chart(ctx, Graph_config);

                }else{
                    //updating with new chart data
                    window.Graph.config=Graph_config;
                    //redraw the chart
                    window.Graph.update();
                }
                
            });

            //alert(id_purpose);
            $.post("<?=base_url()?>task/get_progress_task",
            {
                id_purpose: id_purpose,
                id_task: id_task,
            },
            function(resp){

                $('#progress').val(resp);

                $('#recent_progress').val(resp).trigger('change');

                if(resp == '100'){
                    $('#progress').addClass("notactive");
                }else{
                    $('#progress').removeClass("notactive");
                }
                
            });
        })

    })
</script>