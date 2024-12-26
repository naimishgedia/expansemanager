<div id="app">
<div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
               <div class="sidebar-header">
                  <div class="d-flex justify-content-between">
                     <div class="logo">
                        <h3>Expanse Manager</h3>
						<p style="font-size: medium!important;">Welcome {{auth()->user()->name}}</p>
                     </div>
                     <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                     </div>
                  </div>
               </div>
               <div class="sidebar-menu">
                  <ul class="menu">
                     <li
                        class="sidebar-item @if($page_title == 'Dashboard') active @endif">
                        <a href="index.html" class='sidebar-link'>
                        <i class="fa fa-dashboard" style="font-size:24px"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
					 <li
                        class="sidebar-item @if($page_title == 'Expanse Category') active @endif">
                        <a href="{{ route('expanse_category') }}" class='sidebar-link'>
                        <i class="fa fa-arrow-right" style="font-size:24px"></i>
                        <span>Expanse Category</span>
                        </a>
                     </li>
					 <li
                        class="sidebar-item @if($page_title == 'Income Category') active @endif">
                        <a href="{{ route('income_category') }}" class='sidebar-link'>
                        <i class="fa fa-arrow-left" style="font-size:24px"></i>
                        <span>Income Category</span>
                        </a>
                     </li> 
					 <li
                        class="sidebar-item @if($page_title == '') active @endif">
                        <a href="{{ route('daily_expanse') }}" class='sidebar-link'>
                        <i class="fa fa-arrow-left" style="font-size:24px"></i>
                        <span>Add Daily Expanse</span>
                        </a>
                     </li>
                     <li
                        class="sidebar-item @if($page_title == 'Change Password') active @endif">
                        <a href="{{ route('changepassword') }}" class='sidebar-link'>
                        <i class="fa fa-lock" style="font-size:24px"></i>
                        <span>Change Password</span>
                        </a>
                     </li>
					 <li
                        class="sidebar-item">
                        <a href="{{ route('logout') }}" class='sidebar-link'>
                        <i class="fa fa-sign-out" style="font-size:24px"></i>
                        <span>Logout</span>
                        </a>
                     </li>
                    
                    
                     
                     
                     
                    
                     
                     
                     
                     
                  </ul>
               </div>
               <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
         </div>