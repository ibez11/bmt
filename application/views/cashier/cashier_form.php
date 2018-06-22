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
                              <div class="pull-right"><a href="<?php echo '/cashier'; ?>" data-toggle="tooltip" title="<?php echo 'Add'; ?>" class="btn btn-primary"><i class="fa fa-reply"></i></a>
                                 
                              </div>
                              <h1><?php echo $heading_title; ?></h1>
                           </div>
                        </div>
                        <div class="container-fluid">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
                              </div>
                                <?php if ($error_warning) { ?>
                                <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                </div>
                                <?php } ?>
                              <div class="panel-body">
                                 <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-merchant" class="form-horizontal">
                                     <div class="tab-content">
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-merchant"><?php echo 'Nama Merchant'; ?></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="merchant" value="<?php echo $merchant; ?>" placeholder="<?php echo 'Masukkan Nama Merchant'; ?>" id="input-merchant" class="form-control" required="true" />
                                                <input type="text" name="merchant_id" value="<?php echo $merchant_id; ?>" id="input-merchant-id" class="form-control" style="display:none" />
                                              <?php if (isset($error_merchant)) { ?>
                                              <div class="text-danger"><?php echo $error_merchant; ?></div>
                                              <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-name"><?php echo 'Nama'; ?></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo 'Masukkan Nama'; ?>" id="input-name" class="form-control" required="true" />
                                              <?php if (isset($error_name)) { ?>
                                              <div class="text-danger"><?php echo $error_name; ?></div>
                                              <?php } ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-address"><?php echo 'Alamat'; ?></label>
                                           <div class="col-sm-10">
                                             <input type="text" name="address" value="<?php echo $address; ?>" placeholder="<?php echo 'Masukkan Alamat'; ?>" id="input-address" class="form-control" />
                                             <?php if (isset($error_address)) { ?>
                                             <div class="text-danger"><?php echo $error_address; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-t-o-b"><?php echo 'Status'; ?></label>
                                           <div class="col-sm-10">
                                            <select name="status" id="input-t-o-b" class="form-control" onchange="FunctionTOB(this)" required="true">
                                                <option value="" selected="selected">--Please Select--</option>
                                                <?php if ( $status ==  1) { ?>
                                                <option value="1" selected><?php echo 'Enable'; ?></option>
                                                <option value="2" ><?php echo 'Disable'; ?></option>
                                                <?php } else if ( $status ==  2) { ?>
                                                <option value="1" ><?php echo 'Enable'; ?></option>
                                                <option value="2" selected><?php echo 'Disable'; ?></option>
                                                <?php } else { ?>
                                                <option value="1" ><?php echo 'Enable'; ?></option>
                                                <option value="2" ><?php echo 'Disable'; ?></option>
                                                <?php } ?>
                                            </select>
                                             <?php if (isset($error_t_o_b)) { ?>
                                             <div class="text-danger"><?php echo $error_t_o_b; ?></div>
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
<!-- Script -->
<script src="<?=base_url();?>assets/js/jquery/jquery-2.1.1.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript"><!--
// Find merchant

$('input[name=\'merchant\']').autocomplete({
    
    'source': function(request, response) {
        $.ajax({
                url: '/promo/autocomplete?merchant_name=' +  encodeURIComponent(request.term),
                dataType: 'json',
                success: function(json) {
                    
                    response($.map(json, function(item) {
                        return {
                            label: item['name'] + '('+ item['username'] + ')',
                            value: item['name'],
                            id: item['user_id']
                        }
                    }));
                }
        });
    },
    'select': function(event, ui) {
//        console.log(ui);
//        console.log(ui);
//        var label_object = fullObj.name + '('+ fullObj.username + ')';
//        console.log(label_object);
//        if(fullObj.)
        $("#input-merchant-id").val(ui.item.id);
//        $('input[name=\'merchant\']').val(ui.item.label);
    }
});

//--></script>
<?php
   echo $footer;?>

