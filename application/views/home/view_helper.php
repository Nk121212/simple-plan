

<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/vendor/datatable/css/datatables.min.css">

<style>
  .hidden{
    display:none;
  }
  .mt20px{
    margin-top:20px;
  }
</style>

<div class="col-md-12 col-sm-4">
  <div class="x_panel tile">
    <div class="x_title">
      <h2>Preview | My Helper</h2>
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
    <div class="x_content table-responsive">

        <div class="col-md-12">
            <?=$this->session->flashdata('message')?>
        </div>

        <div class="col-md-4">
            <select name="id_purpose" id="id_purpose" class="form-control">
                <option disabled selected>Pilih Purpose</option>
                <?php
                    foreach ($purpose as $key => $value) {
                        echo '<option value="'.$value->id.'">'.$value->purpose.'</option>';
                    }
                ?>
            </select>
        </div>

        <div class="col-md-12">
          <hr>
        </div>
        
        <table class="table table-borderless text-center" id="table_helper">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Progress</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <br><br>
        

    </div>

  </div>

  <div class="x_panel tile">
    <div class="x_title">
      <!--h2>Preview | My Helper</h2-->
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
    <div class="x_content text-center hidden div-task table-responsive">

      <h5>Preview Task</h5>
      <h5 id="helper_mail"></h5>
    
        <table class="table table-borderless text-center" id="table_task">
            <thead>
              <tr>
                <th>Task</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Interval</th>
                <th>Progress</th>
              </tr>
            </thead>
            <tbody></tbody>
        </table>

        <br>
        <br>

    </div>

  </div>

</div>

<script type="text/javascript" src="<?=base_url()?>assets/js/preview_helper.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/template/vendor/datatable/js/datatables.min.js"></script>