<form method="get" action="{{ url('employee/search') }}/{{app()->getLocale()}}">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 form-control-label label-sm"> @lang('app.employee_name')</label>
        <div class="col-sm-10">
          <input id="inputHorizontalSuccess" name="name" placeholder="{{ __('app.enter_employee_name') }}" class="form-control form-control-success" type="text">
        </div>
      </div>

      <div class="form-group row">
          <label class="col-sm-2 form-control-label label-sm"> @lang('app.employee_email')</label>
          <div class="col-sm-10">
            <input id="inputHorizontalSuccess" name="email" placeholder="{{ __('app.enter_employee_email') }}" class="form-control form-control-success" type="text">
          </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 form-control-label label-sm"> @lang('app.employee_join_data')</label>
            <div class="col-sm-10">
              <input id="inputHorizontalSuccess" name="join_date" placeholder="{{ __('app.enter_employee_join_date') }}" class="form-control form-control-success" type="date">
            </div>
          </div>

      <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
      <button type="submit" class="btn btn-primary">@lang('app.Search') </button>
</form>
