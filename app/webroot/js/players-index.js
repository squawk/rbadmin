jQuery(function(){
   // filter
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
         url: home_url + 'players'
      });
      event.preventDefault();
   });
   // Popup edit
	$('.edit-window').live('click', function(e) {
      $.ajax({
         url:     $(this).attr('href'),
         cache:   false,
         success: function(data)
         {
      	   $('<div></div>')
         		.html(data)
         		.dialog({
         			autoOpen: false,
         			title: 'Edit Player',
         			width: 700,
         			modal: true
         		}).dialog('open');
         }
      });
		// prevent the default action, e.g., following a link
      e.preventDefault();
	});
});
