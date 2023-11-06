<ul id="nav-mobile-category" class="side-nav">
<?php if($this->session->userdata('logged_in')==TRUE){ ?>
  <li class="profile">
    <div class="li-profile-info">
      <h2><?= $this->Db_model->get_pelanggan('nama');?></h2>
      <div class="emailprofile"><?= $this->Db_model->get_pelanggan('email');?></div>

    </div>

  </li>
<?php } else { ?>
  <li class="profile">
    <div class="li-profile-info">
      <h2>anonymouse</h2>
   
    </div>

  </li>

<?php } ?>
  <li>
    <a class="waves-effect waves-blue" href="<?= site_url('mobile/Home');?>"><i class="fas fa-home"></i>Home</a>
  </li>
  
  <?php if($this->session->userdata('logged_in')==TRUE){ ?>

     <li>
    <ul class="collapsible collapsible-accordion">
      <li>
        <div class="collapsible-header"> 
          <i class="fas fa-shopping-bag"></i>Shop<span><i class="fas fa-caret-down"></i></span>
        </div>
        <div class="collapsible-body">
          <ul>
             <li>
              <a class="waves-effect waves-blue" href="<?= site_url('mobile/Home');?>"><i class="fas fa-angle-right"></i>Product List</a>
            </li>
   
  
            <li>
              <a class="waves-effect waves-blue" href="<?= site_url('mobile/Home/shoping');?>"><i class="fas fa-angle-right"></i>Shopping Cart</a>
            </li>
            <li>
              <a class="waves-effect waves-blue" href="<?= site_url('mobile/Home/transaksi');?>"><i class="fas fa-angle-right"></i>Transaksi</a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </li>
  

  <li>
    <a href="<?= site_url('mobile/Home/logout');?>"><i class="fas fa-sign-out-alt"></i>Log Out</a>
  </li>
  <?php } else { ?>
   <li>
    <a href="<?= site_url('mobile/Home/login');?>"><i class="fas fa-user-md"></i>Login</a>
  </li>
     <li>
    <ul class="collapsible collapsible-accordion">
      <li>
        <div class="collapsible-header"> 
          <i class="fas fa-shopping-bag"></i>Shop<span><i class="fas fa-caret-down"></i></span>
        </div>
        <div class="collapsible-body">
          <ul>
             <li>
              <a class="waves-effect waves-blue" href="<?= site_url('mobile/Home');?>"><i class="fas fa-angle-right"></i>Product List</a>
            </li>


   
          </ul>
        </div>
      </li>
    </ul>
  </li>

  <li>
    <a href="<?= site_url('mobile/Home/registrasi');?>"><i class="fas fa-sign-out-alt"></i>Registrasi</a>
  </li>
  <?php } ?>
</ul>