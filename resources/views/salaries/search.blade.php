<form method="get" action="{{ url('employeemajor/search') }}/{{app()->getLocale()}}">
    @csrf
    <div class="form-group row">
        <label class="col-sm-2 form-control-label label-sm"> @lang('app.employee_name')</label>
        <div class="col-sm-10">
          <select class="form-control" name="employee_val" >

                @foreach ($employees as $key => $emp)
                  <option value="{{$emp->id}}">{{$emp->employee_name}}</option>
                @endforeach
          </select>
        </div>
      </div>
      <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
      <input type="hidden" name="emp" value='{{$emp_id}}'  />
      <button type="submit" class="btn btn-primary">@lang('app.Search') </button>
</form>
