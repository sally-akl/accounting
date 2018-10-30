@if($errors->has('title'))
@include("utility.error_messages")
@endif
<form method="POST" class="add_extra_salary_btn" action="{{ url('category/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
   @csrf
           @include("category.common_add_content")
     <button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
</form>
