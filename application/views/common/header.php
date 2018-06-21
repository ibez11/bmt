<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" xmlns="http://www.w3.org/1999/xhtml">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="generator" content="BMT">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#fff">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if($url_login) { ?>
<script src="<?=base_url();?>assets/js/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<link href="<?=base_url();?>assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="<?=base_url();?>assets/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="<?=base_url();?>assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Roboto:400,400i,300,700,500" rel="stylesheet" type="text/css"/>
<link href="<?=base_url();?>assets/css/stylesheet.css" rel="stylesheet">
<?php } else { ?>
<link rel="stylesheet" href="<?=base_url();?>assets/css/app.v1.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url();?>assets/js/calendar/bootstrap_calendar.css" type="text/css" />
<?php } ?>

<?php if($url_login) { ?>
<script type="text/javascript">
$(function(){
	$('div.product-chooser').not('.disabled').find('div.product-chooser-item').on('click', function(){
		$(this).parent().parent().find('div.product-chooser-item').removeClass('selected');
		$(this).addClass('selected');
		$(this).find('input[type="radio"]').prop("checked", true);
		
	});
});
</script>
<?php } ?>

</head>
<body class="common-home <?php echo (($url_login) ? "accounts-login" : "") ?>">
<?php if(!$url_login) { ?>
    <section>
   <section class="hbox stretch">
      <!-- .aside -->
      <aside class="bg-light aside-md hidden-print" id="nav">
         <section class="vbox">
            <section class="w-f scrollable">
               <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-color="#333333">
                  <div class="clearfix wrapper dk nav-user hidden-xs">
                     <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="thumb avatar pull-left m-r"> <img src="<?=base_url();?>assets/image/a0.jpg"> <i class="on md b-black"></i> </span> <span class="hidden-nav-xs clear"> <span class="block m-t-xs"> <strong class="font-bold text-lt"><?php echo $fullname; ?></strong> <b class="caret"></b> </span> <span class="text-muted text-xs block"><?php //print "$pkname Member"; ?></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                           <span class="arrow top hidden-nav-xs"></span>
                           <li> <a href="/profile">Profile</a> </li>
                           <li> <a href="#">Notifications </a> </li>
                           <li> <a href="#">Help</a> </li>
                           <li class="divider"></li>
                           <li> <a href="/logout" >Logout</a> </li>
                        </ul>
                     </div>
                  </div>
                  <?php echo $menu_left; ?>
               </div>
            </section>
            <footer class="footer hidden-xs no-padder text-center-nav-xs"> <a href="/logout" data-toggle="ajaxModal" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs"> <i class="i i-logout"></i> </a> <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs"> <i class="i i-circleleft text"></i> <i class="i i-circleright text-active"></i> </a> </footer>
         </section>
      </aside>
<?php } ?>
<?php if($url_login) { ?>
<script>
$(document).ready(function(){
    $('.form-control').each(function(){
        if($(this).val().trim() != "") {
            $(this).addClass('has-val');
        }
        else {
            $(this).removeClass('has-val');
        }
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
});
  </script>
<?php } ?>