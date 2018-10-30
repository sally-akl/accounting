<ul class="list-unstyled">
  <li class="active">
    <a href="{{url('/dashboard')}}?lang={{app()->getLocale()}}&branch={{ Request::query('branch') }}">
      <i class="icon-home"></i>@lang('app.Home') </a>
  </li>
  <li>
    <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">
      <i class="fa fa-cog"></i>@lang('app.Settings') </a>
    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">

      @if(Auth::user()->AllowToPath("manage_country"))
      <li>
        <a href="{{url('/country')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.list_of_country')</a>
      </li>
      @endif
      @if(Auth::user()->AllowToPath("manage_branch"))
      <li>
        <a href="{{url('/branch')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.list_of_branches')</a>
      </li>
      @endif

      @if(Auth::user()->IsAdmin())
      <li>
        <a href="{{url('/settings/1/edit')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.Setting')</a>
      </li>

    <!--  <li>
        <a href="{{url('currency')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.currency_settings')</a>
      </li>
    -->
      @endif



    </ul>
  </li>

  @if(Auth::user()->AllowToPath("manage_category") || Auth::user()->AllowToPath("add_category") || Auth::user()->AllowToPath("edit_category") || Auth::user()->AllowToPath("delete_category"))
  <li>
    <a href="#category" aria-expanded="false" data-toggle="collapse">
      <i class="fas fa-layer-group"></i>@lang('app.Categories') </a>
    <ul id="category" class="collapse list-unstyled ">
      @if(Auth::user()->AllowToPath("manage_category"))
      <li>
        <a href="{{url('/category')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}"> @lang('app.list_of_categories')</a>
      </li>
        @endif
    </ul>
  </li>
  @endif

  @if(Auth::user()->AllowToPath("manage_service"))
  <li>
    <a href="{{url('/service')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
      <i class="far fa-list-alt"></i>@lang('app.Services') </a>
  </li>
  @endif

  @if(Auth::user()->AllowToPath("manage_job"))
  <li>
    <a href="{{url('/job')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
      <i class="far fa-list-alt"></i>@lang('app.Jobs') </a>
  </li>
  @endif


  @if(Auth::user()->AllowToPath("manage_employee") || Auth::user()->AllowToPath("manage_major")  || Auth::user()->AllowToPath("manage_extra_extra_salary") || Auth::user()->AllowToPath("manage_extra_bouns") || Auth::user()->AllowToPath("manage_extra_discount"))
  <li>
    <a href="#employe" aria-expanded="false" data-toggle="collapse">
      <i class="fas fa-users"></i>@lang('app.Employee')</a>
    <ul id="employe" class="collapse list-unstyled ">

      @if(Auth::user()->AllowToPath("manage_major"))
      <li>
        <a href="{{url('/major')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.list_of_major')</a>
      </li>
      @endif


            @if(Auth::user()->AllowToPath("manage_extra_extra_salary"))
            <li>
              <a href="{{url('/salarysettings')}}/extra_salary/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.sal_manage_extra_slary')</a>
            </li>
            @endif

            @if(Auth::user()->AllowToPath("manage_extra_bouns"))
            <li>
              <a href="{{url('/salarysettings')}}/bouns/{{app()->getLocale()}}?branch={{ Request::query('branch') }}"> @lang('app.sal_manage_bouns')</a>
            </li>
            @endif

            @if(Auth::user()->AllowToPath("manage_extra_discount"))
            <li>
              <a href="{{url('/salarysettings')}}/discount/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.sal_manage_discount')</a>
            </li>
            @endif

      @if(Auth::user()->AllowToPath("manage_employee"))
      <li>
        <a href="{{url('/employee')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}"> @lang('app.list_of_employee')</a>
      </li>
      @endif



    </ul>
  </li>
  @endif

   @if(Auth::user()->AllowToPath("manage_customer") || Auth::user()->AllowToPath("customer_invoices") || Auth::user()->AllowToPath("manage_quote") )
  <li>
    <a href="#transaction" aria-expanded="false" data-toggle="collapse">
      <i class="fas fa-user-tie"></i>@lang('app.Customers')</a>
    <ul id="transaction" class="collapse list-unstyled ">
      @if(Auth::user()->AllowToPath("manage_customer"))
      <li>
        <a href="{{url('/customer')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}"> @lang('app.list_of_customer')</a>
      </li>
      @endif
    </ul>
  </li>
  @endif


 @if(Auth::user()->AllowToPath("manage_invoices") || Auth::user()->AllowToPath("manage_quote")  )
  <li>
    <a href="#sales" aria-expanded="false" data-toggle="collapse">
      <i class="fas fa-shopping-basket"></i>@lang('app.Sales')</a>
    <ul id="sales" class="collapse list-unstyled ">

      @if(Auth::user()->AllowToPath("manage_invoices"))
      <li>
        <a href="{{url('/invoice/all')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}"> @lang('app.list_of_invoices')</a>
      </li>
      @endif

      @if(Auth::user()->AllowToPath("manage_quote"))
      <li>
        <a href="{{url('/quote/all')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.list_of_quotes')</a>
      </li>
      @endif
    </ul>
  </li>
  <li>
  @endif

    @if(Auth::user()->AllowToPath(['manage_income','manage_expense','manage_transfer']) || Auth::user()->AllowToPath("manage_expense_type") || Auth::user()->AllowToPath("view_balance_sheet") || Auth::user()->AllowToPath("view_payments") )
    <li>
      <a href="#trans" aria-expanded="false" data-toggle="collapse">
        <i class="fas fa-money-bill-wave"></i>@lang('app.Transation')</a>
      <ul id="trans" class="collapse list-unstyled ">

        @if(Auth::user()->AllowToPath('manage_income'))
        <li>
          <a href="{{url('/transactions/income')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}"> @lang('app.list_of_income')</a>
        </li>
        @endif

        @if(Auth::user()->AllowToPath('manage_expense'))
        <li>
          <a href="{{url('/transactions/expense')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}"> @lang('app.list_of_expense')</a>
        </li>
        @endif

        @if(Auth::user()->AllowToPath("manage_expense_type"))
        <li>
          <a href="{{url('/expense')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.list_of_expense_type')</a>
        </li>
        @endif

        @if(Auth::user()->AllowToPath("view_payments"))
        <li>
          <a href="{{url('/transactions/show/invoices')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}"> @lang('app.Payments')</a>
        </li>
        @endif


      </ul>
    </li>
    @endif


    @if(Auth::user()->AllowToPath('manage_contract'))
    <li>


    <a href="#users" aria-expanded="false" data-toggle="collapse">
      <i class="fas fa-user-friends"></i>@lang('app.contracts')</a>
    <ul id="users" class="collapse list-unstyled ">

      @if(Auth::user()->AllowToPath('manage_contract') )
      <li>
        <a href="{{url('/contracts')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.manage_contracts')</a>
      </li>
      @endif

    </ul>
  </li>
    @endif


    @if(Auth::user()->AllowToPath('manage_user') || Auth::user()->AllowToPath('manage_roles'))
    <li>


    <a href="#users" aria-expanded="false" data-toggle="collapse">
      <i class="fas fa-user-friends"></i>@lang('app.Users')</a>
    <ul id="users" class="collapse list-unstyled ">

      @if(Auth::user()->AllowToPath('manage_roles') )
      <li>
        <a href="{{url('/roles')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.list_of_roles')</a>
      </li>
      @endif

      @if(Auth::user()->AllowToPath('manage_user') )
      <li>
        <a href="{{url('/user')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.list_of_users')</a>
      </li>
      @endif


    </ul>
  </li>
    @endif

      @if(Auth::user()->AllowToPath(['income_report','expense_report']) || Auth::user()->AllowToPath(['expense_income_by_date','expense_income_by_date_range']) || Auth::user()->AllowToPath('invoice_report'))
  <li>
    <a href="#reports" aria-expanded="false" data-toggle="collapse">
      <i class="fas fa-clipboard-list"></i>@lang('app.Reports')</a>
    <ul id="reports" class="collapse list-unstyled ">
      @if(Auth::user()->AllowToPath('income_report'))
      <li>
        <a href="{{url('/reports/transaction/income')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">	@lang('app.income_report')</a>
      </li>
      @endif

        @if(Auth::user()->AllowToPath('expense_report'))
      <li>
        <a href="{{url('/reports/transaction/expense')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.expense_report')</a>
      </li>
      @endif

      @if(Auth::user()->AllowToPath('expense_income_by_date'))
      <li>
        <a href="{{url('/reports/transaction/filter/bydate')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.expense_ico_by_date_report')</a>
      </li>
      @endif

      @if(Auth::user()->AllowToPath('expense_income_by_date_range'))
      <li>
        <a href="{{url('/reports/transaction/filter/byrange')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.expense_ico_by_range_report')</a>
      </li>
      @endif
      @if(Auth::user()->AllowToPath('invoice_report'))
      <li>
        <a href="{{url('/reports/invoices')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.Invoices')</a>
      </li>
      @endif

      @if(Auth::user()->AllowToPath(['income_report','expense_report']))
      <li>
        <a href="{{url('/reports/expenses/category/')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.expense_by_category')</a>
      </li>
      @endif

      @if(Auth::user()->AllowToPath(['salary_report']))
      <li>
        <a href="{{url('/reports/salary/')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.salary_report')</a>
      </li>
      @endif


      @if(Auth::user()->AllowToPath(['employee_income']))
      <li>
        <a href="{{url('/reports/employee/income/')}}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">@lang('app.employee_income_report')</a>
      </li>
      @endif


    </ul>
  </li>
  @endif
</ul>
