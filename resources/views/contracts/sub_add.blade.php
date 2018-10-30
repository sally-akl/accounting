@if($errors->has('jtitle'))
@include("utility.error_messages")
@endif
<form method="POST" action="{{ url('job/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
   @csrf

    <div class="form-group row">
     <label class="col-sm-3 form-control-label label-sm">@lang('app.category')</label>
     <div class="col-sm-9">
         <select name="category" class="form-control">

                        @foreach ($pcategories as $key => $cat)
                           <option value="{{$cat->id}}" {{old('category') == $cat->id ?"selected":""}}>{{$cat->title}}</option>
                         @endforeach

         </select>
          @if($show_href)
           <a href="{{ url('category/create/job') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" style="text-decoration:none;color:#000;"><i class="fa fa-plus" style="margin-right: 5px;"></i>@lang('app.new_category')</a>
           @endif
     </div>
 </div>

        <div class="form-group row">
                <label class="col-sm-3 form-control-label label-sm">   @lang('app.job_name') </label>
                <div class="col-sm-9">
                    <input id="inputHorizontalSuccess" name= "jtitle"  value="{{ old('jtitle') }}"  placeholder="{{ __('app.enter_job_name') }}" class="form-control {{ $errors->has('jtitle') ? ' is-invalid' : '' }} form-control-success" type="text">
                </div>
            </div>

     <button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
</form>
