<form method="POST" action="{{ url('customerrequests/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}">
	@csrf
  @include("customer_requests.common_add_content")
  <button type="submit" class="btn btn-primary">+ {{ __('app.save') }} </button>
</form>
