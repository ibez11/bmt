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
                              <div class="pull-right"><a href="<?php echo '/merchant'; ?>" data-toggle="tooltip" title="<?php echo 'Add'; ?>" class="btn btn-primary"><i class="fa fa-reply"></i></a>
                                 
                              </div>
                              <h1><?php echo $heading_title; ?></h1>
                           </div>
                        </div>
                        <div class="container-fluid">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
                              </div>
                              <div class="panel-body">
                                 <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-merchant" class="form-horizontal">
                                     <div class="tab-content">
                                        <div class="form-group required">
                                            <label class="col-sm-2 control-label" for="input-username"><?php echo 'Username'; ?></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo 'Masukkan Username'; ?>" id="input-username" class="form-control" required="true" />
                                              <?php if (isset($error_username)) { ?>
                                              <div class="text-danger"><?php echo $error_username; ?></div>
                                              <?php } ?>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-password"><?php echo 'Password'; ?></label>
                                           <div class="col-sm-10">
                                             <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo 'Masukkan Pasword'; ?>" id="input-password" class="form-control" required="true"/>
                                             <?php if (isset($error_password)) { ?>
                                             <div class="text-danger"><?php echo $error_password; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-name"><?php echo 'Email'; ?></label>
                                           <div class="col-sm-10">
                                             <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo 'Masukkan Email'; ?>" id="input-email" class="form-control" required="true"/>
                                             <?php if (isset($error_email)) { ?>
                                             <div class="text-danger"><?php echo $error_email; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-name"><?php echo 'Nama'; ?></label>
                                           <div class="col-sm-10">
                                             <input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo 'Masukkan Nama'; ?>" id="input-name" class="form-control" required="true"/>
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
                                           <label class="col-sm-2 control-label" for="input-b-e-id"><?php echo 'Bentuk Badan Usaha'; ?></label>
                                           <div class="col-sm-10">
                                                <select name="b_e_id" id="input-b-e-id" class="form-control">
                                                    <option value="" selected="selected">--Please Select--</option>
                                                    <?php foreach ($business_entities as $business_entity) { ?>
                                                    <?php if ($business_entity['b_e_id'] == $b_e_id) { ?>
                                                    <option value="<?php echo $business_entity['b_e_id']; ?>" selected="selected"><?php echo $business_entity['name']; ?></option>
                                                    <?php } else { ?>
                                                    <option value="<?php echo $business_entity['b_e_id']; ?>"><?php echo $business_entity['name']; ?></option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                             <?php if (isset($error_b_e)) { ?>
                                             <div class="text-danger"><?php echo $error_b_e; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-mdr"><?php echo 'Pengaturan MDR'; ?></label>
                                           <div class="col-sm-4">
                                                <input type="text" name="mdr[]" value="<?php echo $mdr_money; ?>" placeholder="<?php echo 'Masukkan Rupiah'; ?>" id="input-mdr-amount" class="form-control" />
                                             <?php if (isset($error_b_e)) { ?>
                                             <div class="text-danger"><?php echo $error_b_e; ?></div>
                                             <?php } ?>
                                           </div>
                                           <label class="col-sm-2 text-center" ><?php echo 'ATAU'; ?></label>
                                           <div class="col-sm-4">
                                               <input type="text" name="mdr[]" value="<?php echo $mdr_percent; ?>" placeholder="<?php echo 'Masukkan Persentase'; ?>" id="input-mdr-persen" class="form-control" />
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-b-fi"><?php echo 'Bidang Usaha'; ?></label>
                                           <div class="col-sm-10">
                                                <input type="text" name="b_fi" value="<?php echo $b_fi; ?>" placeholder="<?php echo 'Masukkan Bidang Usaha'; ?>" id="input-b-fi" class="form-control" />
                                             <?php if (isset($error_b_fi)) { ?>
                                             <div class="text-danger"><?php echo $error_b_fi; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-t-o-b"><?php echo 'Jenis Usaha'; ?></label>
                                           <div class="col-sm-10">
                                            <select name="t_o_b" id="input-t-o-b" class="form-control" onchange="FunctionTOB(this)" required="true">
                                                <option value="" selected="selected">--Please Select--</option>
                                                <?php if ( $t_o_b ==  1) { ?>
                                                <option value="1" selected><?php echo 'Online'; ?></option>
                                                <option value="2" ><?php echo 'Offline'; ?></option>
                                                <?php } else if ( $t_o_b ==  2) { ?>
                                                <option value="1" ><?php echo 'Online'; ?></option>
                                                <option value="2" selected><?php echo 'Offline'; ?></option>
                                                <?php } else { ?>
                                                <option value="1" ><?php echo 'Online'; ?></option>
                                                <option value="2" ><?php echo 'Offline'; ?></option>
                                                <?php } ?>
                                            </select>
                                             <?php if (isset($error_t_o_b)) { ?>
                                             <div class="text-danger"><?php echo $error_t_o_b; ?></div>
                                             <?php } ?>
                                           </div>
                                          </div>
                                        <div id="t_o_b_online" <?php echo ($t_o_b > 0) ? '' : 'style="display: none;"' ?>>
                                            <div class="form-group " >
                                                <label class="col-sm-2 control-label" for="input-t-o-b"><?php echo ' '; ?></label>
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <input type="text" name="online[website][]" value="<?php echo $online_website; ?>" placeholder="<?php echo 'Masukkan Website'; ?>"  class="form-control" />
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <input type="text" name="online[instagram][]" value="<?php echo $online_instagram; ?>" placeholder="<?php echo 'Masukkan Instagram'; ?>"  class="form-control" />
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <input type="text" name="online[bbm][]" value="<?php echo $online_bbm; ?>" placeholder="<?php echo 'Masukkan BBM'; ?>"  class="form-control" />
                                                </div>

                                            </div>
                                            <div class="form-group " >
                                                <label class="col-sm-2 control-label" for="input-t-o-b"><?php echo ' '; ?></label>
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <input type="text" name="online[twitter][]" value="<?php echo $online_twitter; ?>" placeholder="<?php echo 'Masukkan Twitter'; ?>"  class="form-control" />
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <input type="text" name="online[facebook][]" value="<?php echo $online_facebook; ?>" placeholder="<?php echo 'Masukkan Facebook'; ?>"  class="form-control" />
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <input type="text" name="online[kaskus][]" value="<?php echo $online_kaskus; ?>" placeholder="<?php echo 'Masukkan Kaskus'; ?>"  class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div id="t_o_b_offline" style="display: none;">
                                            <div class="form-group " >
                                                <label class="col-sm-2 control-label" for="input-t-o-b"><?php echo ' '; ?></label>
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <input type="text" name="offline" value="" placeholder="<?php echo 'Masukkan Tipe Usaha'; ?>"  class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-b-fi"><?php echo 'Logo toko'; ?></label>
                                           <div class="col-sm-10">
                                                <div class="col-sm-8 new-img-thumbnail-1" style="cursor: pointer;" id="upload-thumb-image-logo">
                                                    <img src="<?php echo $thumb; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" />
                                                    <input type="hidden" name="shop_logo" value="<?php echo $shop_logo; ?>" id="input-image" />
                                                </div>
                                             <?php if (isset($error_shop_logo)) { ?>
                                             <div class="text-danger"><?php echo $error_shop_logo; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-b-fi"><?php echo 'Dokumen Kerjasama'; ?></label>
                                           <div class="col-sm-10">
                                                <div class="col-sm-8 new-img-thumbnail-1" style="cursor: pointer;" id="upload-document-cooperation">
                                                    <img src="<?php echo $document_cooperation_path; ?>" alt="" title="" data-placeholder="<?php echo $placeholderdoc; ?>" />
                                                    <input type="hidden" name="document_cooperation" value="<?php echo $document_cooperation; ?>" id="input-document-cooperation" />
                                                </div>
                                             <?php if (isset($error_b_fi)) { ?>
                                             <div class="text-danger"><?php echo $error_b_fi; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-n-p-i-c"><?php echo 'Nama Penanggung jawab'; ?></label>
                                           <div class="col-sm-10">
                                                <input type="text" name="n_p_i_c" value="<?php echo $n_p_i_c; ?>" placeholder="<?php echo 'Masukkan Nama Penanggung jawab'; ?>" id="input-n-p-i-c" class="form-control" />
                                                
                                             <?php if (isset($error_b_fi)) { ?>
                                             <div class="text-danger"><?php echo $error_b_fi; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-identity-responsible"><?php echo 'Identitas penanggung jawab'; ?></label>
                                           <div class="col-sm-10">
                                                <input type="text" name="identity_responsible" value="<?php echo $identity_responsible; ?>" placeholder="<?php echo 'Masukkan Identitas penanggung jawab'; ?>" id="input-identity-responsible" class="form-control" />
                                             <?php if (isset($error_b_fi)) { ?>
                                             <div class="text-danger"><?php echo $error_b_fi; ?></div>
                                             <?php } ?>
                                           </div>
                                        </div>
                                        <div class="form-group required">
                                           <label class="col-sm-2 control-label" for="input-identity-number"><?php echo 'Nomor Identitas'; ?></label>
                                           <div class="col-sm-10">
                                                <input type="text" name="identity_number" value="<?php echo $identity_number; ?>" placeholder="<?php echo 'Masukkan Nomor Identitas'; ?>" id="input-identity-number" class="form-control" />
                                             <?php if (isset($error_b_fi)) { ?>
                                             <div class="text-danger"><?php echo $error_b_fi; ?></div>
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
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript"><!--
$('#upload-thumb-image-logo').on('click', function(event){
    event.preventDefault();
    $('#form-upload').remove();

    $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" value="" /></form>');

    $('#form-upload input[name=\'file\']').trigger('click');

    if (typeof timer != 'undefined') {
    clearInterval(timer);
    }

    timer = setInterval(function() {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                    clearInterval(timer);
                    $.ajax({
                            url: '<?php echo site_url("common/filemanager"); ?>/upload_image?directory=<?php echo $directory; ?>'+'user_id='+<?php echo $get_id; ?>,
                            type: 'post',		
                            dataType: 'json',
                            data: new FormData($('#form-upload')[0]),
                            cache: false,
                            contentType: false,
                            processData: false,		
                            beforeSend: function() {
//					$('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
//					$('#button-upload').prop('disabled', true);
                            },
                            complete: function() {
//					$('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
//					$('#button-upload').prop('disabled', false);
                            },
                            success: function(json) {
                                    if (json['error']) {
                                        alert(json['error']);
                                    }

                                    if (json['success']) {
                                        $("#upload-thumb-image-logo").html('<img src="'+json['filename']+'" alt="" title="" data-placeholder="'+json['filename']+'" /><input type="hidden" name="shop_logo" value="'+json['path']+'" id="input-image" />');
                                    }
                            },			
                            error: function(xhr, ajaxOptions, thrownError) {
                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                    });	
            }
    }, 500);
});
$('#upload-document-cooperation').on('click', function(event){
    event.preventDefault();
    $('#form-upload').remove();

    $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" value="" /></form>');

    $('#form-upload input[name=\'file\']').trigger('click');

    if (typeof timer != 'undefined') {
    clearInterval(timer);
    }

    timer = setInterval(function() {
            if ($('#form-upload input[name=\'file\']').val() != '') {
                    clearInterval(timer);
                    $.ajax({
                            url: '<?php echo site_url("common/filemanager"); ?>/upload_document?directory=<?php echo $directory; ?>'+'user_id='+<?php echo $get_id; ?>,
                            type: 'post',		
                            dataType: 'json',
                            data: new FormData($('#form-upload')[0]),
                            cache: false,
                            contentType: false,
                            processData: false,		
                            beforeSend: function() {
//					$('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
//					$('#button-upload').prop('disabled', true);
                            },
                            complete: function() {
//					$('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
//					$('#button-upload').prop('disabled', false);
                            },
                            success: function(json) {
                                    if (json['error']) {
                                        alert(json['error']);
                                    }

                                    if (json['success']) {
                                        $("#upload-document-cooperation").html('<img src="'+json['ext']+'" alt="" title="" data-placeholder="'+json['ext']+'" /><input type="hidden" name="document_cooperation" value="'+json['path']+'" id="input-image" />');
                                        
                                    }
                            },			
                            error: function(xhr, ajaxOptions, thrownError) {
                                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                    });	
            }
    }, 500);
});
function FunctionTOB() {
    var x = $('#input-t-o-b').val();
    if(x == 1) {
        $('#t_o_b_online').show();
        $('#t_o_b_offline').hide();
    } else {
        $('#t_o_b_online').hide();
        $('#t_o_b_offline').show();
    }
}
//--></script>
<?php
   echo $footer;?>

