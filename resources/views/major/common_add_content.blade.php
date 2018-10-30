
																									 <div class="form-group row">
																										<label class="col-sm-3 form-control-label label-sm">	@lang('app.category_name')</label>
																										<div class="col-sm-9">
																												<select name="category" class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}">

																													@foreach ($categories as $key => $category)
 																																					<option value="{{$category->id}}" {{old('category') == $category->id ?"selected":""}}>{{$category->title}}</option>
 																																				 @endforeach


																												</select>

																										</div>
																								</div>

																											 <div class="form-group row">
																															 <label class="col-sm-3 form-control-label label-sm">   @lang('app.major_name') </label>
																															 <div class="col-sm-9">
																																	 <input id="inputHorizontalSuccess" name= "title" value="{{ old('title') }}"  placeholder="{{ __('app.enter_major_name') }}" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }} form-control-success" type="text">
																															 </div>
																													 </div>

																													 <input type="hidden" name="where_from" value="{{$where_from}}" />
																													 <input type="hidden" name="is_ajax" value="<?php echo  isset($is_ajax)?$is_ajax:0;   ?>" />
