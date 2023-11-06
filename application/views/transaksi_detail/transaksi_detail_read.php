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
        <h2 style="margin-top:0px">Transaksi_detail Read</h2>
        <table class="table">
	    <tr><td>Keys</td><td><?php echo $keys; ?></td></tr>
	    <tr><td>Obat</td><td><?php echo $obat; ?></td></tr>
	    <tr><td>Modal</td><td><?php echo $modal; ?></td></tr>
	    <tr><td>Jual</td><td><?php echo $jual; ?></td></tr>
	    <tr><td>Diskon</td><td><?php echo $diskon; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('transaksi_detail') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>