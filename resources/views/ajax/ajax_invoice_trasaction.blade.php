<table class="table table-striped custab" id="print_tb">

  <thead>
    <tr>
      <th>@lang('app.transfer_code')</th>
      <th>@lang('app.transfer_type')</th>
      <th>@lang('app.Date')</th>
      <th>@lang('app.Description')</th>
      <th scope="col">
          @lang('app.submit_user_name')
      </th>
      <th>@lang('app.customer_amount')</th>
        <th scope="col">@lang('app.amount_after_trans')</th>
    </tr>
  </thead>
  <tbody>
     @php $total_amount = 0 ;  @endphp
      @foreach ($transfers as $key => $trans)
    <tr>
      <td data-label="@lang('app.transfer_code')">	{{$trans->transfer_code_num}}</td>
      <td data-label="@lang('app.transfer_type')">	{{$trans->transfer_type}}</td>
      <td data-label="@lang('app.Date')">	{{$trans->transfer_date}}</td>

      <td data-label="@lang('app.Description')">{{clean($trans->transfer_desc)}}</td>
      <td data-label="@lang('app.submit_user_name')">	{{$trans->users != null ?$trans->users->name:""	}}

      </td>
        <td data-label="@lang('app.Amount')"> {{clean($trans->transfer_amount)}} {{\App\classes\Common::getCurrencyText($trans->currancy)}}</td>
        <td data-label="@lang('app.amount_after_trans')">	{{$trans->converted_transfer_amount}} {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}}</td>

    </tr>
      @php $total_amount += $trans->converted_transfer_amount ;  @endphp
      @endforeach

      <tr>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>

         <td>@lang('app.Total') : {{\App\classes\Common::getCurrencyText(Auth::user()->currency)}} {{$total_amount}} </td>
      </tr>


  </tbody>
</table>

{{$transfers->links('vendor.pagination.default')}}
