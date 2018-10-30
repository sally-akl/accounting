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
                                                  @lang('app.employee_salary')
                                             </label>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-lg-12 mg-top30">
                                           @include("utility.error_messages")

                                             <form method="POST" action="{{ url('transactions/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" class="transactions_form">
                                                 @csrf



                                                 <div class="form-group row">
                                                     <label class="col-sm-3 form-control-label label-sm">@lang('app.date') </label>
                                                     <div class="col-sm-9">
                                                         <input   name= "transfer_d"  value="{{ old('transfer_d') }}" placeholder="{{ __('app.enter_date') }}" class="form-control {{ $errors->has('transfer_d') ? ' is-invalid' : '' }} form-control-success" type="date">
                                                     </div>
                                                 </div>





                                                 <div class="form-group row">
                                                     <label class="col-sm-3 form-control-label label-sm">@lang('app.account_amount') ({{\App\classes\Common::getCurrencyText($employee_major->currancy)}}) </label>
                                                     <div class="col-sm-9">
                                                         <input id="tran_amount"  name= "amount" value="{{ $employee_major->salarySum($month,$year) }}"  placeholder="{{ __('app.enter_amount') }}" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }} form-control-success" type="text">
                                                     </div>
                                                 </div>

                                                 <div class="form-group row">
                                                     <label class="col-sm-3 form-control-label label-sm">@lang('app.account_amount_in_character') </label>
                                                     <div class="col-sm-9">
                                                         <input id="inputHorizontalSuccess"  name= "amount_in_character" value="{{ old('amount_in_character') }}"  placeholder="{{ __('app.account_amount_in_character') }}" class="form-control {{ $errors->has('amount_in_character') ? ' is-invalid' : '' }} form-control-success" type="text">
                                                     </div>
                                                 </div>



                                                 <div class="form-group row">
                                                     <label class="col-sm-3 form-control-label label-sm">	@lang('app.desc')</label>
                                                     <div class="col-sm-9">

                                                          <textarea name="desc" rows="3" cols="70" class="form-control {{ $errors->has('desc') ? ' is-invalid' : '' }}  form-control-success">{{ old('desc') }}</textarea>
                                                     </div>
                                                 </div>



                                                 <input type="hidden" name="emp_major_id" value="{{$emp_major_id}}" />
                                                 <input type="hidden" name="employee_month_of" value="{{$month}}" />
                                                 <input type="hidden" name="year_of" value="{{$year}}" />
                                                 <input type="hidden" name="transfer_type" value="{{$trans_type}}" />
                                                 <input type="hidden" name="action_type" value="add_emplyee_payment" />
                                                 <input type="hidden" name="expense_val" value="5" />
                                                 <input type="hidden" name="emp_id" value="{{$emp_id}}" />
                                                 <input type="hidden" name="from_person" value=" " />
                                                 <input type="hidden" name="majoremployee_month_year" value="{{$emp_major_id}}-{{$month}}-{{$year}}" />
                                                 <input type="hidden" name="currency" value="{{$employee_major->currancy}}" />


                                                 @if(is_int($branches))
                                                   <input type="hidden" name="branch_name" value="{{$branches}}" />

                                                    @else

                                                    <div class="form-group row">
                                                             <label class="col-sm-3 form-control-label label-sm">@lang('app.branch_name')</label>
                                                             <div class="col-sm-9">
                                                         <select name="branch_name" class="form-control">


                                                                      @foreach ($branches as $key => $branch)
                                                                        <option value="{{$branch->id}}" {{old('branch_name') == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
                                                                      @endforeach

                                                           </select>
                                                           </div>
                                                       </div>

                                                    @endif


                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label label-sm">	@lang('app.submit_user_name')</label>
                                                        <div class="col-sm-9">

                                                            {{ Auth::user()->name }}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label label-sm">  @lang('app.employee_name') </label>
                                                        <div class="col-sm-9">
                                                          {{$employee->employee_name}}

                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label label-sm">  @lang('app.in_job') </label>
                                                        <div class="col-sm-9">
                                                          {{$employee_major->majorData->title}}

                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label label-sm">  @lang('app.in_category') </label>
                                                        <div class="col-sm-9">
                                                          {{$employee_major->majorData->category->title}}

                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label label-sm">  @lang('app.in_branch') </label>
                                                        <div class="col-sm-9">
                                                          {{$employee_major->majorData->category->branch->branch_title}}

                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label class="col-sm-3 form-control-label label-sm">  @lang('app.basic_salary') </label>
                                                        <div class="col-sm-9">
                                                          {{$employee_major->current_salary}} {{\App\classes\Common::getCurrencyText($employee_major->currancy)}}

                                                        </div>
                                                    </div>
                                                    @include("ajax/ajax_salary_details_commaon")


                                                 <button type="submit" class="btn btn-primary">+ @lang('app.save') </button>
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
