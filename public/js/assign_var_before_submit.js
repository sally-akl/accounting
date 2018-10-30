var assignBeforeSubmit = new function()
{
    var self = this;
    var click_button = submit_form = null;
    var assign_to_vars = {};
    var _current_key = "";

    this.setClickButton = function(btn)
    {
        if(btn instanceof jQuery)
           self.click_button = btn;
        return self;
    }

    this.setSubmitForm = function(f)
    {
      if(f instanceof jQuery)
        self.submit_form = f;
      return self;
    }
    this.setKey = function(k)
   {
       _current_key = k;
       assign_to_vars[k] = [];
       return self;
   }
   this.setValues = function(v)
  {
      if(_current_key != "")
       assign_to_vars[_current_key].push(v);
      return self;
  }
  this.Execute = function(callback)
  {
      self.click_button.off();
      self.click_button.on("click",function(){
          var _c = "";
          callback.before();
          _.each(assign_to_vars , function(v,k)
            {
                _.each(v, function(vv)
                {
                    _c += $(vv).val()+"-";
                });
                _c = _c.substring(0, _c.length - 1);
                $(k).val(_c);
                _c = "";
           });
           callback.after();
           self.submit_form.submit();

      });
  }


}
