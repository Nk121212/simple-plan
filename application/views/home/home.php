<?php

  $CI =& get_instance();
  $CI->load->model('M_crud');
  $result = $CI->M_crud->get_where('SP_USER', array('email' => $this->session->userdata('data_user')[0]['email']));
  $latest_profile = $result->result_array();

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url()?>assets/template/images/fav.ico" type="image/ico" />

    <title>Simple Plan</title>

    <!-- Bootstrap -->
    <link href="<?=base_url()?>assets/template/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>assets/template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>assets/template/build/css/custom.min.css" rel="stylesheet">

    <link href="<?=base_url()?>assets/template/vendor/bootstrap-star-rating/css/star-rating.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/vendor/bootstrap-select/css/bootstrap-select.min.css">

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/template/vendor/sweetalert/css/sweetalert.css">

    <!-- jQuery -->
    <script src="<?=base_url()?>assets/template/vendor/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=base_url()?><?=$latest_profile[0]['image']?>" alt="" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?=$latest_profile[0]['first_name']?> <?=$latest_profile[0]['last_name']?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url()?>home">Dashboard</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> New <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url()?>purpose/new_purpose">Purpose</a></li>
                      <li><a href="<?=base_url()?>task/new_task">Task</a></li>
                      <li><a href="<?=base_url()?>task/forward_task">Forward Task</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-eye"></i> View <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url()?>purpose/view_purpose">My Purpose</a></li>
                      <li><a href="<?=base_url()?>task/view_task">My Task</a></li>
                      <li><a href="<?=base_url()?>helper/view_helper">My Helper</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-refresh"></i> Update <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url()?>task/update_task">Progress Task</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-history"></i> History <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url()?>purpose/history">My History</a></li>
                    </ul>
                  </li>
                  <!--li><a><i class="fa fa-file"></i> Draft <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">Ask For Help</a></li>
                      <li><a href="form_advanced.html">Help My Self</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-comments-o"></i> Feedback <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">Ask For Help</a></li>
                      <li><a href="form.html">Help Friends</a></li>
                      <li><a href="form_advanced.html">Help My Self</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-history"></i> History <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="form.html">Ask For Help</a></li>
                      <li><a href="form.html">Help Friends</a></li>
                      <li><a href="form_advanced.html">Help My Self</a></li>
                    </ul>
                  </li-->
                  <li><a><i class="fa fa-info"></i> Help <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url()?>help">How To Use</a></li>
                      <li><a href="form.html">About</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?=base_url().$latest_profile[0]['image']?>" alt=""><?=$latest_profile[0]['first_name']?> <?=$latest_profile[0]['last_name']?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?=base_url()?>profile"> Profile</a>
                      <!--a class="dropdown-item"  href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a-->
                    <!--a class="dropdown-item"  href="javascript:;">Help</a-->
                    <a class="dropdown-item"  href="<?=base_url()?>auth/submit_logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                  <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="<?=$latest_profile[0]['image']?>" alt="" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="<?=$latest_profile[0]['image']?>" alt="" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="<?=$latest_profile[0]['image']?>" alt="" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item">
                        <span class="image"><img src="<?=$latest_profile[0]['image']?>" alt="" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <div class="text-center">
                        <a class="dropdown-item">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <div class="right_col" role="main">

            <?php
                $this->load->view($main);
            ?>
            <!-- /page content -->
        </div>

        <!-- footer content -->
        <footer>
          <!--div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div-->
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
  </body>

    <script src="<?=base_url()?>assets/template/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url()?>assets/template/vendor/moment/min/moment.min.js"></script>

    <script src="<?=base_url()?>assets/template/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?=base_url()?>assets/template/build/js/custom.min.js"></script>

    <script src="<?=base_url()?>assets/template/vendor/bootstrap-star-rating/js/star-rating.js"></script>

    <script type="text/javascript" src="<?=base_url()?>assets/js/load-star-rating.js"></script>

    <script type="text/javascript" src="<?=base_url()?>assets/template/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript" src="<?=base_url()?>assets/template/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>

    <script type="text/javascript" src="<?=base_url()?>assets/template/vendor/sweetalert/js/sweetalert.min.js"></script>

    <script type="text/javascript" src="<?=base_url()?>assets/js/global_function.js"></script>

    <script type="text/javascript">

      $(document).ready(function(){

        $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true
        });

        $(".numericOnly").keypress(function (e) {
            if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
        });

        $('[data-toggle="tooltip"]').on("mouseleave", function(){
            $(this).tooltip("hide"); 
        })

        $('.maxHundred').keyup(function(){

            var this_val = $(this).val();

            if(this_val > 100){
              //alert(this_val);
              $(this).val('100');
              return false;
            }else{

            }

        })

        $('form').preventDoubleSubmission();

      })

    </script>

</html>
