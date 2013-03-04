jQuery(function($) {

   // Handle league to team
   $("#PlayerLeagueId")
   .live("change", function (event) {
      $.ajax({
         async:true, 
         data:$("#PlayerLeagueId").serialize(), 
         dataType:"html", 
         success:function (data, textStatus) {
            $("#PlayerTeamId").html(data);
         },
         type:"post", 
         url: home_url + "teams/byleague"
      });
      event.preventDefault();
   });

   // Fill in jersey
   $("#PlayerLastName")
   .live("blur", function (event) {
      if ($('#PlayerJerseyName').val() == '') 
         $('#PlayerJerseyName').val($(this).val().toUpperCase());
      event.preventDefault();
   });

   // Validation
   $('.required input')
   .live("blur", function (event) {
      validateForm($(this));
      event.preventDefault();
   });
   
   var forceSubmit = false;
   $("#pop-edit")
   .live("submit", function (event) {
      if (forceSubmit) return true;
      $.ajax({
         async:false, 
         data:$(this).serialize(), 
         dataType:"json", 
         success:function (errors, textStatus) {
            if (errors)
            {
               for (var prop in errors)
               {
                  ctl = '#' + prop;
                  $(ctl).parent().addClass('error');
                  if ($(ctl).siblings('.error-message').length == 0)
                  {
                     $(ctl).after('<div class="error-message">' + errors[prop] + '</div>');                 
                  }
               }               
            }
            else
            {
               forceSubmit = true;
               $('#pop-edit').submit();
            }
         }, 
         type:"post", 
         url: home_url + 'players/validate_form'
      });
      event.preventDefault();
   });
   
});

function validateForm(ctl)
{
   $.post(
      home_url + 'players/validate_field',
      { name: $(ctl).attr('name'), value: $(ctl).val() },
      function (error) {
        if (error.length > 0) {
           $(ctl).parent().addClass('error');
           if ($(ctl).siblings('.error-message').length == 0)
           {
              $(ctl).after('<div class="error-message">' + error + '</div>');                 
           }
        } 
        else
        {
           $(ctl).parent().removeClass('error');
           $(ctl).siblings('.error-message').remove();
        }
      });
}
