<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA OBAT</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Kode <?php echo form_error('kode') ?></td><td><input type="text" class="form-control" name="kode" id="kode" placeholder="Kode" value="<?php echo $kode; ?>" /></td></tr>
	    <tr><td width='200'>Nama <?php echo form_error('nama') ?></td><td><input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" /></td></tr>
	    <tr><td width='200'>Kategori <?php echo form_error('kategori') ?></td><td><?php echo cmb_dinamis('kategori', 'kategori_obat', 'ket', 'id') ?></td></tr>
	    <tr><td width='200'>Keterangan <?php echo form_error('keterangan') ?></td><td><input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" /></td></tr>
	    <tr><td width='200'>Modal <?php echo form_error('modal') ?></td><td><input type="number" class="form-control" name="modal" id="modal" placeholder="Modal" value="<?php echo $modal; ?>" /></td></tr>
	    <tr><td width='200'>Jual <?php echo form_error('jual') ?></td><td><input type="number" class="form-control" name="jual" id="jual" placeholder="Jual" value="<?php echo $jual; ?>" /></td></tr>	
		<tr><td width='200'>diskon <?php echo form_error('diskon') ?></td><td><input type="number" class="form-control" name="diskon" id="diskon" placeholder="diskon" value="<?php echo $diskon; ?>" /></td></tr>
	    <tr><td width='200'>Foto <?php echo form_error('foto') ?></td><td><input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('obat') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>