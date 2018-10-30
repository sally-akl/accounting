<form method="get" action="{{ url('quote/search') }}/{{app()->getLocale()}}">
    @csrf

      <div class="input-group stylish-input-group">
          <input type="text" class="form-control"  name="subject" placeholder="Search" >
          <span class="input-group-addon">
              <button type="submit">
                      <i class="fas fa-search"></i>
          </span>
      </div>
        <input type="hidden" name="branch" value='{{ Request::query("branch") }}'  />
</form>
