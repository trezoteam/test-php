<?php use Module\Quiz\View\SRC\Admin\Login as View_Login; ?>
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-md-4 mb-12 login_card">
            <div class="card mb-8 wow fadeIn">
              <h5 class="card-header info-color white-text text-center py-4">
                <strong>Sign in</strong>
              </h5>
              <!--Card content-->
              <div class="card-body px-lg-5 pt-0">
                <!-- Form -->
                <form class="text-center" style="color: #757575;">
                  <!-- Email -->
                  <div class="md-form">
                    <input type="text" id="user_name" class="form-control">
                    <label for="user_name">Username</label>
                  </div>
                  <!-- Password -->
                  <div class="md-form">
                    <input type="password" id="password" class="form-control">
                    <label for="password">Password</label>
                  </div>
                  <div class="d-flex justify-content-around">
                    <div>
                      <!-- Forgot password -->
                      <a href="">Forgot password?</a>
                    </div>
                  </div>
                  <!-- Sign in button -->
                  <div onclick="authenticate()" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0">Sign in</div>
                </form>
                <!-- Form -->
              </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/admin/login.js"></script>