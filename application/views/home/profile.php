<style>
    .notactive {
        pointer-events: none;
        cursor: default;
    }
</style>
<div class="col-md-12 col-sm-4 ">
  <div class="x_panel tile">
    <div class="x_title">
      <h2>Profile | My Profile</h2>
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

        <?php
            //print_r($profile);
            //echo $this->session->userdata('data_user')[0]['image'];
        ?>

        <form method="post" action="<?=base_url()?>profile/submit_update" enctype="multipart/form-data" autocomplete="off">

            <div class="col-md-12">
                <div class="row">
                    
                    <div class="col-md-12 text-center">
                        <img src="<?=base_url().$profile[0]['image']?>" alt="No Pictures set" width="100" height="100">
                    </div>

                    <div class="col-md-4"></div>

                    <div class="col-md-4 text-center">
                        <hr>
                        <input type="file" name="upload" class="form-control">
                    </div>

                    <div class="col-md-4"></div>
                    
                    <div class="col-md-6">
                        <hr>
                        <label for="">First Name :</label>
                        <div class="input-group date">
                            <input type="text" name="first_name" class="form-control" value="<?=$profile[0]['first_name']?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Last Name :</label>
                        <div class="input-group date">
                            <input type="text" name="last_name" class="form-control" value="<?=$profile[0]['last_name']?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Email :</label>
                        <div class="input-group date">
                            <input type="email" name="email" class="form-control" value="<?=$profile[0]['email']?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Password :</label>
                        <div class="input-group date">
                            <input type="password" name="password" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <p style="color: red; font-style: italic;">* Kosongkan jika password tidak akan di update</p>
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