<form method="get" action="{{ url('extrasalary/search/all') }}/{{app()->getLocale()}}">
    @csrf
    <div class="form-group row">
        <label class="col-sm-3 form-control-label label-sm"> @lang('app.sal_manage_extra_slary')</label>
        <div class="col-sm-9">
          <select class="form-control m-input" name="sal_min" >

            @foreach ($salary_settings as $key => $sett)
                              <option value="{{$sett->id}}"  >	{{$sett->title}} ( {{$sett->percentage}}% ) </option>
                            @endforeach

          </select>
        </div>
      </div>
      <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
      <input type="hidden" name="emp_m_id" value="{{$emp_id}}" />
      <button type="submit" class="btn btn-primary">@lang('app.Search') </button>
</form>
