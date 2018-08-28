<form method="get" action="{{ url('reports/invoicesearch') }}" class="form-inline">
    @csrf
<div class="col-xs-1">
  <input type="text"  name= "transfer_from" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_date_from') }}">
</div>

  <div class="col-xs-1">
    <input type="text"  name= "transfer_to" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_date_to') }}">
  </div>



<div class="col-xs-6">

    <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>
</form>
