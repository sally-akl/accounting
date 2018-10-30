<form method="get" action="{{ url('customer/search') }}/{{app()->getLocale()}}">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 form-control-label label-sm"> @lang('app.customer_name')</label>
        <div class="col-sm-10">
          <input id="inputHorizontalSuccess" name="fullname" placeholder="{{ __('app.enter_full_name') }}" class="form-control form-control-success" type="text">
        </div>
      </div>

      <div class="form-group row">
          <label class="col-sm-2 form-control-label label-sm"> @lang('app.customer_email')</label>
          <div class="col-sm-10">
            <input id="inputHorizontalSuccess" name="email" placeholder="{{ __('app.enter_customer_email') }}" class="form-control form-control-success" type="text">
          </div>
        </div>
      <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
      <button type="submit" class="btn btn-primary">@lang('app.Search') </button>
</form>
