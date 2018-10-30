function DeleteIt()
{
     var delete_elem = $(".deleted_btn");
     var delete_url  = "";
     var redirect_url : "",
     var extra_url:"",

     var delete = function(e)
     {
         var that = e.data.that;
         var id = $(this).attr("data-title");
         that.delete_url = that.delete_url+"/"+id+"/"+that.extra_url
         $.ajax({url:that.delete_url , success: function(result){
             result = JSON.parse(result);
             if(result.sucess)
                 window.location.href =that.redirect_url;
         }});
     }
     this.execute = function()
     {
          var that = this;
          that.delete_elem.off();
          that.delete_elem.click({that:that},that.delete);
     }
     this.setDeleteParameters = function(de , du , ru , eu)
     {
        this.delete_elem = de;
        this.delete_url = du;
        this.redirect_url = ru;
        this.extra_url = eu;
        return this;
     }
}
