<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<?php $current_user = wp_get_current_user(); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/selectize.default.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/custom.css">
  <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap-datepicker3.css" rel="stylesheet">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/AdminLTE/dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


</head>

<body class="bg-light h-100-p">
  <?php get_header(); ?>
 
 
 <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url(); ?>assets/Jquery/jquery-3.2.1.min.js"></script>
  <!-- Jquery -->
  <script src="<?php echo base_url();?>assets/Jquery/currencyFormatter.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/cleave.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/js/numeral.js" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url();?>assets/js/selectize.js" type="text/javascript"></script>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>
<section class="content">
	<div id="primary col" <?php astra_primary_class(); ?>>
		        <div class="row">
              <?php echo $contents; ?>
            </div>

	</div><!-- #primary -->
</section>
<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>


<script>
  var base_url="<?php echo base_url(); ?>"
</script>
          
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"></script>
  
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/bootstrap/js/bootstrap.min.js"></script>

<!-- CUSTOM JS -->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<!-- SPARKLINE -->
<script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/AdminLTE/dist/js/app.min.js"></script>
<script type="text/javascript">

</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

</body>
</html>
