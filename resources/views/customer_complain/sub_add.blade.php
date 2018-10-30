<form method="POST" action="{{ url('customercomplain/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
	@csrf
	  @include("customer_complain.common_add_content")
		<button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>

</form>
