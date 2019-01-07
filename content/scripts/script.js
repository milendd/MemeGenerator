$(function() {
	$('#messages .close-btn').click(function(e) {
		var parent = $(this).parent();
		parent.remove();
	});
});
