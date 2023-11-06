<div class="login-form">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="section-title">
            <span class="theme-secondary-color">LOGIN</span> ACCOUNT
          </div>
        </div>
      </div>
      <div class="row">
        <form class="col s12" method="post" action="<?= site_url('mobile/Home/prosesLogin');?>">
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="username" type="text" name="username" class="validate">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4">
              <input id="password" type="password" name="password"  class="validate">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 m6 l4 offset-m3 offset-l4 center">
              <input class="waves-effect waves-light btn" value="LOG IN" type="submit"></div>
          </div>
        </form>
      </div>
 

      <div class="row">
        <div class="col s12 center">
           Don't have an Account ? <a href="<?= site_url('mobile/Home/registrasi');?>">Sign Up</a>
        </div>
      </div>
    </div>
  </div>