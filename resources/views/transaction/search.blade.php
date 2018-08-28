<form method="get" action="{{ url('transactions/search') }}" class="form-inline">
    @csrf
<div class="col-xs-1">
  <input type="text"  name= "transfer_from" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_date_from') }}">
</div>

<div class="col-xs-1">
  <input type="text"  name= "transfer_to" class="form-control m-input" id="m_datepicker_1" readonly="" placeholder="{{ __('app.enter_date_to') }}">
</div>
<select class="form-control m-input transfer_type" name="transfer_type">

      <option value="income">Income</option>
      <option value="expense">Expense</option>
      <option value="transfer">Transfer</option>

</select>


<select class="form-control m-input" name="to_account">
     @foreach ($accounts as $key => $account)
      <option value="{{$account->id}}">{{$account->account_number}}</option>
     @endforeach
</select>



<select class="form-control m-input invoice_val" name="invoice_val" style="display:none;">
     @foreach ($invoices as $key => $inv)
      <option value="{{$inv->id}}">{{$inv->invoice_code_num}}</option>
     @endforeach
</select>

<select class="form-control m-input expense_val" name="expense_val" style="display:none;">
     @foreach ($expense_type as $key => $exp)
      <option value="{{$exp->id}}">{{$exp->title}}</option>
     @endforeach
</select>


<select class="form-control m-input account_from" name="account_from" style="display:none;">
     @foreach ($accounts as $key => $account)
      <option value="{{$account->id}}">{{$account->account_number}}</option>
     @endforeach
</select>



<div class="col-xs-6">

    <button type="submit" class="btnSearchIcon"><i class="fa fa-search"></i></button>
</div>
</form>

<script type="text/javascript">

$(".transfer_type").on("change",function()
{
    var sel_val = $(this).val();

    $(".invoice_val").css("display","none");
    $(".expense_val").css("display","none");
    $(".account_from").css("display","none");
    if(sel_val == "income")
       $(".invoice_val").css("display","block");
    if(sel_val == "expense")
       $(".expense_val").css("display","block");
    if(sel_val == "transfer")
      $(".account_from").css("display","block");

});

</script>
