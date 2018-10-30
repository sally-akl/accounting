<form method="get" action="{{ url('invoice/search') }}/{{app()->getLocale()}}">
    @csrf

      <div class="form-group row">
        <label class="col-sm-3 form-control-label label-sm"> @lang('app.employee_name')</label>
        <div class="col-sm-9">
          <select class="form-control" name="customer_val" >
                @foreach ($customers as $key => $c)
                  <option value="{{$c->id}}">{{$c->full_name}}</option>
                @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-3 form-control-label label-sm">@lang('app.from')</label>
        <div class="col-md-4">
          <input type="date" name="from" class="form-control has-shadow">
        </div>
        <label class="col-sm-1 form-control-label label-sm lab" style="text-align: center;">@lang('app.to')</label>
        <div class="col-md-4">
          <input type="date" name="to" class="form-control has-shadow">
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
      <button type="submit" class="btn btn-primary">@lang('app.Search') </button>
</form>
