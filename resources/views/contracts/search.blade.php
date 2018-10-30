<form method="get" action="{{ url('contracts/search') }}/{{app()->getLocale()}}">
    @csrf
    <div class="form-group row">
      <label class="col-sm-3 form-control-label label-sm">{{ __('app.from') }}</label>
      <div class="col-md-4">
        <input type="date" name= "transfer_from" class="form-control has-shadow" placeholder="{{ __('app.enter_date_from') }}">
      </div>
      <label class="col-sm-1 form-control-label label-sm lab" style="text-align: center;">{{ __('app.to') }}</label>
      <div class="col-md-4">
        <input type="date" name= "transfer_to" class="form-control has-shadow" placeholder="{{ __('app.enter_date_to') }}">
      </div>
    </div>
        <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
      <button type="submit" class="btn btn-primary">@lang('app.Search') </button>
</form>
