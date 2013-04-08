$(function(){
	$('div.test-form div.sprite.close').click(function(){
		$(this).css('display','none');
		$('div.test-form div.form-active').css('display','block');
	});
	$('div.test-form div.form-active div.sprite.open').click(function(){
		$('div.test-form div.form-active').css('display','none');
		$('div.test-form div.sprite.close').css('display','block');
	});
});
var Share = {
		staticgo: function(){
			$.ajax({
				type: 'POST',
				url : 'index.php/test/test',
				dataType: 'html',
				success: function(response) {
					$('div.test-form div.form-active textarea.form-window').text(response);
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					return false;
				}
			});
		},
}
Share.staticgo();
setInterval('Share.staticgo();', 5000);