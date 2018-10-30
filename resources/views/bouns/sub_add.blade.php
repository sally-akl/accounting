@include("utility.error_messages")
<form method="POST" class= "save_bouns_form" action="{{ url('bouns/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
   @csrf
     @include("bouns.common_add_content")
   <button type="button" class="btn btn-primary save_bouns_btn">+ {{ __('app.save') }} </button>
</form>
