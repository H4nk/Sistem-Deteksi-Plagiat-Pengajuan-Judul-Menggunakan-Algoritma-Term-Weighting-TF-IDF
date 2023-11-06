<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA BERITA</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Judul <?php echo form_error('judul') ?></td><td><input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" /></td></tr>
	    
        <tr><td width='200'>Isi <?php echo form_error('isi') ?></td><td> <textarea class="form-control" rows="3" name="isi" id="isi" placeholder="Isi"><?php echo $isi; ?></textarea></td></tr>
	    <tr><td width='200'>User <?php echo form_error('user') ?></td><td><input type="text" class="form-control" name="user" id="user" placeholder="User" value="<?php echo $user; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('berita') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>