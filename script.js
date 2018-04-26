$(document).ready(function() {

	$(".menu-but").each(function() {
		$(this).click(function() {
			$name = $(this).attr('id');

			console.log("clicked" + $name);

			$(".content-page").each(function() {
				if (($(this).attr('id') + "-but") != $name) {
					//hide these
					$(this).fadeOut(200);
				} else {
					//show this one
					$(this).fadeIn(400);
				}
			});
		});
	})

	
});