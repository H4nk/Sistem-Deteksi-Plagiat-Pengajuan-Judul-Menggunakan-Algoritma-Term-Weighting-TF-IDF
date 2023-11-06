 <div class="cart-page">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">SHOPPING CART : </span> <?= $this->session->userdata('idtransaksi');?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="cart-box">
<?php 	$this->db->where('keys',$this->session->userdata('idtransaksi'));
		$q= $this->db->get('transaksi_temp');
		foreach($q->result_array() as $t){?>
<div class="row wish-item">
          <div class="col s12">
            <div class="wish-box">
              <div class="wi-img">
                <div class="wi-img-product">
                  <img src="<?= base_url('uploads');?>/<?= $this->Db_model->get_data($t['obat'],'foto','obat');?>" alt="product">
                </div>
              </div>
              <div class="wi-name">
                <div class="win-top">
                  <div class="win-title"><?= $this->Db_model->get_data($t['obat'],'nama','obat');?></div>
                  <div class="win-price"><?= rupiah($t['jual']);?></div>
                </div>
              </div>
              <div class="wi-remove">
                <a href="<?= site_url('mobile/Home/hapus/'.$t['id'].'');?>"><i class="far fa-times-circle"></i></a>
              </div>
              <div class="clear"></div>
            </div>
          </div>
        </div>
		<?php } ?>
          
            <!-- end item--></div>
          <div class="checkout-payable">
            <div class="cart-cp cart-total">
              <div class="cp-left">Total</div>
              <div class="cp-right"><?= rupiah($this->Db_model->total());?> </div>
            </div>
            <div class="cart-cp cart-discount">
              <div class="cp-left">Discount</div>
              <div class="cp-right"><?= rupiah($this->Db_model->total_diskon());?></div>
            </div>

            <div class="cart-cp cart-total-payable">
              <div class="cp-left">Total Pembayaran</div>
              <div class="cp-right"><?= rupiah($tt = $this->Db_model->total()-$this->Db_model->total_diskon());?></div>
            </div>
          </div>
          <a href="<?= site_url('mobile/Home/checkout/'.$tt.'');?>" class="btn button-add-cart checkout-button">Checkout <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>