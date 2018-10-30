@include("utility.error_messages")
<form method="POST" action="{{ url('discount/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
     @csrf
     @include("discount.common_add_content")
     <button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
</form>
