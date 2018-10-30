
	@include("utility.error_messages")

	<div class="form-group row">
					<label class="col-sm-3 form-control-label label-sm">@lang('app.date') </label>
					<div class="col-sm-9">

							<input id="inputHorizontalSuccess" name= "r_date"  value="{{ old('r_date') }}"  placeholder="{{ __('app.r_date') }}" class="form-control {{ $errors->has('r_date') ? ' is-invalid' : '' }} form-control-success" type="date">
					</div>
			</div>



					<div class="form-group row">
									<label class="col-sm-3 form-control-label label-sm">  @lang('app.subject') </label>
									<div class="col-sm-9">
											<input id="inputHorizontalSuccess" name= "subject"  value="{{ old('subject') }}" placeholder="{{ __('app.subject') }}" class="form-control {{ $errors->has('subject') ? ' is-invalid' : '' }}  form-control-success" type="text">
									</div>
					</div>

					<div class="form-group row">
									<label class="col-sm-3 form-control-label label-sm">@lang('app.message') </label>
									<div class="col-sm-9">
										<textarea rows="10" cols="55"  name="message" ></textarea>


							</div>
				  </div>



            <input type="hidden" name="type_val" value="complain" />
					  <input type="hidden" name="customer_val" value="{{$id}}" />
