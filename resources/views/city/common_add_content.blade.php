@if(isset($c) && $c != 0)
 <input type="hidden" name="country_value" value="{{$c}}" />
 <input type="hidden" name="redirect_to_country" value="0" />
@else

<div class="form-group row">
    <label class="col-sm-3 form-control-label label-sm">	@lang('app.country_name')</label>
    <div class="col-sm-9">
        <select name="country_value" class="form-control">
             @foreach ($countries_all  as $key => $country)
               <option value="{{$country->id}}" {{old('country_value') == $country->id ?"selected":""}}>{{$country->title}}</option>
             @endforeach
        </select>
    </div>
 </div>


 <input type="hidden" name="redirect_to_country" value="<?php echo  isset($redirect_to_country)?$redirect_to_country:0  ?>" />

@endif


<div class="form-group row">
   <label class="col-sm-3 form-control-label label-sm">   @lang('app.city_name') </label>
     <div class="col-sm-9">
          <input id="inputHorizontalSuccess" name= "title"  value="{{ old('title') }}"  placeholder="{{ __('app.enter_city_name') }}" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }} form-control-success" type="text">
     </div>
</div>

<input type="hidden" name="action_after" value="city" />
