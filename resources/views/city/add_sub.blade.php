
<form method="POST" action="{{ url('city/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
		 @csrf

		@if($errors->has('title') || $errors->has('country_value'))
	 	@include("utility.error_messages")
	 	@endif

     @include("city.common_add_content")
    	<button type="submit" class="btn btn-primary" style="margin-right: 2px;">+ {{ __('app.save') }} </button>

</form>
