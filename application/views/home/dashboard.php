
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/vendor/datatable/css/datatables.min.css">

    <div class="col-md-12 col-sm-4 ">

      <div class="x_panel tile">
        <div class="x_title">
          <h2>REQUEST HELP</h2>
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

            <table class="table table-hover text-center" id="table_request_help">
                <thead>
                    <tr>
                        <th width="10%"></th>
                        <th width="50%"></th>
                        <th width="40%"></th>
                    </tr>
                </thead>
                <tbody>

                  <?php

                    if(empty($request_help)){
                      echo '
                        <tr style="background-color:red;color:white;">
                          <td colspan="3">No Data</td>
                        </tr>
                      ';
                    }else{

                      foreach ($request_help->result() as $key => $req) {
                        echo '
                        
                          <tr style="border: 1px solid antiquewhite;">
                              <td>
                                  <img src="'.base_url().''.$req->image.'" class="rounded-circle" height="50">
                                  <p class="font-weight-bold" style="padding-top: 10px;">'.$req->first_name.' '.$req->last_name.'</p>
                              </td>
                              <td>
                                  <p class="font-weight-bold">Request Help '.date("d M Y h:i:s", strtotime($req->add_at)).'</p>
                                  <p><b>'.$req->purpose.'</b></p>
                                  <p>'.$req->comment.'</p>
                              </td>
                              <td>
                                <input type="text" name="rating" class="star-rating rating-loading" value="'.$req->rating.'" data-size="sm" title="" readonly>
                                <p class="font-weight-bold" style="padding-top:10px;">'.date("d M Y", strtotime($req->start_date)).' - '.date("d M Y", strtotime($req->end_date)).'</p>
                              </td>
                          </tr>
  
                        ';
  
                      }
                      
                    }
                    
                  ?>
                    
                </tbody>
            </table>

        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-4 ">
      <div class="x_panel tile">
        <div class="x_title">
          <h2>PROGRESS PURPOSE</h2>
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
          
           <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>Purpose</th>
                        <th>Total Task</th>
                        <th>Progress</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Interval</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                      if(empty($progress)){
                        echo '
                          <tr style="background-color:red;color:white;">
                            <td colspan="6">No Data</td>
                          </tr>
                        ';
                      }else{

                        foreach ($progress as $key => $value) {
                          echo '
                            <tr>
                              <td>'.$value['purpose'].'</td>
                              <td><a href="'.base_url().'task/task_by_helper/'.base64_encode($value['id_purpose']).'" class="btn btn-sm btn-primary">'.$value['total_task'].' Task</a></td>
                              <td>'.$value['progress'].' %</td>
                              <td>'.$value['start'].'</td>
                              <td>'.$value['end'].'</td>
                              <td>'.$value['interval'].'</td>
                            </tr>
                          ';
                        }

                      }
                    ?>
                </tbody>
            </table>

        </div>
      </div>
    </div>

    <!--div class="col-md-12 col-sm-4 ">
      <div class="x_panel tile">
        <div class="x_title">
          <h2>UPDATES</h2>
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
          
           <table class="table table-borderless text-center">
                <thead>
                    <tr>
                        <th width="10%"></th>
                        <th width="50%"></th>
                        <th width="40%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border: 1px solid antiquewhite;">
                        <td>
                            <img src="<?=base_url()?>assets/template/images/img.jpg" class="rounded-circle" height="50">
                            <p class="font-weight-bold" style="padding-top: 10px;">John Doe</p>
                        </td>
                        <td>
                            <p class="font-weight-bold">Suggest New Helper @ yours ask for help | 01/07/2020 12:15 AM</p>
                            <p>Description Help ....</p>
                        </td>
                        <td>
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div-->

    <!--script src="<?=base_url()?>assets/js/dashboard.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/template/vendor/datatable/js/datatables.min.js"></script-->