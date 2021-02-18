

<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/vendor/datatable/css/datatables.min.css">

<div class="col-md-12 col-sm-4">
  <div class="x_panel tile">
    <div class="x_title">
      <h2>Preview | My Purpose</h2>
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

        <table class="table table-borderless text-center" id="table_purpose">
            <thead>
                <tr>
                    <th>Purpose</th>
                    <th>Helper</th>
                    <th>Progress</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>

  </div>

</div>

<script type="text/javascript" src="<?=base_url()?>assets/js/preview_purpose.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/template/vendor/datatable/js/datatables.min.js"></script>