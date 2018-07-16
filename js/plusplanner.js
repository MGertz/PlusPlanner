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

/*
$( function() {
	$("#ScrimCreateDatePicker").datepicker({
		format: "yyyy-mm-dd",
		weekStart: 1,
		language: "da",
		daysOfWeekHighlighted: "0,6",
		calendarWeeks: true,
		autoclose: true

	});
})
*/
$( function() {
	$("#ScrimCreateDatePicker").datetimepicker({
		language: 'da',
		format: "d. MM yyyy h:ii",
		calendarWeeks: true,
		weekStart: 1,
		linkField: "DatetimePickerHidden",
		linkFormat: "yyyy-mm-dd hh:ii:00",
		autoclose: true

	});


})


console.log("It works");