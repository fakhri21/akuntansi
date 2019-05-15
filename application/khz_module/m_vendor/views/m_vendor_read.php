<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">M_vendor Read</h2>
        <table class="table">
	    <tr><td>Id Vendor</td><td><?php echo $id_vendor; ?></td></tr>
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>No Telp</td><td><?php echo $no_telp; ?></td></tr>
	    <tr><td>Whatsapp</td><td><?php echo $whatsapp; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('m_vendor') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>