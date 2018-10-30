<form method="get" action="{{ url('expense/search') }}/{{app()->getLocale()}}">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 form-control-label label-sm"> @lang('app.expense_name')</label>
        <div class="col-sm-10">
          <input id="inputHorizontalSuccess" name="title" placeholder="{{ __('app.expense') }}" class="form-control form-control-success" type="text">
        </div>
      </div>
      <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
      <button type="submit" class="btn btn-primary">@lang('app.Search') </button>
</form>
