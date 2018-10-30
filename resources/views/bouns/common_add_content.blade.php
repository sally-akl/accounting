
     <div class="form-group row">
             <label class="col-sm-3 form-control-label label-sm">    @lang('app.date')</label>
                 <div class="col-sm-9">
                      <input id="inputHorizontalSuccess" name= "bdate" value="{{ old('bdate') }}"  placeholder="{{ __('app.enter_date') }}" class="form-control {{ $errors->has('bdate') ? ' is-invalid' : '' }} form-control-success" type="date">
                 </div>
     </div>


    @if($emp_id == 0)
    <div class="form-group row">
     <label class="col-sm-3 form-control-label label-sm">	@lang('app.employee_major')</label>
     <div class="col-sm-9">
         <select name="emp_m_id" class="form-control {{ $errors->has('emp_m_id') ? ' is-invalid' : '' }}">
           @foreach ($employee_major as $key => $empmaj)
                   <option value="{{$empmaj->id}}" {{old('emp_m_id') == $empmaj->id ?"selected":""}}>	{{App\employee::find($empmaj->emplyee_id)->employee_name}} - {{App\major::find($empmaj->major_id)->title}}</option>
           @endforeach

         </select>
           <a href="{{ url('employeemajor/create/bouns/0') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>@lang('app.new_employee_salary')</a>
     </div>
 </div>
 @else
   <input type="hidden" name="emp_m_id" value="{{$emp_id}}" />
 @endif

 <input type="hidden" name="majoremployee_month_year" value="" />
 <input type="hidden" name="month_year" value="" />


 <div class="form-group row">
   <label class="col-sm-3 form-control-label label-sm">	@lang('app.sal_manage_extra_slary')</label>
   <div class="col-sm-9">
       <select name="sal_min_extra" class="form-control" >

         @foreach ($salary_settings as $key => $sett)
                           <option value="{{$sett->id}}"  >	{{$sett->title}} ( {{$sett->percentage}}% ) </option>
                         @endforeach

       </select>

   </div>
</div>


  <input type="hidden" name="action_after" value="bouns" />
