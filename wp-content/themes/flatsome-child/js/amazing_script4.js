
(function ($) {
	$(window).on('load', (function() {
          
          $('#mega-menu-wrap').css("visibility","hidden");
          $('#wpmm-wrap-home-page-only').css("visibility","hidden");

        }))  ;

	// fade in .navbar
	$(document).ready(function(){
			$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 200) {
          $('#mega-menu-wrap').css("visibility","visible");
        

          $("#mega-menu-wrap").click(function(){
         $("#wpmm-wrap-home-page-only").css("visibility","visible") ;
            });

        $("#wpmm-wrap-home-page-only").mouseleave (function(){
         $("#wpmm-wrap-home-page-only").css("visibility","hidden");
            });


        } 

          else {
          $('#wide-nav .flex-row.container .flex-col.hide-for-medium.flex-left').css("visibility","hidden");
          $('#mega-menu-wrap').css("visibility","hidden");
          }
				});

		
			});
		});
       	
}(jQuery));