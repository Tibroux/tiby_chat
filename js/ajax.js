$(document).ready(function(){
	var message_id;
	$('body .content form ul li').click(function(){
		message_id = $(this).attr('data-id');
		function(){
			location.reload();
		});
	});
});