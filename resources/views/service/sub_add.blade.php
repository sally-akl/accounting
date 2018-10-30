@if($errors->has('stitle'))
@include("utility.error_messages")
@endif
<form method="POST" action="{{ url('service/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
  @csrf
   <div class="form-group row">
       <label class="col-sm-2 form-control-label label-sm">  @lang('app.service_name') </label>
       <div class="col-sm-10">
         <input id="inputHorizontalSuccess" name= "stitle" value="{{ old('stitle') }}"  placeholder="{{ __('app.enter_service_name') }}" class="form-control {{ $errors->has('stitle') ? ' is-invalid' : '' }} form-control-success" type="text">
       </div>
     </div>
     <div class="form-group row">
                 <label class="col-sm-2 form-control-label label-sm">@lang('app.service_parent')</label>
                 <div class="col-sm-10">
             <select name="parent" class="form-control">

               <option value="0">No Parent</option>
                          @foreach ($pservices as $key => $serv)
                            <option value="{{$serv->id}}" {{old('parent') == $serv->id ?"selected":""}}>{{$serv->title}}</option>
                          @endforeach

               </select>
               </div>
           </div>


           <div class="form-group row">
            <label class="col-sm-2 form-control-label label-sm">	@lang('app.category_parent')</label>
            <div class="col-sm-10">
                <select name="category" class="form-control">
                            @foreach ($pcategories as $key => $cat)
                              <option value="{{$cat->id}}" {{old('category') == $cat->id ?"selected":""}}>{{$cat->title}}</option>
                            @endforeach

                </select>

            </div>
        </div>
        <input type="hidden" name="action" value="{{$action}}" />
     	<button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
   </form>
