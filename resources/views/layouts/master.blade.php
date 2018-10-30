@include('layouts.header')

<body>

  <div class="page">
    <!-- Main Navbar-->


		<header class="header">
      <nav class="navbar">
        <!-- Search Box-->
        <div class="search-box">
          <button class="dismiss">
            <i class="icon-close"></i>
          </button>
          <form id="searchForm" action="#" role="search">
            <input type="search" placeholder="What are you looking for..." class="form-control">
          </form>
        </div>
        <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
            <!-- Navbar Header-->
            <div class="navbar-header">
              <!-- Navbar Brand -->
              <a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                <div class="brand-text logo d-none d-lg-inline-block">
                  <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid">
                </div>
                <div class="brand-text d-none d-sm-inline-block d-lg-none">
                  <strong>ibtkarat</strong>
                </div>
              </a>
              <!-- Toggle Button-->
              <a id="toggle-btn" href="#" class="menu-btn active">
                <span></span>
                <span></span>
                <span></span>
              </a>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <!-- Search-->
              <li class="nav-item d-flex align-items-center">
                <a id="search" href="#">
                  <i class="icon-search"></i>
                </a>
              </li>
              <!-- Notifications-->
              <li class="nav-item dropdown ring-not">
              <!--  <a id="notifications"  rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                  class="nav-link">
                  <i class="fas fa-bell" style="font-size: 20px;"></i>
                  <span class="badge bg-blue badge-corner">12</span>
                </a>  -->
                <ul aria-labelledby="notifications" class="dropdown-menu">
                  <li>
                    <a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification">
                        <div class="notification-content">
                          <i class="fa fa-envelope bg-green"></i>You have 6 new messages </div>
                        <div class="notification-time">
                          <small>4 minutes ago</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification">
                        <div class="notification-content">
                          <i class="fa fa-envelope bg-blue"></i>You have 2 followers</div>
                        <div class="notification-time">
                          <small>4 minutes ago</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification">
                        <div class="notification-content">
                          <i class="fa fa-upload bg-orange"></i>Server Rebooted</div>
                        <div class="notification-time">
                          <small>4 minutes ago</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a rel="nofollow" href="#" class="dropdown-item">
                      <div class="notification">
                        <div class="notification-content">
                          <i class="fa fa-envelope bg-blue"></i>You have 2 followers</div>
                        <div class="notification-time">
                          <small>10 minutes ago</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center">
                      <strong>view all notifications </strong>
                    </a>
                  </li>
                </ul>
              </li>


              <li class="nav-item dropdown">
                <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                  class="nav-link language dropdown-toggle">
                <!--  <img src="{{ asset('img/avatar-1.jpg') }}" alt="..." class="img-fluid rounded-circle" style="width: 40px;">  -->
                  <span class="d-none d-sm-inline-block">@if(!Request::has('branch') || empty(Request::query("branch")) || \App\branch::find(Request::query('branch')) == null)
                                                           @lang('app.select_branch')
                                                           @else
                                                           {{\App\branch::find(Request::query('branch'))->branch_title}}
                                                         @endif</span>
                </a>
                <ul aria-labelledby="languages" class="dropdown-menu">
                  <?php
                     $branches = \App\branch::all();
                     if(!Auth::user()->IsAdmin())
                        $branches = Auth::user()->branche;

                     foreach($branches as $branch)
                     {
                         ?>
                         <li>
                           <a rel="nofollow" href="{{url('/dashboard')}}?lang={{app()->getLocale()}}&branch={{$branch->id}}" class="dropdown-item">
                             <?php   echo $branch->branch_title;  ?></a>
                         </li>
                         <?php

                     }

                   ?>



                </ul>
              </li>




              <li class="nav-item dropdown">
                <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                  class="nav-link language dropdown-toggle">
                <!--  <img src="{{ asset('img/avatar-1.jpg') }}" alt="..." class="img-fluid rounded-circle" style="width: 40px;">  -->
                  <span class="d-none d-sm-inline-block">{{ Auth::user()->name }}</span>
                </a>
                <ul aria-labelledby="languages" class="dropdown-menu">
										@if(Auth::user()->IsAdmin())
                  <li>
                    <a rel="nofollow" href="{{url('/settings/1/edit')}}/{{app()->getLocale()}}" class="dropdown-item">
                      <i class="fa fa-edit"></i> Settings</a>
                  </li>
									@endif
									<li>
										<a rel="nofollow" href="{{url('/dashboard')}}?lang={{app()->getLocale()=='en'?'ar':'en'}}" class="dropdown-item">
											<i class="fa fa-edit"></i>{{app()->getLocale()=='en'?'العربية':'english'}}</a>
									</li>
                  <li>
                    <a rel="nofollow" href="#" class="dropdown-item" onclick="event.preventDefault();
																	 document.getElementById('logout-form').submit();">
                      <i class="fas fa-sign-in-alt"></i> {{ __('Logout') }}  </a>
                  </li>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
                </ul>
              </li>
              <!-- Logout    -->

            </ul>
          </div>
        </div>
      </nav>
    </header>


    <div class="page-content d-flex align-items-stretch">
      <!-- Side Navbar -->
      <nav class="side-navbar">
			   @include('layouts.menu')
      </nav>
      <div class="content-inner">
				 @yield('content')




        <!-- Page Footer-->
				<footer class="main-footer">
           <div class="container-fluid">
             <div class="row">
               <div class="col-sm-12 text-center ">
                 <p class="colorgold">Copyright &copy; 2018. All rights reserved ibtkarat</p>
               </div>

             </div>
           </div>
         </footer>


      </div>
    </div>
  </div>


@include('layouts.footer')
