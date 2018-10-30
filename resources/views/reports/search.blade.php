<form method="get" action="{{ url('reports/search') }}/{{app()->getLocale()}}" class="form-inline">
    @csrf
<div class="col-xs-1">
  <input type="text"  name= "transfer_from" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_date_from') }}">
</div>

@if($trans_type == "byrange")
  <div class="col-xs-1">
    <input type="text"  name= "transfer_to" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_date_to') }}">
  </div>
@endif

<input type="hidden" name="transfer_type" value="{{$trans_type}}" />
<div class="col-xs-6">

      <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
    <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>
</form>
