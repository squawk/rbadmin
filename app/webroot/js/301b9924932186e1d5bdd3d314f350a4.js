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
   
   $("#PlayerLastName")
   .live("blur", function (event) {
      if ($('#PlayerJerseyName').val() == '') 
         $('#PlayerJerseyName').val($(this).val());
      event.preventDefault();
   });
});