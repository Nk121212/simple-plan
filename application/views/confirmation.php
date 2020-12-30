<!DOCTYPE html>
<html>
<head>
  <title>Confirmation Page</title>
</head>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/confirmation_style.css">

<body>

    <div class="container">

      <div class="row">

        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">

          <div class="card card-signin my-5">

            <div class="card-body">

              <h5 class="card-title text-center">Konfirmasi Akun</h5>

              <?=$this->session->flashdata('message')?>

              <hr class="my-4">

              <form class="form-signin" method="post" action="<?=base_url()?>auth/submit_confirmation">

                <div class="form-label-group">

                  <input type="email" id="email" name="email" class="form-control" placeholder="Input Email" required autofocus>
                  <label for="email">Email</label>

                </div>

                <div class="form-label-group">

                  <input type="text" id="otp" name="otp" class="form-control" placeholder="Input OTP" required>
                  <label for="otp">Insert OTP</label>

                </div>

                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Konfirmasi</button>

                <hr class="my-4">

              </form>

            </div>

          </div>

        </div>

      </div>

    </div>

  </body>
</html>