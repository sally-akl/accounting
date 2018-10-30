

    <div class="form-group row">
     <label class="col-sm-3 form-control-label label-sm">	@lang('app.category_parent')</label>
     <div class="col-sm-9">
         <select name="parent" class="form-control">

           <option value="0">No Parent</option>
                     @foreach ($pcategories as $key => $cat)
                       <option value="{{$cat->id}}" {{old('parent') == $cat->id ?"selected":""}}>{{$cat->title}}</option>
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

        <div class="form-group row">
                <label class="col-sm-3 form-control-label label-sm">   @lang('app.category_name') </label>
                <div class="col-sm-9">
                    <input id="inputHorizontalSuccess" name= "title" value="{{ old('title') }}"  placeholder="{{ __('app.enter_category_name') }}" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }} form-control-success" type="text">
                </div>
            </div>

            <input type="hidden" name="where_from" value="{{$where_from}}" />
            <input type="hidden" name="is_ajax" value="<?php echo  isset($is_ajax)?$is_ajax:0;   ?>" />
