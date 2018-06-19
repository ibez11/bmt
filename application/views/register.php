<?php echo $header; ?>
<head>
<meta name="description" content="Daftar & Jualan di Niaga Monster">
</head>
<br />
<div class="container">
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row">
    <div id="content" class="col-sm-12">
    <div class="row">
        <div class="set-place-accountlog">
        <div class="hidden-xs hidden-sm col-md-5">
            <div class="row">
                <img class="img-responsive image-lefside-acc" src="<?=base_url();?>assets/image/_default_background.jpg" title="accountregis" alt="account regis bmt">
            </div>
        </div>
        
        <div class="col-xs-12 col-md-7">
            <div class="row">
        <div class="row-fluid bmt-b10">
            <div class="text-center bmt-b">
                <div class="bmt-logo">
                    <a href="<?php echo $link_logo; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive"  /> </a>
                </div>
            </div>
            <h2 class="text-center h2-login"><strong><?php echo $heading_title; ?></strong></h2>
            <p class="text-center pls-login"><?php echo $text_account_already; ?></p>
        </div>
            
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset id="account">
          <legend><?php echo $text_your_details; ?></legend>
          <div class="form-group required wrap-inputacc">

              <input type="text" name="fullname" value="<?php echo $fullname; ?>" id="input-firstname" class="form-control" autofocus required/>
                <span class="focus-inputacc" data-placeholder="<?php echo $entry_fullname; ?>"></span>

              <?php if ($error_fullname) { ?>
              <div class="text-danger"><?php echo $error_fullname; ?></div>
              <?php } ?>
          </div>
          <div class="form-group required wrap-inputacc">

              <input type="text" name="username" value="<?php echo $username; ?>" id="input-username" class="form-control" autofocus required/>
                <span class="focus-inputacc" data-placeholder="<?php echo $entry_username; ?>"></span>
              <?php if ($error_username) { ?>
              <div class="text-danger"><?php echo $error_username; ?></div>
              <?php } ?>
          </div>
          <div class="form-group required wrap-inputacc">
              <input type="email" name="email" value="<?php echo $email; ?>" id="input-email" class="form-control" required/>
                <span class="focus-inputacc" data-placeholder="<?php echo $entry_email; ?>"></span>

              <?php if ($error_email) { ?>
              <div class="text-danger"><?php echo $error_email; ?></div>
              <?php } ?>
          </div>
          <div class="form-group required wrap-inputacc">
              <input type="tel" name="telephone" value="<?php echo $telephone; ?>" id="input-telephone" class="form-control" required/>
                <span class="focus-inputacc" data-placeholder="<?php echo $entry_telephone; ?>"></span>
              <?php if ($error_telephone) { ?>
              <div class="text-danger"><?php echo $error_telephone; ?></div>
              <?php } ?>
          </div>

          <div class="form-group required product-chooser">
            <label class="lgender">Gender</label>
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                        <div class="product-chooser-item selected">
                            <img class="img-responsive margin-aligner" src="https://www.monsterstatic.com/cache/default_image_profile-100x100.png">
                            <label class="radio-inline">
                              <input type="radio" name="gender" value="1" <?php echo $gender_male; ?> />
                            </label>
                        </div>
                        <div class="name-gender">
                            <div class="text-center"><?php echo $text_male; ?></div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                        <div class="product-chooser-item">
                            <img class="img-responsive margin-aligner" src="https://www.monsterstatic.com/cache/default_image_profile-100x100.png">
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="2" <?php echo $gender_female; ?>/>
                                <?php echo $text_female; ?>
                            </label>
                        </div>
                        <div class="name-gender">
                            <div class="text-center"><?php echo $text_female; ?></div>
                        </div>
                    </div>
                  <?php if ($error_gender) { ?>
                  <div class="text-danger"><?php echo $error_gender; ?></div>
                  <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group required wrap-inputacc">
                <span class="btn-show-acc" onclick="DEcrypte()"><i class="fa fa-eye"></i></span>
                    <input type="password" name="password" value="<?php echo $password; ?>" id="input-password" class="form-control" required/>
                <span class="focus-inputacc" data-placeholder="<?php echo $entry_password; ?>"></span>
            <?php if ($error_password) { ?>
            <div class="text-danger"><?php echo $error_password; ?></div>
            <?php } ?>
          </div>
        </fieldset>
        
        
        <legend></legend>
        <div class="buttons">
            <input type="submit" value="<?php echo $button_continue_register; ?>" class="btn btn-primary btn-lg submit-niagamonster-regis" />
        </div>

      </form>
      </div>
      </div>

      </div>
      </div>
     </div>
</div>
<script>
function DEcrypte() {
    var x = document.getElementById("input-password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
} 
</script>

<?php
?>

