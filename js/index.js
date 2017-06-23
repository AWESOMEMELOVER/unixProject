$(function() {
			 var handle = $( "#custom-handle" );
			//Store frequently elements in variables
			var cross  = $('#cross').slider({
				min:0,
				max:100,
				create: function() {
					handle.text( $( this ).slider( "value" ) );
      				},
				slide: function( event, ui ) {
					handle.text( ui.value );
					}
			});
    
            var cross  = $('#cross2').slider({
				min:0,
				max:100
			});

			var slider2  = $('#slider2').slider({
				min:0,
				max:100
			});

			var roundSlider1 = $(".roundSlider1").CircularSlider({
				min:-100,
				max:100,
				radius:35
			});

			var roundSlider2 = $(".roundSlider2").CircularSlider({
				min:-100,
				max:100,
				radius:35
			});		
			
			var roundSlider3 = $(".roundSlider3").CircularSlider({
				min:-100,
				max:100,
				radius:35
			});		
    
            var roundSlider4 = $(".roundSlider4").CircularSlider({
				min:-100,
				max:100,
				radius:35
			});

			var roundSlider5 = $(".roundSlider5").CircularSlider({
				min:-100,
				max:100,
				radius:35
			});		
			
			var roundSlider6 = $(".roundSlider6").CircularSlider({
				min:-100,
				max:100,
				radius:35
			});		
            var myDropzone = new Dropzone("div#my-awesome-dropzone", { url: "/file/post"});       
    
        
    

		});