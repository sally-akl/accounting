<form method="get" action="{{ url('transactions/filter/employee_filter') }}/{{app()->getLocale()}}" >
    @csrf

<div class="form-group row">
    <label class="col-sm-2 form-control-label label-sm"> @lang('app.from')</label>
    <div class="col-sm-10">
      <input id="inputHorizontalSuccess" name="transfer_from" placeholder="{{ __('app.enter_date_from') }}" class="form-control form-control-success" type="date">
    </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-2 form-control-label label-sm"> @lang('app.to')</label>
      <div class="col-sm-10">
        <input id="inputHorizontalSuccess" name="transfer_to" placeholder="{{ __('app.enter_date_to') }}" class="form-control form-control-success" type="date">
      </div>
    </div>

   <input type="hidden" name="emp_id" value="{{$employee->id}}" />
   <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
  <button type="submit" class="btn btn-primary">@lang('app.Search') </button>
</form>
