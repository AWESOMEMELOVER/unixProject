$(function() {

			//Store frequently elements in variables
			var cross  = $('#cross').slider({
				min:0,
				max:100
			});

			var slider2  = $('#slider2').slider({
				min:0,
				max:100,
				orientation: "vertical"

			});

			var roundSlider = $(".roundSlider").CircularSlider({
				min:0,
				max:100,
				radius:35
			});

			var roundSlider2 = $(".roundSlider2").CircularSlider({
				min:0,
				max:100,
				radius:35
			});		
			
			var roundSlider3 = $(".roundSlider3").CircularSlider({
				min:0,
				max:100,
				radius:35
			});		

		});