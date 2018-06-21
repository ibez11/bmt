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
                              <div class="pull-right"><a href="<?php echo 'merchant/add'; ?>" data-toggle="tooltip" title="<?php echo 'Add'; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                 
                              </div>
                              <h1><?php echo $heading_title; ?></h1>
                           </div>
                        </div>
                        <div class="container-fluid">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $h3; ?></h3>
                              </div>
                              <div class="panel-body">
                                 <form action="<?php echo ''; ?>" method="post" enctype="multipart/form-data" id="form-merchant">
                                    <div class="table-responsive">
                                       <table class="table table-bordered table-hover">
                                          <thead>
                                             <tr>
                                                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                                <td class="text-left"><?php echo 'Kode'; ?></td>
                                                <td class="text-left"><?php if ($sort == 'name') { ?>
                                                   <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Nama'; ?></a>
                                                   <?php } else { ?>
                                                   <a href="<?php echo $sort_name; ?>"><?php echo 'Nama'; ?></a>
                                                   <?php } ?>
                                                </td>
                                                <td class="text-left"><?php if ($sort == 'ref_parent_id') { ?>
                                                   <a href="<?php echo $sort_parent_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Cabang'; ?></a>
                                                   <?php } else { ?>
                                                   <a href="<?php echo $sort_parent_id; ?>"><?php echo 'Cabang'; ?></a>
                                                   <?php } ?>
                                                </td>
                                                <td class="text-left"><?php if ($sort == 'added_by') { ?>
                                                   <a href="<?php echo $sort_added_by; ?>" class="<?php echo strtolower($order); ?>"><?php echo 'Dibuat'; ?></a>
                                                   <?php } else { ?>
                                                   <a href="<?php echo $sort_added_by; ?>"><?php echo 'Dibuat'; ?></a>
                                                   <?php } ?>
                                                </td>
                                                <td class="text-left"><?php echo 'Status'; ?></td>
                                                <td class="text-left"><?php echo 'Date Added'; ?></td>
                                                <td class="text-center"><?php echo 'Action'; ?></td>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <?php if ($cashiers) { ?>
                                             <?php foreach ($cashiers as $cashier) { ?>
                                             <tr>
                                                <td class="text-center"><?php if (in_array($cashier['cashier_id'], $selected)) { ?>
                                                   <input type="checkbox" name="selected[]" value="<?php echo $cashier['cashier_id']; ?>" checked="checked" />
                                                   <?php } else { ?>
                                                   <input type="checkbox" name="selected[]" value="<?php echo $cashier['cashier_id']; ?>" />
                                                   <?php } ?>
                                                </td>
                                                <td class="text-left"><?php echo $cashier['code_cashier']; ?></td>
                                                <td class="text-left"><?php echo $cashier['name']; ?></td>
                                                <td class="text-left"><?php echo $cashier['parent_name']; ?></td>
                                                <td class="text-left"><?php echo $cashier['added_by_name']; ?></td>
                                                <td class="text-left"><?php echo $cashier['status']; ?></td>
                                                <td class="text-left"><?php echo $cashier['date_added']; ?></td>
                                                <td class="text-center"><a href="<?php echo $cashier['edit']; ?>" data-toggle="tooltip" title="<?php echo 'Edit'; ?>" class="btn btn-primary">Edit</a></td>
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

