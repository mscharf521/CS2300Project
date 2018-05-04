$(document).ready(function() {

	//This code toggles prompts when pressing the buttons at the bottom of the tables
	$("#add-player-but").click(function() {
		$("#add-player-div").show();
		$("#del-player-div").hide();
		$("#ups-player-div").hide();
	});

	$("#del-player-but").click(function() {
		$("#add-player-div").hide();
		$("#del-player-div").show();
		$("#ups-player-div").hide();
	});

	$("#ups-player-but").click(function() {
		$("#add-player-div").hide();
		$("#del-player-div").hide();
		$("#ups-player-div").show();
	});


	
});