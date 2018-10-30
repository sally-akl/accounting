<form method="get" action="{{ url('country/search') }}/{{app()->getLocale()}}">
    @csrf
      <div class="form-group row">
          <label class="col-sm-3 form-control-label label-sm"> @lang('app.country_name')</label>
          <div class="col-sm-9">
            <input id="inputHorizontalSuccess" name="title" placeholder="@lang('app.country_name')" class="form-control form-control-success" type="text">
          </div>
        </div>

        <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
        <button type="submit" class="btn btn-primary">@lang('app.Search') </button>

</form>
