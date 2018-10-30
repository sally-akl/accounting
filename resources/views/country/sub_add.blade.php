<form method="POST" action="{{ url('country/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
	@csrf
	@if($errors->has('ctitle'))
	@include("utility.error_messages")
	@endif



					<div class="form-group row">
									<label class="col-sm-3 form-control-label label-sm">  @lang('app.country_name') </label>
									<div class="col-sm-9">
											<input id="inputHorizontalSuccess" name= "ctitle"  value="{{ old('title') }}" placeholder="{{ __('app.enter_country_name') }}" class="form-control {{ $errors->has('ctitle') ? ' is-invalid' : '' }} form-control-success" type="text">
									</div>
							</div>

					 <input type="hidden" name="where_from" value="{{$where_from}}" />
					 <input type="hidden" name="action_after" value="country" />
					<button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>

</form>
