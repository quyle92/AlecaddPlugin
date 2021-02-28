(function($) {
	jQuery(document).ready( function() {

		let reviewForm = document.getElementById('edit_form');
		$('form#edit_form').on('submit', function (event){
		    event.preventDefault();
		    var result = [];
		    var formValues= $(this).serialize();

		    $('.field-msg.js-form-submission').show();

		    jQuery.ajax({
		        type: 'POST',
		        url: jsData.ajaxurl,
		        data: formValues,
		        success: function(result){
		        	$('.field-msg.js-form-submission').hide();
		        	if( result.status == 'success' ){

		        		reviewForm.querySelector('small.field-msg.success.js-form-success').classList.add('show');
		        		$('small.field-msg.success.js-form-success').delay(1000).fadeOut('slow');
		        	}
		        	else{
		        		
		        		reviewForm.querySelector('.field-msg.error.js-form-error').classList.add('show');
		        	}

		       
		        },
	            error: function (xhr, status, err) {
	                alert( err);
	            }

		    });

		});

	  /**
	   * Clone Element  
	   */
	  $(".clone").click(function(e){

	      $( ".submenu_group_first" ).first().clone().appendTo( "#clone_area" ).append('<div class="form-group col-md-1"> <span class="glyphicon glyphicon-remove-sign remove"></span></div>').find('input').val('');

	  });

	  $(".clone_edit").click(function(e){

	      $( ".submenu_group_first_edit" ).first().clone().appendTo( "#clone_area_edit" ).find('input').val('');
	     
	    if( !$('.submenu_group_first_edit').length ){
	      $('#tab3success form > div.form-group.col-md-12').after('<div class="submenu_group_first_edit"> <div class="form-group col-md-3"> <label for="menu_subitem">Subitem</label> <input id="menu_subitem" name="qmenu_options[menu_subitem][]" type="text" class="form-control" value="" required> </div> <div class="form-group col-md-8"> <label for="pic">Pic</label> <input class="widefat image-upload" id="pic" name="qmenu_options[pic][]" type="text" value="" required> <button type="button" class="button button-primary js-image-upload">Select Image</button> </div> <div class="form-group col-md-1"> <span class="glyphicon glyphicon-remove-sign remove"></span></div> </div>');
	    }
	  });
	  /**
	   * Remove clone element
	   */

	  $('#clone_area').on('click','.remove', function(e){
	    removeIcon = $(this);//console.log(removeIcon);
	    removeIcon.parents('.submenu_group_first').empty();
	  });

	  $('#tab3success').on('click','.remove', function(e){
	    removeIcon = $(this);//console.log(removeIcon);
	    removeIcon.parents('.submenu_group_first_edit').remove();


	  });

	  /**
	   * Img upload
	   */
	  var wkMedia;
	  $('form').on('click', '.js-image-upload', function(e){
	    e.preventDefault();
	    button = $( this );
	     // If the upload object has already been created, reopen the dialog
	     if (wkMedia) {
	      wkMedia.open();
	      return;
	    }

	    // Extend the wp.media object
	     wkMedia = wp.media.frames.file_frame = wp.media({
	      title: 'Select media',
	      button: {
	      text: 'Select media'
	    }, multiple: false });

	     // When a file is selected, grab the URL and set it as the text field's value
	    wkMedia.on('select', function() {
	      var attachment = wkMedia.state().get('selection').first().toJSON();
	     button.siblings('.image-upload').val(attachment.url);
	    });


	  });


	//console.log(document.location.toString());console.log( window.location.href);
	 $('form#edit_menu').on('submit', function(e){ 
	  //  url = window.location.href;
	  // window.location.replace(url.split('#')[1], 'tab3success');
	  //   $('.nav-tabs a[href="#tab3success').tab('show');

	  

	   // remove hash from uri:    
	  // var uri = window.location.href;//(2)

	  // if(uri.indexOf('#') !== -1)
	  // {
	  //   clean_uri = uri.split('#')[0];
	  //   //or clean.uri = uri.substr(0, uri.indexOf('#'));
	  // }
	  // window.history.replaceState({},"",clean_uri);


	  window.location.hash = "#tab3success";

	});

	/**
	 * Twitter Bootstrap Tabs: Go to Specific Tab on Page Reload or Hyperlink
	 ref: https://stackoverflow.com/questions/7862233/twitter-bootstrap-tabs-go-to-specific-tab-on-page-reload-or-hyperlink
	 */

	var prefix = "tab_";// do this to prevent the browser  scroll to that hash
	//deep linking
	$('.nav-tabs a').on('shown.bs.tab', function (e) {//alert('deep linking');
	     window.location.hash = e.target.hash.replace("#", "#" + prefix);//alert(e.target.hash);//#tab3success
	});

	// Go to Specific Tab on Page Reload
	var hash = document.location.hash;//alert(hash);
	var url = document.location.toString();//alert(url);
	if (url.match('#') ) {
	  // alert(url);
	   $('.nav-tabs a[href="' + hash.replace(prefix,"") + '"]').tab('show');//url.split('#')[1] = hashtag ?>
	   
	}

		
	});

})(jQuery);







/*
 * //Note
 */
//(1)window.location.href is not a method, it's a property that will tell you the current URL location of the browser. Changing the value of the property will redirect the page. ref: https://stackoverflow.com/questions/7077770/window-location-href-and-window-open-methods-in-javascript

//(2) window.location.href is similar to window.location.toString()


