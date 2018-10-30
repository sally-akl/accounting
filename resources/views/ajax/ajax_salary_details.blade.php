<label class=" form-control-label">
     @lang('app.main_information')
</label>



<table class="table table-striped">
  <tr>
    <td>@lang('app.employee_name')</td>
    <td>{{clean($transaction->employee->employee_name)}}</td>
  </tr>
    <tr>
      <td>@lang('app.in_job')</td>
      <td>{{clean($transaction->majorData->majorData->title)}}</td>
    </tr>
    <tr>
      <td>@lang('app.in_category')</td>
      <td>{{clean($transaction->majorData->majorData->category->title)}}</td>
    </tr>
    <tr>
      <td>@lang('app.in_branch')</td>
      <td>{{clean($transaction->majorData->majorData->category->branch->branch_title)}} ({{clean($transaction->majorData->majorData->category->branch->branch_code)}})</td>
    </tr>
      <tr>
        <td>@lang('app.basic_salary')</td>
        <td>{{clean($basic_salary)}} {{Auth::user()->currency}}</td>
      </tr>

</table>
@include("ajax/ajax_salary_details_commaon")
