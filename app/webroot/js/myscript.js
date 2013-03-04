$(document).ready(function () {
   $("#PlayerName")
   .bind("keyup", function (event) {
      $.ajax({
         async:true, 
         data:$("#PlayerName").serialize(), 
         dataType:"html", 
         success:function (data, textStatus) {
            $("#view").html(data);
         }, 
         type:"post", 
         url: $home_url
      });
      event.preventDefault();
   });
   
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
         url:"\/rbadmin\/teams\/byleague"
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
});