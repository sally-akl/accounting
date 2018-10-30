<form method="get" action="{{ url('transactions/all/filter/search') }}/{{app()->getLocale()}}" >
    @csrf

<div class="form-group row">
    <label class="col-sm-3 form-control-label label-sm"> @lang('app.from')</label>
    <div class="col-sm-9">
      <input id="inputHorizontalSuccess" name="transfer_from" placeholder="{{ __('app.enter_date_from') }}" class="form-control form-control-success" type="date">
    </div>
  </div>

  <div class="form-group row">
      <label class="col-sm-3 form-control-label label-sm"> @lang('app.to')</label>
      <div class="col-sm-9">
        <input id="inputHorizontalSuccess" name="transfer_to" placeholder="{{ __('app.enter_date_to') }}" class="form-control form-control-success" type="date">
      </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-3 form-control-label label-sm">  @lang('app.type') </label>
        <div class="col-sm-9">
            <select name="transfer_type2" class="form-control transfer_type">

              <option value="income"> @lang('app.Income')</option>
              <option value="expense"> @lang('app.Expense')</option>
            </select>

        </div>
    </div>


    <div class="form-group row invoice_val" style="display:none;">
        <label class="col-sm-3 form-control-label label-sm">  @lang('app.invoice') </label>
        <div class="col-sm-9">
            <select name="invoice_val" class="form-control" >
              <option value="0">Select</option>
              @foreach ($invoices as $key => $inv)
               <option value="{{$inv->id}}">{{$inv->invoice_code_num}}</option>
              @endforeach
            </select>

        </div>
    </div>


    <div class="form-group row expense_val" style="display:none;">
        <label class="col-sm-3 form-control-label label-sm">  @lang('app.expense_type') </label>
        <div class="col-sm-9">
            <select name="expense_val" class="form-control" >
              <option value="0">Select</option>
              @foreach ($expense_type as $key => $exp)
               <option value="{{$exp->id}}">{{$exp->title}}</option>
              @endforeach
            </select>

        </div>
    </div>


    <input type="hidden" name="transfer_type" value="all" />
     <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
      <button type="submit" class="btn btn-primary">@lang('app.Search') </button>

</form>

@section('footerjscontent')

<script type="text/javascript">

$(".transfer_type").on("change",function()
{
    var sel_val = $(this).val();

    $(".invoice_val").css("display","none");
    $(".expense_val").css("display","none");
    $(".account_from").css("display","none");
    if(sel_val == "income")
       $(".invoice_val").css("display","");
    if(sel_val == "expense")
       $(".expense_val").css("display","");
    if(sel_val == "transfer")
      $(".account_from").css("display","");

});

</script>
@endsection
