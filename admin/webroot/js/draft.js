jQuery(function($){
   $('.undo').live("click", function(){
      var playerId = $(this).attr('rel');
      $.ajax({
         url:  home_url + 'players/draft_undo',
         data: 'player=' + playerId + '&league=' + leagueId,
         cache: false,
         success: function(data)
         {
            $('#team-list').html(data);
            $('#p'+playerId).show();
            player = $('#p'+playerId).html()
            $('#message').prepend('Unpicked ' + player + '<br/>');
            $.getScript('/js/team-status.js');
         }
      });
   });
   
   $('.player').click(function(){
      var team = $('#team').val();
      if (team == '')
      {
         alert('Please select a team.');
         return;
      }
      var playerId = $(this).attr ('rel');
      var player = $(this).html();
      var message = 'The ' + teams[team] + ' select ' + player;
      var choose = confirm(message);
      if (choose)
      {
         $(this).hide('slow');
         $('#indicator').show();
         $.ajax({
            url:  home_url + 'players/draft_choose',
            data: 'team=' + team + '&player=' + playerId + '&league=' + leagueId,
            cache: false,
            success: function(data)
            {
               $('#team-list').html(data);
               $('#message').prepend('<a href="#" class="undo" rel="' + playerId + '">Undo</a> ' + message + '<br/>');
               $('#indicator').hide();
               $.getScript('/js/team-status.js');
            }
         });
      }
   });
});