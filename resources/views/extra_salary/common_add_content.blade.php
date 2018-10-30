
    @if($emp_id == 0)
    <div class="form-group row">
     <label class="col-sm-3 form-control-label label-sm">	@lang('app.employee_major')</label>
     <div class="col-sm-9">
         <select name="emp_m_id" class="form-control  {{ $errors->has('emp_m_id') ? ' is-invalid' : '' }} ">


           @foreach ($employee_major as $key => $empmaj)
                         <option value="{{$empmaj->id}}" {{old('emp_m_id') == $empmaj->id ?"selected":""}}>	{{App\employee::find($empmaj->emplyee_id)->employee_name}} - {{App\major::find($empmaj->major_id)->title}}</option>
                       @endforeach

         </select>
           <a href="{{ url('employeemajor/create/extrasalary/0') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>@lang('app.new_employee_salary')</a>
     </div>
 </div>
 @else
   <input type="hidden" name="emp_m_id" value="{{$emp_id}}" />
 @endif



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
