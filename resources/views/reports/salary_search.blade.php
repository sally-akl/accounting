<form method="get" action="{{ url('reports/salary') }}/{{app()->getLocale()}}" >
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

  <div class="form-group row">
                        <label class="col-sm-3 form-control-label label-sm">@lang('app.employee_name')</label>
                        <div class="col-sm-9">
                          <select name="employee" class="form-control">

                            <option value="0">----</option>
                            @foreach ($employee as $key => $emp)
                                <option value="{{$emp->id}}" >{{$emp->employee_name}}</option>
                            @endforeach

                          </select>
                        </div>

                          </div>


  <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
<button type="submit" class="btn btn-primary">@lang('app.Filter') </button>
</form>
