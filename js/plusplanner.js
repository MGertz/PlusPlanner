if( window.canRunAds === undefined ){
	
		
		// adblocker detected, show fallback
		//showFallbackImage();
		console.log("Der kan ikke vises reklamer på denne klient");
		
		$(window).on('load',function(){
			$('#modalAds').modal('show');
		});

	

	
}


$("#ModalBattleTag").keyup(function() {
	var battletag = $("#ModalBattleTag").val();

	console.log("search for tag " + battletag);

	$.ajax({
		type: "GET",
		url: '/OverWatch/api_get_battletags/' + battletag,
		success: function( tags ) {
			console.log(tags);
			
			$("#BattleTagList").empty();

			$.each(tags, function(i, tag ) { 
				$("#BattleTagList").append('<option value="' + tag +  '">');
				
				
				console.log("Tag: " + tag);
			});
			
		},
		dataType: "json"
	});




});
console.log("It works");