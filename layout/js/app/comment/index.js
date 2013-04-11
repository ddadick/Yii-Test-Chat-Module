$(document).ready(function() {
	$('#myCommentId').submit(function() { 
		var options = {
			url:Test.baseUrl+'comment/add',
			dataType: 'json',
			type:'post',
			success: function(resp){
				if(resp.status=='OK'){
					$('#comment-list').empty().html(resp.html);
					Wall.comment_link(true);
				}else{
					$('#myCommentId').replaceWith(resp.html);
				}
			}
		};
    	$(this).ajaxSubmit(options); 
	    // return false to prevent normal browser submit and page navigation 
    	return false; 
	});
});