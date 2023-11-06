<div class="register-form">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">SIGN</span> UP
          </div>
        </div>
      </div>
      <div class="row">
        <form class="col s12" method="post" action="<?= site_url('mobile/Home/prosesDaftar');?>">
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="username" type="text" class="validate" name="username">
              <label for="username">Select a Username</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="email" type="email" class="validate" name="email">
              <label for="email">Your Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="password" type="password" class="validate" name="password">
              <label for="password">Enter a Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="nama" type="text" class="validate" name="nama">
              <label for="repassword">Nama</label>
            </div>
          </div>  
		  <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="alamat" type="text" class="validate" name="alamat">
              <label for="repassword">Alamat</label>
            </div>
          </div>
          <div class="row row-forgot">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <a class="forgotr" href="<?= site_url('mobile/Home/login');?>">Already registered? Sign in here</a>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <input class="waves-effect waves-light btn" value="SIGN UP NOW" type="submit"></div>
          </div>
        </form>
      </div>
    </div>
  </div>