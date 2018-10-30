@if($errors->has('title'))
@include("utility.error_messages")
@endif
<form method="POST" action="{{ url('salarysettings/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
   @csrf


        <div class="form-group row">
                <label class="col-sm-3 form-control-label label-sm">   @lang('app.desc') </label>
                <div class="col-sm-9">
                    <input id="inputHorizontalSuccess" name= "mtitle" value="{{ old('mtitle') }}"  placeholder="{{ __('app.desc') }}" class="form-control {{ $errors->has('mtitle') ? ' is-invalid' : '' }} form-control-success" type="text">
                </div>
            </div>

            <div class="form-group row">
                    <label class="col-sm-3 form-control-label label-sm">   @lang('app.percentage') </label>
                    <div class="col-sm-9">

                        <input id="inputHorizontalSuccess" name= "percent" value="{{ old('percent') }}"  placeholder="{{ __('app.percentage') }}" class="form-control {{ $errors->has('percent') ? ' is-invalid' : '' }} form-control-success" type="text">
                    </div>
                </div>

                <div class="form-group row">
                 <label class="col-sm-3 form-control-label label-sm">  @lang('app.per_type')</label>
                 <div class="col-sm-9">
                     <select name="vtype" class="form-control">
                       <option value="percentage" selected="">@lang('app.Percentage')</option>
                           <option value="amount">@lang('app.Fix')</option>
                     </select>

                 </div>
             </div>

            <input type="hidden" name="ty" value='{{$mtype}}'  />

     <button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
</form>
