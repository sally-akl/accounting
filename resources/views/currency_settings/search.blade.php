<form method="get" action="{{ url('currency/search') }}/{{app()->getLocale()}}">
    @csrf

   <div class="form-group row">
          <label class="col-sm-2 form-control-label label-sm"> @lang('app.date')</label>
          <div class="col-sm-10">
            <input id="inputHorizontalSuccess" name= "search_date"   placeholder="@lang('app.date')" class="form-control  form-control-success" type="date">
          </div>
    </div>

      <button type="submit" class="btn btn-primary"> @lang('app.Search') </button>
</form>
