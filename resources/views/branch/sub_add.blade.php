
@if($errors->has('btitle') || $errors->has('email') || $errors->has('city'))
@include("utility.error_messages")
@endif
<form method="POST" action="{{ url('branch/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
   @csrf


   <div class="form-group row">
           <label class="col-sm-3 form-control-label label-sm">   @lang('app.branch_name') </label>
           <div class="col-sm-9">
               <input id="inputHorizontalSuccess" name= "btitle" value="{{ old('btitle') }}"  placeholder="{{ __('app.branch_name') }}" class="form-control {{ $errors->has('btitle') ? ' is-invalid' : '' }} form-control-success" type="text">
           </div>
       </div>

       <div class="form-group row">
               <label class="col-sm-3 form-control-label label-sm">   @lang('app.email') </label>
               <div class="col-sm-9">
                   <input id="inputHorizontalSuccess" name= "email" value="{{ old('email') }}"  placeholder="{{ __('app.enter_email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} form-control-success" type="text">
               </div>
           </div>


           <div class="form-group row">
                   <label class="col-sm-3 form-control-label label-sm">   @lang('app.phone') </label>
                   <div class="col-sm-9">
                       <input id="inputHorizontalSuccess" name= "phone" value="{{ old('phone') }}"  placeholder="{{ __('app.phone') }}" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }} form-control-success" type="text">
                   </div>
               </div>

               <div class="form-group row">
                       <label class="col-sm-3 form-control-label label-sm">@lang('app.address') </label>
                       <div class="col-sm-9">
                         <textarea rows="10" cols="70"  name="address" ></textarea>


                        </div>
                </div>

             <div class="form-group row">
              <label class="col-sm-3 form-control-label label-sm">	@lang('app.city_name')</label>
              <div class="col-sm-9">
                  <select name="city" class="form-control city_name">
                       @foreach ($cities as $key => $city)
                         <option value="{{$city->id}}" {{old('city') == $city->id ?"selected":""}}>{{$city->title}}</option>
                       @endforeach
                  </select>

              </div>
          </div>

        <button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
</form>
