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
                                <td><?php echo '<img src="' . $menu['menu_pic'] . '" width=25 height=25/>'; ?></td>
                                <td><?=$menu['menu_item']?></td>
                                <td> 
                                  <div class="rTable">   
                                    
                                        <?php //if( $key == 0){var_dump($value);
                                            foreach($menu['submenu_group'] as $sub)
                                            {   
                                                echo '<div class="rTableRow">';
                                                echo '<div class="rTableCell">' . $sub['menu_subitem'] . "</div> " . '<div class="rTableCell"><img src="' . $sub['menu_subpic'] . '"  width=60 height=40 />' . "</div>";
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
                    <form role="form" class="col-md-12 go-right"  action="options.php" method="post"  enctype=”multipart/form-data”><!--(1)-->
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
                    <form role="form" class="col-md-12 go-right" id="edit_form"  method="post"  enctype=”multipart/form-data” >
                        <?php 
                        $menu_id = $_POST['edit_menu'];
                        $menu_item =  get_option( 'qmenu_options')[$_POST['edit_menu']]['menu_item']; 
                        $menu_link =  get_option( 'qmenu_options')[$_POST['edit_menu']]['menu_link']; 
                        $menu_pic  =  get_option( 'qmenu_options')[$_POST['edit_menu']]['menu_pic'];
                        ?>
                        <input type="hidden" name="action" value="editMenu" /><!-- (2)-->
                        <input id="menu_id" name="menu_id" type="hidden" class="form-control"  value="<?=esc_attr($menu_id)?> "required> 
                        <div class="menu_item form-group col-md-3" >
                            <label for="menu_item">Item</label>
                            <input id="menu_item" name="menu_item" type="text" class="form-control"  value="<?=esc_attr($menu_item)?> "required> 
                        </div> 
                        <div class="menu_item form-group col-md-3" >
                            <label for="menu_item">Link</label>
                            <input id="menu_item" name="menu_link" type="text" class="form-control" value="<?=esc_attr($menu_link)?>" required> 
                        </div>
                        <div class="menu_item form-group col-md-6" >
                            <label for="menu_item">Pic</label>
                            <input class="widefat image-upload" name="menu_pic" type="text" value="<?=esc_url($menu_pic)?>" required>
                            <button type="button" class="button button-primary js-image-upload">Select Image</button>
                        </div> 
                        <?php
                        $sub_items = isset( $_POST['edit_menu'] ) ? get_option( 'qmenu_options')[$_POST['edit_menu']]['submenu_group'] : array(); 
                        foreach( $sub_items as $sub )
                        { ?>
                        <div class="submenu_group_first_edit">
                            <div class="form-group col-md-3">
                                <label for="menu_subitem">Sub-item</label>
                                <input id="menu_subitem" name="menu_subitem[]" type="text" class="form-control" value="<?=esc_attr($sub['menu_subitem'])?>" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="menu_subitem">Sub-link</label>
                                <input id="menu_subitem" name="menu_sublink[]" type="text" class="form-control" value="<?=esc_attr($sub['menu_sublink'])?>" required>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="pic">Sub-pic</label>
                                <input class="widefat image-upload" name="menu_subpic[]" type="text" value="<?=esc_url($sub['menu_subpic'])?>" required>
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
                         <small class="field-msg js-form-submission text-warning" >Submission in process, please wait&hellip;</small>
                         <small class="field-msg success js-form-success .text-success" >Message Successfully submitted, thank you!</small>
                          <small class="field-msg error js-form-error .text-danger"  >There was a problem with the Contact Form, please try again!</small>
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

/*
Notes
**/
//(1) remember to put options.php at form action
//(2) why put <input> tag here? to create an action for ajax api submission. Ref: https://wordpress.stackexchange.com/questions/119445/accept-ajax-call-with-serialized-form-data