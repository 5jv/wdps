<?php 
    $cfc_look_and_feel_options = get_option('cfc_look_and_feel_options');
?>

<div class="look-feel-tab-wrapper">
    <h1 class="screen-reader-text">Edit the look and feel of the CarbonClick plugin</h1>
    <h2>Edit the look and feel of the CarbonClick plugin</h2>

    <div class="look-feel-bg">
        <div class="color-guide">
            <h5>Colour Guide</h5>
            <p>Match the numbers in the guide with the colour pickers below, to easily edit the CarbonClick plugin's colours to match your store.</p>
        </div>
        <div class="color-guide-image">
            <?php echo "<img src='".CFC_PLUGIN_URL."assets/images/look-and-feel/color-guide-large.svg' width=''/>"; ?>
        </div>
    </div>

    <div class="look-feel-table-main">
        <div class="look-feel-bg-left">
            <div class="look-feel-bg">
                <h5>Plugin Colours</h5>
                <table class="form-table">
                    <tbody>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">1) Plugin Border Colour</label>
                        </th>
                    </tr>
                    <tr valign="top">
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[plugin_border_color]" id="plugin_border_color" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['plugin_border_color']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">2) Plugin Background Colour</label>
                        </th>
                    </tr>
                    <tr valign="top">
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[plugin_background_color]" id="plugin_background_color" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['plugin_background_color']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">3) Plugin Background Colour Expanded</label>
                        </th>
                    </tr>
                    <tr valign="top">
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[plugin_background_color_expanded]" id="plugin_background_color_expanded" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['plugin_background_color_expanded']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">4) Plugin Icons Colour</label>
                        </th>
                    </tr>
                    <tr valign="top">        
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[plugin_icons_color]" id="plugin_icons_color" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['plugin_icons_color']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">5) Plugin Text Colour Top Section</label>
                        </th>        
                    </tr>
                    <tr valign="top">        
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[plugin_text_colour_top_section]" id="plugin_text_colour_top_section" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['plugin_text_colour_top_section']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">6) Plugin Large Text Colour Expanded</label>
                        </th>
                    </tr>
                    <tr valign="top">
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[plugin_large_text_colour_expanded]" id="plugin_large_text_colour_expanded" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['plugin_large_text_colour_expanded']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">7) Plugin Small Text Colour Expanded</label>
                        </th>        
                    </tr>
                    <tr valign="top">
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[plugin_small_text_colour_expanded]" id="plugin_small_text_colour_expanded" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['plugin_small_text_colour_expanded']; ?>">
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="look-feel-bg-left">
            <div class="look-feel-bg">
                <h5>Button Colours</h5>
                <table class="form-table">
                    <tbody>
                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">8) Button Border Colour</label>
                        </th>        
                    </tr>
                    <tr valign="top">        
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[button_border_colour]" id="button_border_colour" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['button_border_colour']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">9) Button Background Colour</label>
                        </th>        
                    </tr>
                    <tr valign="top">        
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[button_background_colour]" id="button_background_colour" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['button_background_colour']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">10) Button Text Colour</label>
                        </th>        
                    </tr>
                    <tr valign="top">        
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[button_text_colour]" id="button_text_colour" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['button_text_colour']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">11) Button Plus Icon Colour</label>
                        </th>        
                    </tr>
                     <tr valign="top">        
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[button_plus_icon_colour]" id="button_plus_icon_colour" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['button_plus_icon_colour']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">12) Button Background Colour Selected</label>
                        </th>        
                    </tr>
                    <tr valign="top">        
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[button_background_colour_selected]" id="button_background_colour_selected" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['button_background_colour_selected']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">13) Button Text Colour Selected</label>
                        </th>        
                    </tr>
                    <tr valign="top">        
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[button_text_colour_selected]" id="button_text_colour_selected" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['button_text_colour_selected']; ?>">
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">
                            <label for="">14) Button Checkmark Icon Selected</label>
                        </th>        
                    </tr>
                    <tr valign="top">        
                        <td class="forminp forminp-text">
                            <input name="cfc_look_and_feel[button_checkmark_icon_selected]" id="button_checkmark_icon_selected" type="text" class="cfc-color-field" value="<?php echo $cfc_look_and_feel_options['button_checkmark_icon_selected']; ?>">
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="look-feel-table-main look-feel-table-main-logo">
        <div class="look-feel-bg-left">
            <div class="look-feel-bg">
                <table>
                    
                    <tr valign="top">
                        <?php
                            $carbonclick_logo = isset($cfc_look_and_feel_options['carbonclick_logo']) ? $cfc_look_and_feel_options['carbonclick_logo'] : "";
                        ?>
                        <th scope="row" class="titledesc">
                            <h5>Carbonclick Logo</h5>
                        </th>
                    </tr>

                    <tr valign="top">
                        <td class="forminp forminp-text">
                            <fieldset>
                                <label for="cfc_carbonclick_logo_standard">
                                    <input name="cfc_look_and_feel[carbonclick_logo]" id="cfc_carbonclick_logo_standard" type="radio" <?php echo checked($carbonclick_logo, 'standard'); ?> class="carbonclick_logo" value="standard"> Standard
                                </label> 														
                            </fieldset>

                            <fieldset>
                                <label for="cfc_carbonclick_logo_black">
                                    <input name="cfc_look_and_feel[carbonclick_logo]" id="cfc_carbonclick_logo_black" type="radio" <?php echo checked($carbonclick_logo, 'black'); ?> class="carbonclick_logo" value="black"> Black
                                </label> 														
                            </fieldset>

                            <fieldset>
                                <label for="cfc_carbonclick_logo_white">
                                    <input name="cfc_look_and_feel[carbonclick_logo]" id="cfc_carbonclick_logo_white" type="radio" <?php echo checked($carbonclick_logo, 'white'); ?> class="carbonclick_logo" value="white"> White
                                </label> 														
                            </fieldset>

                            
                        </td>
                    </tr>
                    
                </table>

                <div id="carbonclick_logo_preview" class="inner-logo-bg <?php echo $carbonclick_logo; ?>">
                    <fieldset>
                        <div>
                            <?php echo "<img id='carbonclick_logo_image' src='".CFC_PLUGIN_URL."assets/images/look-and-feel/carbonclick-logo-".$carbonclick_logo."-picker.svg' width='100%'/>"; ?>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="look-feel-bg-left">
            <div class="look-feel-bg">
                <table>
                    <tr valign="top">
                        <?php 
                        $carbonclick_product_image = isset($cfc_look_and_feel_options['carbonclick_product_image']) ? $cfc_look_and_feel_options['carbonclick_product_image'] : "";
                        ?>
                        <th scope="row" class="titledesc">
                            <h5>Carbonclick Product Image</h5>
                        </th>
                    </tr>

                    <tr valign="top">
                        <td class="forminp forminp-text">
                            <fieldset>
                                <label for="cfc_carbonclick_product_image_standard">
                                    <input name="cfc_look_and_feel[carbonclick_product_image]" id="cfc_carbonclick_product_image_standard" type="radio" <?php echo checked($carbonclick_product_image, 'standard'); ?> class="carbonclick_product_image" value="standard"> Standard
                                </label>                            
                            </fieldset>

                            <fieldset>
                                <label for="cfc_carbonclick_product_image_black">
                                    <input name="cfc_look_and_feel[carbonclick_product_image]" id="cfc_carbonclick_product_image_black" type="radio" <?php echo checked($carbonclick_product_image, 'black'); ?> class="carbonclick_product_image" value="black"> Black
                                </label>                            
                            </fieldset>

                            <fieldset>
                                <label for="cfc_carbonclick_product_image_white">
                                    <input name="cfc_look_and_feel[carbonclick_product_image]" id="cfc_carbonclick_product_image_white" type="radio" class="carbonclick_product_image" value="white" <?php echo checked($carbonclick_product_image, 'white'); ?>> White
                                </label>                            
                            </fieldset>

                            
                        </td>
                    </tr>
                </table>

                <div id="carbonclick_product_image_preview" class="inner-logo-bg co2-logo <?php echo $carbonclick_product_image; ?>">
                    <fieldset>
                        <div>
                            <?php echo "<img id='carbonclick_product_image' src='".CFC_PLUGIN_URL."assets/images/look-and-feel/cloud-".$carbonclick_product_image.".png' width='100%'/>"; ?>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

    </div>
    <p class="submit">
        <button name="reset_cfc_look_and_feel" class="button-primary reset-btn" type="submit" value="Reset">Reset</button>
        <?php wp_nonce_field('cfc_look_and_feel_nonce', 'cfc_look_and_feel_nonce_field'); ?>
        <button name="save_cfc_look_and_feel" class="button-primary" type="submit" value="Save changes">Save changes</button>	
    </p>
</div>