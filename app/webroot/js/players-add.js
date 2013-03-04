function formatItem(row)
{
	return '<strong>' + row[0] + '</strong>' + '<br><span style="font-size: 80%;">Birthdate: &lt;' + row[1] + '&gt;</span>';
}
jQuery(function($) {
   // copy player from last year
	$('#name').autocomplete(
		home_url + 'players/search',
		{
		width: 400,
		mustMatch: true,
		matchContains: false,
		scrollHeight: 220,
		formatItem: formatItem
	}).focus();
   $("#name").result(function(event, data, formatted) {
      if (data == undefined) return;
      $('#PlayerFirstName').val(data[2]);
      $('#PlayerLastName').val(data[3]);
      $('#PlayerBirthdate').val(data[1]);
      $('#PlayerAddress').val(data[5]);
      $('#PlayerCity').val(data[6]);
      $('#PlayerZip').val(data[7]);
      $('#PlayerDadsName').val(data[8]);
      $('#PlayerMomsName').val(data[9]);
      $('#PlayerDayPhone').val(data[10]);
      $('#PlayerEveningPhone').val(data[11]);
      $('#PlayerCellPhone').val(data[12]);
      $('#PlayerEmail').val(data[13]);
      $('#PlayerSchoolBoundary').val(data[15]);
      $('#PlayerJerseyName').val(data[16]);
      $('#PlayerBirthCertificate').attr('checked', 'checked');
      $('#PlayerAddressVerify').attr('checked', 'checked');
      $('#PlayerLastTeam').val(data[14]);
      $('#player-message').show().html('<div class="success">Player information copied below. Please fill in remanding fields. Click SUBMIT to save.</div>').delay(5000).fadeOut();
      $('#PlayerLeagueId').change();
   });
//	$('.ac_results').bgiframe();   
});
