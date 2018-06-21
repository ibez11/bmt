<?php
   echo $header;?>
     <!-- /.aside -->
      <section id="content">
         <section class="hbox stretch">
            <section>
               <section class="vbox">
                  <section class="scrollable padder">
                     <section class="row m-b-md">
                        <div class="col-sm-6">
                           <h3 class="m-b-xs text-black"><?php echo $heading_title; ?></h3>
                           <small><?php echo $welcome_back; ?>, <?php echo $fullname; ?>, <i class="fa fa-users fa-lg text-primary"></i> <?php echo $level ?></small> 
                        </div>
                        <div class="col-sm-6 text-right text-left-xs m-t-md">
                           <a href="#" class="btn btn-icon b-2x btn-default btn-rounded hover"><i class="i i-bars3 hover-rotate"></i></a> <a href="#nav, #sidebar" class="btn btn-icon b-2x btn-info btn-rounded" data-toggle="class:nav-xs, show"><i class="fa fa-bars"></i></a> 
                        </div>
                     </section>
                     <div class="row">
                        <div class="page-header">
                           <div class="container-fluid">
                              <div class="pull-right">
                              </div>
                              <h1><?php echo $heading_title; ?></h1>
                           </div>
                        </div>
                        <div class="container-fluid">
                           <div class="panel panel-default">
                              
                              <div class="panel-body">
                                 <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-profile" class="form-horizontal">
                                    <div class="table-responsive">
                                       <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-name"><?php echo 'Name'; ?></label>
                                           <div class="col-sm-10">
                                             <input type="text" name="fullname" value="<?php echo $name; ?>" placeholder="<?php echo 'Masukkan Nama'; ?>" id="input-name" class="form-control" required="true"/>
                                             <?php if (isset($error_name)) { ?>
                                             <div class="text-danger"><?php echo $error_name; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-password"><?php echo 'Password'; ?></label>
                                           <div class="col-sm-10">
                                             <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo 'Masukkan Password'; ?>" id="input-password" class="form-control" required="true"/>
                                             <?php if (isset($error_password)) { ?>
                                             <div class="text-danger"><?php echo $error_password; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-password"><?php echo 'Address'; ?></label>
                                           <div class="col-sm-10">
                                             <input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo 'Masukkan Address'; ?>" id="input-address" class="form-control" required="true"/>
                                             <?php if (isset($error_address)) { ?>
                                             <div class="text-danger"><?php echo $error_address; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="pull-right btn-back">
                                            <button type="submit" data-toggle="tooltip" title="<?php echo 'Save'; ?>" name="submit" class="btn btn-primary"><?php echo 'Save'; ?><i class="fa "></i></button>
                                        </div>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </section>
               </section>
            </section>
            <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 
         </section>
      </section>
   </section>
</section>
<?php
   echo $footer;?>

