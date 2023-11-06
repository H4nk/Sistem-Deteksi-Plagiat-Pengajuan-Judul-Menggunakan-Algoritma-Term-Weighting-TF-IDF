<div class="section section_team">
    <div class="container">
      <div class="row row-title ">
        <div class="col s12">
          <div class="section-title row-title-team">
            <span class="theme-secondary-color">Daftar </span> Transaksi
          </div>
        </div>
      </div>
      <div class="row row-title ">
        <div class="col s12 center">
         Transaksi yang pernah dilakukan<br><br>
        </div>
      </div>
	  
	  <?php $this->db->where('user',$this->session->userdata('id_pelanggan'));
			$q= $this->db->get('transaksi');
			foreach($q->result_array() as $t){?>
      <div class="row row-team">
        <div class="col s12">
          <div class="wrap-team">

            <div class="wt-right">
              <div class="wtr-name">No : <?= $t['keys'];?></div>
              <div class="wtr-title">Total : <?= rupiah($t['total']);?></div>
              <div class="wtr-info"><?= $this->Db_model->get_data($t['st'],'ket','st');?></div>

            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
			<?php } ?>
</div>
  </div>