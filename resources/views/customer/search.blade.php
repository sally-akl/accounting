<form method="get" action="{{ url('customer/search') }}" class="form-inline">
    @csrf
<div class="col-xs-3">
    <input type="text"  name= "fullname" class="form-control m-input" placeholder="{{ __('app.enter_full_name') }}">
</div>

<div class="col-xs-3">
    <input type="text"  name= "email" class="form-control m-input" placeholder="{{ __('app.enter_customer_email') }}">
</div>
<div class="col-xs-6">

    <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>
</form>
