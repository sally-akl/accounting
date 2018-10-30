<form method="get" action="{{ url('customercomplain/search/all') }}/{{app()->getLocale()}}">
    @csrf
        <div class="form-group row">
            <label class="col-sm-3 form-control-label label-sm">@lang('app.date') </label>
            <div class="col-sm-9">

                <input id="inputHorizontalSuccess" name= "rr_date"    placeholder="{{ __('app.r_date') }}" class="form-control form-control-success" type="date">
            </div>
        </div>

            <div class="form-group row">
                    <label class="col-sm-3 form-control-label label-sm">  @lang('app.subject') </label>
                    <div class="col-sm-9">
                        <input id="inputHorizontalSuccess" name= "subjectt"   placeholder="{{ __('app.subject') }}" class="form-control form-control-success" type="text">
                    </div>
            </div>

            <div class="form-group row">
                    <label class="col-sm-3 form-control-label label-sm">@lang('app.status') </label>
                    <div class="col-sm-9">
                      <select name="status" class="form-control">
                         <option value="0">----</option>
                         <option value="1">@lang('app.open')</option>
                         <option value="2">@lang('app.close')</option>

                       </select>

                    </div>
                </div>

        <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
        <input type="hidden" name="customer_val" value="{{$id}}" />
        <button type="submit" class="btn btn-primary">@lang('app.Search') </button>

</form>
