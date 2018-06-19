<?php echo $header; ?>
<div class="container">
   <div class="row">
      <div id="content" class="col-sm-12" style="padding-top: 4%;min-height: 0px;">
         <div class="row">
            <div class="col-sm-6-login col-md-offset-3">
               <div class="row">
                  <div class="well-login">
                     <div class="text-center bmt-b">
                        <div class="bmt-logo">
                           <a href="<?php echo $link_logo; ?>" ><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive"  /> </a>
                        </div>
                     </div>
					 <?php if ($error_warning) { ?>
					<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					</div>
					<?php } ?>
                     <h2 class="text-center h2-login"><strong><?php echo $text_returning_customer; ?></strong></h2>
                     <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group wrap-inputacc">
                           <input type="text" name="username" value="<?php echo $username; ?>" id="input-username" class="form-control" autofocus required/>
                           <span class="focus-inputacc" data-placeholder="<?php echo $entry_user; ?>"></span>
                        </div>
                        <div class="form-group pls-login wrap-inputacc">
                           <span class="btn-show-acc" onclick="DEcrypte()"><i class="fa fa-eye"></i></span>
                           <input type="password" name="password" value="<?php echo $password; ?>" id="input-password" class="form-control" required/>
                           <span class="focus-inputacc" data-placeholder="<?php echo $entry_password; ?>"></span>
                        </div>
                        <div class="row-rememberme">
                           <label>
                           <input type="checkbox" checked="checked" name="remember"> Remember me
                           </label>
                        </div>
                        <input type="submit" value="<?php echo 'Login'; ?>" class="btn btn-primary btn-lg submit-bmt-regis"/><br>
                     </form>
                        <a href="<?php echo $forgotten; ?>"><p class="text-center pls-login"><?php echo $text_forgotten; ?></p></a>
                        <p class="text-center pls-login"><?php echo $text_register_account; ?></p>
                  </div>
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

