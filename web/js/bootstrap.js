$("#module-menu-bootstrap").on("submit", function(e) {

	var data = $(this).serialize();

	$.ajax($(this).attr("action"), {
		data: data,
		success: function() {
			$("#module-menu-bootstrap-prompt").slideUp(function() {
				$(this).remove();
			});
		}, 
		error: function(data) {
			alert(data)
		}
	})

	e.stopPropagation();
	return false;
})


$("#module-menu-bootstrap button[type=submit]").on("click", function() {
	$("#module-enabled").val($(this).attr("data-value"));
})