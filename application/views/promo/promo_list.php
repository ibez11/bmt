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
                              <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo 'Add'; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                 
                              </div>
                              <h1><?php echo $heading_title; ?></h1>
                           </div>
                        </div>
                        <div class="container-fluid">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo 'Promo Lists'; ?></h3>
                              </div>
                               
                              <div class="panel-body">
                                 <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-promo">
                                    <div class="table-responsive">
                                       <table class="table table-bordered table-hover">
                                          <thead>
                                             <tr>
                                                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                                <td class="text-left">
                                                   <?php echo 'Merchant Nama'; ?>
                                                </td>
                                                <td class="text-left"><?php if ($sort == 'u.name') { ?>
                                                   <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Name'; ?></a>
                                                   <?php } else { ?>
                                                   <a href="<?php echo $sort_name; ?>"><?php echo 'Nama'; ?></a>
                                                   <?php } ?>
                                                </td>
                                                <td class="text-left"><?php echo 'MDR'; ?>
                                                </td>
                                                
                                                <td class="text-left"><?php echo 'Mulai'; ?></td>
                                                <td class="text-left"><?php echo 'Akhir'; ?></td>
                                                <td class="text-center"><?php echo 'Status'; ?></td>
                                                <td class="text-center"><?php echo 'Action'; ?></td>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <?php if ($results_promo) { ?>
                                             <?php foreach ($results_promo as $promo) { ?>
                                              
                                             <tr>
                                                <td class="text-center"><?php if (in_array($promo['promo_id'], $selected)) { ?>
                                                   <input type="checkbox" name="selected[]" value="<?php echo $promo['promo_id']; ?>" checked="checked" />
                                                   <?php } else { ?>
                                                   <input type="checkbox" name="selected[]" value="<?php echo $promo['promo_id']; ?>" />
                                                   <?php } ?>
                                                </td>
                                                <td class="text-left"><?php echo $promo['merchant_fullname']; ?></td>
                                                <td class="text-left"><?php echo $promo['name']; ?></td>
                                                <td class="text-left"><?php echo ($promo['config_mdr_money_not_curr'] > 0) ? $promo['config_mdr_money'] : $promo['config_mdr_percentage']; ?></td>
                                                
                                                <td class="text-left"><?php echo $promo['start_date']; ?></td>
                                                <td class="text-left"><?php echo $promo['end_date']; ?></td>
                                                <td class="text-left"><?php echo $promo['status']; ?></td>
                                                <td class="text-center"><a href="<?php echo $promo['edit']; ?>" data-toggle="tooltip" title="<?php echo 'Edit'; ?>" class="btn btn-primary">Edit</a></td>
                                             </tr>
                                             <?php } ?>
                                             <?php } else { ?>
                                             <tr>
                                                <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                                             </tr>
                                             <?php } ?>
                                          </tbody>
                                       </table>
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

