<form method="get" action="{{ url('salarysettings/search/all') }}/{{app()->getLocale()}}">
    @csrf

    <div class="form-group row">
        <label class="col-sm-2 form-control-label label-sm"> @lang('app.desc')</label>
        <div class="col-sm-10">
          <input id="inputHorizontalSuccess" name= "title"   placeholder=" @lang('app.desc')" class="form-control  form-control-success" type="text">
        </div>
      </div>
      <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
      <input type="hidden" name="mtype" value='{{$mtype}}'  />
      <button type="submit" class="btn btn-primary">@lang('app.Search') </button>
</form>
