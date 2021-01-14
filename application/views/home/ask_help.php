
<div class="col-md-12 col-sm-4 ">
  <div class="x_panel tile">
    <div class="x_title">
      <h2>New | Ask For Help</h2>
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

        <form method="post" action="<?=base_url()?>ask_help/submit_purpose" enctype="multipart/form-data">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control" name="purpose" placeholder="Purpose Description"></textarea>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <label for="">Rating :</label>
                        <input type="text" name="rating" class="star-rating rating-loading" value="0" data-size="md" title="">
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
                        <a href="<?=base_url()?>ask_help/view_purpose" class="btn btn-outline-secondary">Preview Purpose</a>
                        <button type="submit" class="btn btn-outline-secondary">Create Purpose</button>
                    </div>              
                </div>
            </div>
            
        </form>

    </div>

  </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){

        $(".numericOnly").keypress(function (e) {
            if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
        });

        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });

        $('[data-toggle="tooltip"]').on("mouseleave", function(){
            $(this).tooltip("hide"); 
        })

    })
</script>