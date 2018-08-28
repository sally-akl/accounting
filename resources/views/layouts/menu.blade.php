<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
  <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

  <!-- BEGIN: Aside Menu -->
  <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;background-color:#042531;">
      <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
          <div class="text-center">
          <img src="assets/media/img/users/100_3.jpg" class="imageUsername"/>
          </div>
          <a href="index.html" class="m-menu__link menu_linkss text-center">
            <h5 class="admin-username m--align-center">

              @guest
              <div></div>

              @else
              {{ Auth::user()->name }}
                @endguest
            </h5>

          </a>
          <p class="levelAdmin text-center">Administrator</p>
          <form action="" method="" >
            <input type="text" name="" value="Search something ..." class="inputSearchDashboardS m--align-center" />
             <i class="fa fa-search" id="icnoSearchS"></i>
          </form>
        </li>

        <li class="m-menu__item  " aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="{{url('/dashboard')}}" class="m-menu__link m-menu__toggle ">
            <i class="m-menu__link-icon fa fa-home"></i>
            <span class="m-menu__link-text">Index</span>
          </a>

        </li>




        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="javascript:;" class="m-menu__link m-menu__toggle">
            <i class="m-menu__link-icon fa fa-cog"></i>
            <span class="m-menu__link-text">Settings</span>
            <i class="m-menu__ver-arrow fa fa-angle-down"></i>
          </a>
          <div class="m-menu__submenu ">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/country')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage countries</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/city')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage cities</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/account')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage accounts</span>
                </a>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/settings/1/edit')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Setting</span>
                </a>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/templates')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Templates</span>
                </a>
              </li>


            </ul>
          </div>
        </li>
        <li class="m-menu__item  " aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="{{url('/category')}}" class="m-menu__link m-menu__toggle ">
            <i class="m-menu__link-icon fa fa-list"></i>
            <span class="m-menu__link-text">Categories</span>
          </a>

        </li>

        <li class="m-menu__item  " aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="{{url('/service')}}" class="m-menu__link m-menu__toggle ">
            <i class="m-menu__link-icon fa fa-lightbulb"></i>
            <span class="m-menu__link-text">Services</span>
          </a>

        </li>


        <li class="m-menu__item  " aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="{{url('/job')}}" class="m-menu__link m-menu__toggle ">
            <i class="m-menu__link-icon fa fa-suitcase"></i>
            <span class="m-menu__link-text">Jobs</span>
          </a>

        </li>

        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="javascript:;" class="m-menu__link m-menu__toggle">
            <i class="m-menu__link-icon fa fa-users"></i>
            <span class="m-menu__link-text">Employees</span>
            <i class="m-menu__ver-arrow fa fa-angle-down"></i>
          </a>
          <div class="m-menu__submenu ">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <span class="m-menu__link">
                  <span class="m-menu__link-text">Employees</span>
                </span>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/employee')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage employees</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/major')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage majors</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/employeemajor')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage salaries</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/extrasalary')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage extras</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/bouns')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage bonuses</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/discount')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage discounts</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="javascript:;" class="m-menu__link m-menu__toggle">
            <i class="m-menu__link-icon fa fa-smile"></i>
            <span class="m-menu__link-text">Customers</span>
            <i class="m-menu__ver-arrow fa fa-angle-down"></i>
          </a>
          <div class="m-menu__submenu ">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <span class="m-menu__link">
                  <span class="m-menu__link-text">Customers</span>
                </span>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/customer')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage customers</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/invoice')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Customers invoice</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/quote')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Customers Quotes</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="javascript:;" class="m-menu__link m-menu__toggle">
            <i class="m-menu__link-icon fa fa-user"></i>
            <span class="m-menu__link-text">Users</span>
            <i class="m-menu__ver-arrow fa fa-angle-down"></i>
          </a>
          <div class="m-menu__submenu ">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <span class="m-menu__link">
                  <span class="m-menu__link-text">Users</span>
                </span>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/user')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage users</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/roles')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage roles</span>
                </a>
              </li>

            </ul>
          </div>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="javascript:;" class="m-menu__link m-menu__toggle">
          <i class="m-menu__link-icon fa fa-shopping-cart"></i>
            <span class="m-menu__link-text">Transation</span>
            <i class="m-menu__ver-arrow fa fa-angle-down"></i>
          </a>
          <div class="m-menu__submenu ">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <span class="m-menu__link">
                  <span class="m-menu__link-text">Transation</span>
                </span>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/transactions/income')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage income</span>
                </a>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/transactions/expense')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage expense</span>
                </a>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/expense')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage expense Type</span>
                </a>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/transactions/transfer')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage Transfer</span>
                </a>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/transactions/all')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">View transactions</span>
                </a>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/transactions/show/balancesheet')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Balance sheet</span>
                </a>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/transactions/show/invoices')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Payments</span>
                </a>
              </li>

            </ul>
          </div>
        </li>


        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="javascript:;" class="m-menu__link m-menu__toggle">
          <i class="m-menu__link-icon fa fa-shopping-cart"></i>
            <span class="m-menu__link-text">Sales</span>
            <i class="m-menu__ver-arrow fa fa-angle-down"></i>
          </a>
          <div class="m-menu__submenu ">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <span class="m-menu__link">
                  <span class="m-menu__link-text">Sales</span>
                </span>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/invoice/all')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage invoices</span>
                </a>
              </li>

              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/quote/all')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Manage quotes</span>
                </a>
              </li>

            </ul>
          </div>
        </li>
        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
          <a href="javascript:;" class="m-menu__link m-menu__toggle">
            <i class="m-menu__link-icon fa fa-chart-pie"></i>
            <span class="m-menu__link-text">Reports</span>
            <i class="m-menu__ver-arrow fa fa-angle-down"></i>
          </a>
          <div class="m-menu__submenu ">
            <span class="m-menu__arrow"></span>
            <ul class="m-menu__subnav">
              <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <span class="m-menu__link">
                  <span class="m-menu__link-text">Reports</span>
                </span>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/reports/transaction/income')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Income reports</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/reports/transaction/expense')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Expense reports</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/reports/transaction/filter/bydate')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Inc / Exp by date</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/reports/transaction/filter/byrange')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Inc / Exp by range date</span>
                </a>
              </li>
              <li class="m-menu__item " aria-haspopup="true">
                <a href="{{url('/reports/invoices')}}" class="m-menu__link ">
                  <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="m-menu__link-text">Invoices</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

    </div>

    <!-- END: Aside Menu -->
</div>
