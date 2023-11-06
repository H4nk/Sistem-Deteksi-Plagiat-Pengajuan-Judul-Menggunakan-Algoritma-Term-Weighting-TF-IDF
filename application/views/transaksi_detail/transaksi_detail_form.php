<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TRANSAKSI_DETAIL</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Keys <?php echo form_error('keys') ?></td><td><input type="text" class="form-control" name="keys" id="keys" placeholder="Keys" value="<?php echo $keys; ?>" /></td></tr>
	    <tr><td width='200'>Obat <?php echo form_error('obat') ?></td><td><input type="text" class="form-control" name="obat" id="obat" placeholder="Obat" value="<?php echo $obat; ?>" /></td></tr>
	    <tr><td width='200'>Modal <?php echo form_error('modal') ?></td><td><input type="text" class="form-control" name="modal" id="modal" placeholder="Modal" value="<?php echo $modal; ?>" /></td></tr>
	    <tr><td width='200'>Jual <?php echo form_error('jual') ?></td><td><input type="text" class="form-control" name="jual" id="jual" placeholder="Jual" value="<?php echo $jual; ?>" /></td></tr>
	    <tr><td width='200'>Diskon <?php echo form_error('diskon') ?></td><td><input type="text" class="form-control" name="diskon" id="diskon" placeholder="Diskon" value="<?php echo $diskon; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('transaksi_detail') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>