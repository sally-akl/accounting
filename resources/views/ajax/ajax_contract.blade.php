<label class=" form-control-label">
     @lang('app.contract_view')
</label>

<table class="table table-striped">
  <tr>
    <td>@lang('app.contract_title')</td>
    <td>{{clean($contract->title)}}</td>
  </tr>
    <tr>
      <td>@lang('app.begin_date')</td>
      <td>{{date("Y-m-d",strtotime($contract->begin_date))}}</td>
    </tr>
    <tr>
      <td>@lang('app.end_date')</td>
      <td>{{date("Y-m-d",strtotime($contract->end_date))}}</td>
    </tr>

    <tr>
      <td>@lang('app.contract_second_type')</td>
      <td>
        @if($contract->for_type == "customers")
           @lang('app.customers')
        @elseif($contract->for_type == "employees")
           @lang('app.employees')
        @elseif($contract->for_type == "other")
           @lang('app.other')
        @endif

      </td>
    </tr>

     @if($contract->for_type == "employees" && ($contract->for_type_id != "" || $contract->for_type_id != 0))
     <tr>
       <td>@lang('app.employee_name')</td>
       <td>{{\App\employee::find($contract->for_type_id)->employee_name}}</td>
     </tr>
      @endif

      @if($contract->for_type == "customers" && ($contract->for_type_id != "" || $contract->for_type_id != 0))
      <tr>
        <td>@lang('app.employee_name')</td>
        <td>{{\App\customer::find($contract->for_type_id)->full_name}}</td>
      </tr>
      @endif


      @if($contract->digital_sign != "")
      <tr>
        <td>@lang('app.digital_sign')</td>
        <td>	 <img src="{{ url('/') }}/images/{{$contract->digital_sign}}" width="100" height="100"/>
        </td>
      </tr>
      @endif


      @if($contract->contract_signiture	 != "")
      <tr>
        <td>@lang('app.signiture_first_person')</td>
        <td>	 <img src="{{$contract->contract_signiture}}" width="100" height="100"/>
        </td>
      </tr>
      @endif

      @if($contract->contract_signature_two	 != "")
      <tr>
        <td>@lang('app.signiture_second_person')</td>
        <td>	 <img src="{{$contract->contract_signature_two}}" width="100" height="100"/>
        </td>
      </tr>
      @endif




</table>
