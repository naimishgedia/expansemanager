 <div class="wrapper">
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>-->
    </ul>

    <!-- SEARCH FORM -->
    <!--<form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class='fas fa-user-alt'></i> Profile
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a  onclick="ChangePassword()" class="dropdown-item">
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                 <i class='fas fa-unlock'></i>  Change Password
                  <span class="float-right text-sm text-danger"></span>
                </h3>
              </div>
            </div>
          </a>
		  <div class="dropdown-divider"></div>
		  <a href="{{ route('auth.logout') }}" class="dropdown-item">
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                 <i class='fas fa-sign-out-alt'></i>  Logout
                  <span class="float-right text-sm text-danger"></span>
                </h3>
              </div>
            </div>
          </a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      
       
    </ul>
  </nav>
  
    <div class="modal fade" id="change_password_model">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				  <p id="commanerror" style="color:red;display:none;"><b>Please fill all require field</b></p>
				  <div class="form-group">
                    <label for="exampleInputEmail1">Password <span style="color:red;">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Current Password" onblur="CheckCurrentPassword()"> 
					<p id="current_password_error" style="color:red;display:none;"><b>The entered password doesn't match the current password.</b></p>
                  </div> 
                  <div class="form-group">
                    <label for="exampleInputPassword1">New Password<span style="color:red;">*</span></label>
                    <input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password">
                  </div>
				   <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password<span style="color:red;">*</span></label>
                    <input type="password" class="form-control" id="retype_password" placeholder="Enter Ner Password" name="retype_password">
					<p id="passwordnotmatch" style="color:red;display:none;">The password and confirm password do not match</p>
					<p id="somethingwentwrong" style="color:red;display:none;">Something went wrong,Try again</p>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="change_password_button" onclick="ChangePasswordFunction()"class="btn btn-primary">Change Password</button>
            </div>
          </div>
        </div>
      </div>