<form method="get" action="{{ url('reports/invoicesearch') }}/{{app()->getLocale()}}" >
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
                        <label class="col-sm-3 form-control-label label-sm">@lang('app.invoices_status')</label>
                        <div class="col-sm-9">
                          <select name="invoice_status" class="form-control">

                            <option value=""> @lang('app.Choose_Status') </option>
                            <option value="paid">@lang('app.Paid')</option>
                            <option value="unpaid">@lang('app.UnPaid')</option>
                            <option value="pending">@lang('app.Pending')</option>
                            <option value="stoped">@lang('app.Stoped')</option>


                          </select>
                        </div>

                          </div>


  <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
<button type="submit" class="btn btn-primary">@lang('app.Filter') </button>
</form>
