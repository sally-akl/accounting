@extends('layouts.master')

@section('content')
<section id="manage-incom">
                 <div class="container-fluid">
                     <div class="row">
                         <div class="col-lg-12">
                             <div class="card" style="height:100% ;">
                                 <div class=" col-lg-12" style="padding-left: 30px;">
                                     <div class="row">
                                         <div class=" mg-top25">
                                             <label class=" form-control-label">
                                                  @lang('app.employee_salary_related_month')
                                             </label>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-12 mg-top30">
                                           @include("utility.error_messages")

                                             <form method="get" action="{{ url('/transactions/employee/salary') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" class="transactions_form">
                                                 @csrf

                                                <div class="form-group row">
                                                   <label class="col-sm-3 form-control-label label-sm">	@lang('app.month_of')</label>
                                                   <div class="col-sm-9">

                                                       <select name="employeemonth" class="form-control {{ $errors->has('employeemonth') ? ' is-invalid' : '' }}">

                                                          <option value="01">@lang('app.January')</option>
                                                          <option value="02">@lang('app.February')</option>
                                                          <option value="03">@lang('app.March')</option>
                                                          <option value="04">@lang('app.April')</option>
                                                          <option value="05">@lang('app.May')</option>
                                                          <option value="06">@lang('app.June')</option>
                                                          <option value="07">@lang('app.July')</option>
                                                          <option value="08">@lang('app.August')</option>
                                                          <option value="09">@lang('app.September')</option>
                                                          <option value="10">@lang('app.October')</option>
                                                          <option value="11">@lang('app.November')</option>
                                                          <option value="12">@lang('app.December')</option>

                                                       </select>
                                                   </div>
                                               </div>


                                               <div class="form-group row">
                                                  <label class="col-sm-3 form-control-label label-sm">	@lang('app.year_of')</label>
                                                  <div class="col-sm-9">

                                                     <input id="inputHorizontalSuccess"  name= "employeeyear" value="{{ date('Y') }}"  placeholder="{{ __('app.year_of') }}" class="form-control {{ $errors->has('employeeyear') ? ' is-invalid' : '' }} form-control-success" type="text">
                                                  </div>
                                              </div>


                                              @if(isset($employee_majors))
                                              <div class="form-group row">
                                                 <label class="col-sm-3 form-control-label label-sm">	@lang('app.employee_major_name')</label>
                                                 <div class="col-sm-9">
                                                     <select name="emp_major_id" class="form-control {{ $errors->has('emp_major_id') ? ' is-invalid' : '' }}">
                                                         @foreach($employee_majors as $major)
                                                        <option value="{{$major->id}}">{{$major->majorData->title}} ({{$major->current_salary}} {{\App\classes\Common::getCurrencyText($major->currancy)}}) </option>
                                                        @endforeach

                                                     </select>
                                                 </div>
                                             </div>
                                             @endif


                                              <input type="hidden" name="emp_id" value="{{$emp_id}}" />


                                                 <button type="submit" class="btn btn-primary">+  @lang('app.next') </button>
                                             </form>
                                         </div>
                                     </div>

                                 </div>
                             </div>
                         </div>

                     </div>
                 </div>
             </section>


           <div style="display:none" id="transaction_type_content">


           </div>
@endsection
