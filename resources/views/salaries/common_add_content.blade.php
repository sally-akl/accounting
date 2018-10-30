@if($emp_id != 0)
  <input type="hidden" name="employee_val" class="employee_val" value="{{$emp_id}}" />
@else
 <div class="form-group row">
  <label class="col-sm-3 form-control-label label-sm">@lang('app.employee_name')</label>
  <div class="col-sm-9">
      <select name="employee_val" class="form-control employee_val {{ $errors->has('employee_val') ? ' is-invalid' : '' }}">


        @foreach ($employees as $key => $emp)
            <option value="{{$emp->id}}" {{old('employee_val') == $emp->id ?"selected":""}}>{{$emp->employee_name}}</option>
        @endforeach

      </select>
      <!--
        <a href="{{ url('employee/create/employeemajor') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>@lang('app.new_employee')</a>
      -->
  </div>
</div>
@endif

<div class="form-group row">
<label class="col-sm-3 form-control-label label-sm">@lang('app.major_name')</label>
<div class="col-sm-9">
   <select name="major_val" class="form-control major_val {{ $errors->has('major_val') ? ' is-invalid' : '' }}">
     @foreach ($majors as $key => $maj)
              <option value="{{$maj->id}}" {{old('major_val') == $maj->id ?"selected":""}}>{{$maj->title}}</option>
     @endforeach

   </select>


</div>
</div>




     <div class="form-group row">
             <label class="col-sm-3 form-control-label label-sm">   	@lang('app.employee_join_data')  </label>
             <div class="col-sm-9">
                 <input id="inputHorizontalSuccess" name= "join_date"  value="{{ old('join_date') }}"  placeholder="{{ __('app.enter_employee_join_date') }}" class="form-control {{ $errors->has('join_date') ? ' is-invalid' : '' }} form-control-success" type="date">
             </div>
         </div>

         <div class="form-group row">
                 <label class="col-sm-3 form-control-label label-sm">   	@lang('app.employee_salary')  </label>
                 <div class="col-sm-9">
                     <input id="inputHorizontalSuccess" name= "salary"  value="{{ old('salary') }}" placeholder="{{ __('app.enter_emp_salary') }}" class="form-control {{ $errors->has('salary') ? ' is-invalid' : '' }} form-control-success" type="text">
                 </div>
             </div>



             <div class="form-group row">
             <label class="col-sm-3 form-control-label label-sm">@lang('app.cur_currency')</label>
             <div class="col-sm-9">
                <select name="currency" class="form-control major_val {{ $errors->has('currency') ? ' is-invalid' : '' }}">
                    <option value="SAR" >@lang('app.sar_currency')</option>
                    <option value="EGP" >@lang('app.egp_currency')</option>
                    <option value="USD" >@lang('app.usd_currency')</option>
                </select>


             </div>
             </div>



             <div class="form-group row">
                     <label class="col-sm-3 form-control-label label-sm">  	@lang('app.employee_current')   </label>
                     <div class="col-sm-9">
                          <input type="checkbox"  name= "is_current" class="is_current">
                     </div>
                 </div>

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

<input type="hidden" name="compond_emp_major" class="compond_emp_major" />
<input type="hidden" name="compond_emp_major_current" class="compond_emp_major_current" />
<input type="hidden" name="where_from" value="{{$where_from}}" />
