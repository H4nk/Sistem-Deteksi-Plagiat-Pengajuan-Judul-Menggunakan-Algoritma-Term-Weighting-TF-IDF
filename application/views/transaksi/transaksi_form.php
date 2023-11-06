<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TRANSAKSI</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>' >       

	    <tr><td width='200'>No Transaksi <?php echo form_error('keys') ?></td><td><input readonly type="text" class="form-control" name="keys" id="keys" placeholder="keys" value="<?php echo $keys; ?>" /></td></tr>	 
		<tr><td width='200'>Total <?php echo form_error('total') ?></td><td><input readonly type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" /></td></tr>
	    <tr><td width='200'>Nama Pelanggan <?php echo form_error('user') ?></td><td><input readonly type="text" class="form-control" name="user" id="user" placeholder="User" value="<?php echo $this->Db_model->get_data($user,'nama','pelanggan') ?>" /></td></tr>	
		<tr><td width='200'>Alamat Pelanggan <?php echo form_error('user') ?></td><td><input readonly type="text" class="form-control" name="user" id="user" placeholder="User" value="<?php echo $this->Db_model->get_data($user,'alamat','pelanggan') ?>" /></td></tr>
	    <tr><td width='200'>Status Transaksi <?php echo form_error('st') ?></td><td><?php echo cmb_dinamis('st', 'st', 'ket', 'id') ?></td></tr>

	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('transaksi') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>