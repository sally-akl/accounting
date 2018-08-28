<form method="get" action="{{ url('employee/search') }}" class="form-inline">
    @csrf
<div class="col-xs-3">
    <input type="text" name="name" class="form-control m-input inputt" placeholder="{{ __('app.enter_employee_name') }}">
</div>

<div class="col-xs-3">
    <input type="text" name="email" class="form-control m-input inputt" placeholder="{{ __('app.enter_employee_email') }}">
</div>


<div class="col-xs-3">
    <input type="text" name="join_date" id="m_datepicker_1" readonly="" class="form-control m-input inputt" placeholder="{{ __('app.enter_employee_join_date') }}">
</div>

<div class="col-xs-6">

    <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>
</form>
