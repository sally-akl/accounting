<form method="get" action="{{ url('account/search') }}" class="form-inline">
    @csrf


<div class="col-xs-1" style="width: 20%">
   <input type="text"  name= "bankname" class="form-control m-input inputt" placeholder="{{ __('app.bank_name') }}" style="width: 95%;">
</div>
<div class="col-xs-1" style="width: 20%">
  <input type="text"  name= "number" class="form-control m-input inputt" placeholder="{{ __('app.account_num') }}" style="width: 91%;">

</div>
<div class="col-xs-1 searchDiv">

              <input type="text" name="from" class="form-control m-input inputTo" placeholder="{{ __('app.balance_from') }}" style="width: 80%;">

</div>
<div class="col-xs-1 searchDiv">

                <input type="text" name="to" class="form-control m-input inputTo" placeholder="{{ __('app.balance_to') }}" style="width: 75%;">
                <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>




</form>
