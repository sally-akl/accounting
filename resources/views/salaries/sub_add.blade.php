 @include("utility.error_messages")
<form method="POST" action="{{ url('employeemajor/store') }}/{{app()->getLocale()}}?branch={{ Request::query('branch') }}" class="add_emp_major_form">
	@csrf
   @include("salaries.common_add_content")
<button type="submit" class="btn btn-primary add_emp_major">+ {{ __('app.save') }} </button>
</form>
