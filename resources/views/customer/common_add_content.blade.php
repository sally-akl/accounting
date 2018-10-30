
																									<div class="form-group row">
																													<label class="col-sm-3 form-control-label label-sm">   @lang('app.customer_name') </label>
																													<div class="col-sm-9">
																															<input id="inputHorizontalSuccess" name= "fullname"  value="{{ old('fullname') }}" placeholder="{{ __('app.enter_full_name') }}" class="form-control {{ $errors->has('fullname') ? ' is-invalid' : '' }} form-control-success" type="text">
																													</div>
																											</div>

																											<div class="form-group row">
																															<label class="col-sm-3 form-control-label label-sm">   @lang('app.customer_email') </label>
																															<div class="col-sm-9">
																																	<input id="inputHorizontalSuccess" name= "email"  value="{{ old('email') }}" placeholder="{{ __('app.enter_customer_email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} form-control-success" type="text">
																															</div>
																													</div>

																													<div class="form-group row">
																																	<label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_address') </label>
																																	<div class="col-sm-9">
																																			<input id="inputHorizontalSuccess" name= "address" value="{{ old('address') }}"  placeholder="{{ __('app.enter_customer_address') }}" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }} form-control-success" type="text">
																																	</div>
																															</div>

																															<div class="form-group row">
																																			<label class="col-sm-3 form-control-label label-sm">   @lang('app.employee_phone') </label>
																																			<div class="col-sm-9">
																																					<input id="inputHorizontalSuccess" name= "phone" value="{{ old('phone') }}"   placeholder="{{ __('app.enter_customer_phone') }}" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }} form-control-success" type="text">
																																			</div>
																																	</div>

																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">	@lang('app.customer_city')</label>
																										<div class="col-sm-9">
																												<select name="city_val" class="form-control {{ $errors->has('city_val') ? ' is-invalid' : '' }}">
																													@foreach ($citites as $key => $city)
																															<option value="{{$city->id}}" {{old('city_val') == $city->id ?"selected":""}}>{{$city->title}}</option>
																													@endforeach

																												</select>

																										</div>
																								</div>


																								@if(is_int($branches))
																									<input type="hidden" name="branch_name" value="{{$branches}}" />

																									 @else

																									 <div class="form-group row">
																														<label class="col-sm-3 form-control-label label-sm">@lang('app.branch_name')</label>
																														<div class="col-sm-9">
																												<select name="branch_name" class="form-control">


																																		 @foreach ($branches as $key => $branch)
																																			 <option value="{{$branch->id}}" {{old('branch_name') == $branch->id ?"selected":""}}>{{$branch->branch_title}}</option>
																																		 @endforeach

																													</select>
																													</div>
																											</div>

																									 @endif
