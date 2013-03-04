$(document).ready(function () {$("#PlayerName").bind("keyup", function (event) {$.ajax({async:true, data:$("#PlayerName").serialize(), dataType:"html", success:function (data, textStatus) {$("#view").html(data);}, type:"post", url:"\/rbadmin\/"});
return false;});
$("#PlayerLastName").bind("blur", function (event) {if ($('#PlayerJerseyName').val() == '') $('#PlayerJerseyName').val($(this).val());
return false;});});