<form method="get" action="{{ url('account/search') }}/{{app()->getLocale()}}">
    @csrf

    <div class="form-group row">
        <label class="col-sm-2 form-control-label label-sm">{{ __('app.bank_name') }}</label>
        <div class="col-sm-10">
          <input id="inputHorizontalSuccess" name= "bankname"   placeholder="{{ __('app.bank_name') }}" class="form-control  form-control-success" type="text">
        </div>
      </div>

      <div class="form-group row">
          <label class="col-sm-2 form-control-label label-sm"> @lang('app.account_num')</label>
          <div class="col-sm-10">
            <input id="inputHorizontalSuccess" name= "number"   placeholder="@lang('app.account_num')" class="form-control  form-control-success" type="text">
          </div>
        </div>


              <div class="form-group row">
                  <label class="col-sm-2 form-control-label label-sm"> @lang('app.balance_from')</label>
                  <div class="col-sm-10">
                    <input id="inputHorizontalSuccess" name= "from"   placeholder="@lang('app.balance_from')" class="form-control  form-control-success" type="text">
                  </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label label-sm"> @lang('app.balance_to')</label>
                    <div class="col-sm-10">
                      <input id="inputHorizontalSuccess" name= "to"   placeholder="@lang('app.balance_to')" class="form-control  form-control-success" type="text">
                    </div>
                  </div>


      <button type="submit" class="btn btn-primary"> @lang('app.Search') </button>
</form>
