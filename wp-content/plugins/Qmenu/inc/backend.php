<?php
//pr( get_option( 'qmenu_options', false ) );
//var_dump ($_POST['edit_menu'] );die;

?>



    <div class="panel with-nav-tabs panel-success">
        <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1success" data-toggle="tab">Menu list</a></li>
                    <li><a href="#tab2success" data-toggle="tab">Add</a></li>
                     <li><a href="#tab3success" data-toggle="tab" class="">Edit</a></li> 
                </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab1success">
                    <table class="table table-striped custab">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Menu</th>
                                <th>Submenu</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <?php
                        $i = 1;
                        $options = get_option('qmenu_options');//pr($options);
                        foreach ($options as $key => $menu)
                        { ?>
                            <tr>
                                <td><?php echo '<img src="' . $menu['menu_pic'] . '"/>'; ?></td>
                                <td><?=$menu['menu_item']?></td>
                                <td> 
                                  <div class="rTable">   
                                    
                                        <?php //if( $key == 0){var_dump($value);
                                            foreach($menu['submenu_group'] as $sub)
                                            {   
                                                echo '<div class="rTableRow">';
                                                echo '<div class="rTableCell">' . $sub['menu_subitem'] . "</div> " . '<div class="rTableCell"><img src="' . $sub['menu_subpic'] . '" />' . "</div>";
                                                echo ' </div>';
                                            }
                                        //}
                                        ?>
                                   
                                  </div>
                                </td>
                                <td class="text-center">
                                    <form method="post" action="" class="inline-block" id="edit_menu" >
                                        <input type="hidden" name="edit_menu" value="<?=$key?>" />
                                        <button type="submit" class="btn btn-warning"> Edit</button>
                                    </form>
                                   <form method="post" action="options.php" class="inline-block">
                                        <input type="hidden" name="del_menu" value="<?=$key?>" />
                                        <?php   
                                        settings_fields( "qmenu_option_group" );
                                        echo '<input type="hidden" name="aa" value="ss" />';
                                        submit_button('Delete', 'danger', 'submit', 'false');
                                        ?>
                                    </form> 
                                </td>
                            </tr>
                        <?php $i++; 
                        } ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab2success">
                    <form role="form" class="col-md-12 go-right" action="options.php" method="post"  enctype=”multipart/form-data”>
                        <?php
                            settings_fields( "qmenu_option_group" );// same as option_group at register_setting() 
                            // do_settings_sections( 'qmenu' );// same as page in add_settings_section() 
                            // submit_button();
                        ?>

                        <div class="menu_item form-group col-md-3" >
                            <label for="menu_item">Item</label>
                            <input id="menu_item" name="qmenu_options[menu_item]" type="text" class="form-control"  required> 
                        </div> 
                        <div class="menu_item form-group col-md-3" >
                            <label for="menu_item">Link</label>
                            <input id="menu_item" name="qmenu_options[menu_link]" type="text" class="form-control"  required> 
                        </div>
                        <div class="menu_item form-group col-md-6" >
                            <label for="menu_item">Pic</label>
                            <input class="widefat image-upload" name="qmenu_options[menu_pic]" type="text" value="" value="" required>
                            <button type="button" class="button button-primary js-image-upload">Select Image</button>
                        </div>                                         
                        <div  id="submenu_group" class="sea-service">
                              <div class="submenu_group_first">
                                  <div class="form-group col-md-3">
                                      <label for="menu_subitem">Sub-item</label>
                                      <input id="menu_subitem" name="qmenu_options[menu_subitem][]" type="text" class="form-control" value="" required>
                                  </div>
                                  <div class="form-group col-md-3">
                                      <label for="menu_subitem">Sub-link</label>
                                      <input id="menu_subitem" name="qmenu_options[menu_sublink][]" type="text" class="form-control" value="" required>
                                  </div>
                                  <div class="form-group col-md-5">
                                      <label for="pic">Sub-pic</label>
                                      <input class="widefat image-upload" name="qmenu_options[menu_subpic][]" type="text"  value="" required>
                                      <button type="button" class="button button-primary js-image-upload">Select Image</button>
                                  </div>
                              </div>
                        </div>

                        <div id="clone_area"></div>
                   
                        <div class="row">
                          <div class="submit_button col-md-6">
                              <?php submit_button(); ?>
                              <?php wp_nonce_field( 'qmenu-subitems-settings', 'qmenu-subitems-settings-nonce' ); ?>
                             
                          </div>
                          <div class="col-md-6" style="margin-top: 30px">
                              <button type="button" class="btn btn-warning clone text-default">Clone</button>
                          </div>
                        </div>
                    </form>
                </div>
                
                <div class="tab-pane fade " id="tab3success">
                <?php
                if ( isset( $_POST['edit_menu'] ) )
                { ?>
                    <form role="form" class="col-md-12 go-right" action="options.php" method="post"  enctype=”multipart/form-data”>
                        <?php
                            settings_fields( "qmenu_option_group" );// same as option_group at register_setting() 
                            // do_settings_sections( 'qmenu' );// same as page in add_settings_section() 
                            // submit_button();
                        ?>
                        <?php 
                        $menu_id = $_POST['edit_menu'];
                        $menu_item =  get_option( 'qmenu_options')[$_POST['edit_menu']]['menu_item']; 
                        $menu_link =  get_option( 'qmenu_options')[$_POST['edit_menu']]['menu_link']; 
                        $menu_pic  =  get_option( 'qmenu_options')[$_POST['edit_menu']]['menu_pic'];
                        ?>
                        <input id="menu_id" name="qmenu_options[menu_id]" type="hidden" class="form-control"  value="<?=esc_attr($menu_id)?> "required> 
                        <div class="menu_item form-group col-md-3" >
                            <label for="menu_item">Item</label>
                            <input id="menu_item" name="qmenu_options[menu_item]" type="text" class="form-control"  value="<?=esc_attr($menu_item)?> "required> 
                        </div> 
                        <div class="menu_item form-group col-md-3" >
                            <label for="menu_item">Link</label>
                            <input id="menu_item" name="qmenu_options[menu_link]" type="text" class="form-control" value="<?=esc_attr($menu_link)?>" required> 
                        </div>
                        <div class="menu_item form-group col-md-6" >
                            <label for="menu_item">Pic</label>
                            <input class="widefat image-upload" name="qmenu_options[menu_pic]" type="text" value="<?=esc_url($menu_pic)?>" required>
                            <button type="button" class="button button-primary js-image-upload">Select Image</button>
                        </div> 
                        <?php
                        $sub_items = isset( $_POST['edit_menu'] ) ? get_option( 'qmenu_options')[$_POST['edit_menu']]['submenu_group'] : array(); 
                        foreach( $sub_items as $sub )
                        { ?>
                        <div class="submenu_group_first_edit">
                            <div class="form-group col-md-3">
                                <label for="menu_subitem">Sub-item</label>
                                <input id="menu_subitem" name="qmenu_options[menu_subitem][]" type="text" class="form-control" value="<?=esc_attr($sub['menu_subitem'])?>" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="menu_subitem">Sub-link</label>
                                <input id="menu_subitem" name="qmenu_options[menu_sublink][]" type="text" class="form-control" value="<?=esc_attr($sub['menu_sublink'])?>" required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="pic">Sub-pic</label>
                                <input class="widefat image-upload" name="qmenu_options[menu_subpic][]" type="text" value="<?=esc_url($sub['menu_subpic'])?>" required>
                                <button type="button" class="button button-primary js-image-upload">Select Image</button>
                            </div>
                            <div class="form-group col-md-1"> <span class="glyphicon glyphicon-remove-sign remove"></span></div>
                        </div>

                       
                        <?php 
                        }    ?>
                         <div  id="clone_area_edit"></div>
                      
                      
                        <div class="submit_button col-md-6">
                        <?php submit_button(); ?>
                        <?php wp_nonce_field( 'qmenu-subitems-settings', 'qmenu-subitems-settings-nonce' ); ?>
                        </div>
                        <div class="col-md-6" style="margin-top: 30px">
                            <button type="button" class="btn btn-warning clone_edit text-default">Clone</button>
                        </div>
                    </form>
                </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

<script>
$(document).ready(function(){

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
var hash = document.location.hash;
var prefix = "tab_";// do this to prevent the browser  scroll to that hash
//deep linking
$('.nav-tabs a').on('shown.bs.tab', function (e) {//alert('deep linking');
     window.location.hash = e.target.hash.replace("#", "#" + prefix);//alert(e.target.hash);//#tab3success
});

// Go to Specific Tab on Page Reload
var url = document.location.toString();//alert(url);
if (url.match('#') ) {
   //alert('Page Reload');
   $('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');//url.split('#')[1] = hashtag ?>
   
}

 

});


</script>

<?php

/**
 * Note
 */
//remember to put options.php at form action
//(1)window.location.href is not a method, it's a property that will tell you the current URL location of the browser. Changing the value of the property will redirect the page. ref: https://stackoverflow.com/questions/7077770/window-location-href-and-window-open-methods-in-javascript

//(2) window.location.href is similar to window.location.toString()