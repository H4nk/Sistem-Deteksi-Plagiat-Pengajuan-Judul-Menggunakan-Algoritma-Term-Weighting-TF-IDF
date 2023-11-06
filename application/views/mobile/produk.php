<div class="main-slider" data-indicators="true">
  <div class="carousel carousel-slider " data-indicators="true">
    <a class="carousel-item"><img src="<?= base_url('mobile');?>/img/header1.png" alt="slider"></a>
    <a class="carousel-item"><img src="<?= base_url('mobile');?>/img/header2.png" alt="slider"></a>
  </div>
</div>

<div class="section product-item">
    <div class="container">
      <div class="row row-title">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">OUR</span> PRODUCTS
          </div>
        </div>
      </div>
      <div class="row row-no-margin">
	<?php $q= $this->db->get('obat');
	foreach($q->result_array() as $t) {?>
	  <div>
          <div class="col s6 m4 l3 col-produc">
            <div class="box-product">
                <div class="bp-top">
                  <div class="product-list-img">
                    <div class="pli-one">
                      <div class="pli-two">
                        <img src="<?= base_url('uploads');?>/<?= $t['foto'];?>" alt="img">
                      </div>
                    </div>
                  </div>
                  <h5><a href="#"><?= $t['nama'];?></a></h5>
                  <div class="price">
                  <?= rupiah($t['jual']);?>
                  </div>
                </div>
                <div class="bp-bottom">
                  <a href="<?= site_url('mobile/Home/beli/'.$t['id'].'');?>" class="btn button-add-cart">Beli</a>
                </div>
              </div>
          </div>
        </div>

       
	<?php } ?>
        
        
       
       
        
        </div>
    </div>
  </div>