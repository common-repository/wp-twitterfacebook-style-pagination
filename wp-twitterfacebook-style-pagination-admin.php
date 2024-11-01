<?php
/**
 * @package WP Twitter/Facebook Style Pagination
 * @version 1.0.1
 * @author Sagar Bhandari <webgig.sagar@gmail.com>
 */
 
add_action('admin_menu', 'twg_tfsp_admin_menu');
add_action('admin_init', 'twg_tfsp_enqueue_scripts' );

function twg_tfsp_admin_menu() {
	add_options_page('WP Twitter/Facebook Style Pagination', 'WP Twitter/Facebook Style Pagination', 'administrator','twg_tfsp', 'twg_tfsp_admin_page');
}

function twg_tfsp_enqueue_scripts(){
	wp_enqueue_style( 'tfspadmincss', get_bloginfo('url').'/wp-content/plugins/wp-twitterfacebook-style-pagination/css/wp-twitterfacebook-style-pagination.css');
}


function twg_tfsp_admin_page() {

	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	$msg = '';

	if(!empty($_POST)){
		
		update_option('twg_tfsp_content_el_id', $_POST['twg_tfsp_content_el_id']);
		$msg  = 'Settings Saved!';
		unset($_POST);
		
	}
	
	$twg_tfsp_loop_file      	  = get_option('twg_tfsp_loop_file');
	$twg_tfsp_content_el_id       = get_option('twg_tfsp_content_el_id');

	
?>


<div class="wrap">

	<?php if($msg): ?>
        <div class="updated" id="message"><p><?php echo $msg; ?></p></div>
    <?php endif; ?>

	<h2> WP Twitter/Facebook Style Pagination</h2>
	
    
    <div id="twg_tfsp_options">
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
		 
        <div class="element">
         <label>
          Loop File:
         </label>
         <input type="text" name="twg_tfsp_loop_file" id="twg_tfsp_loop_file" value="<?php echo $twg_tfsp_loop_file; ?>" /><span> ( The file  from which the contents will be loaded. By default this will be '<strong><em>loop.php</em></strong>'.)</span>
		</div>
        
        <div class="element">
         <label>
          Content Element:
         </label>
         <input type="text" name="twg_tfsp_content_el_id" id="twg_tfsp_content_el_id" value="<?php echo $twg_tfsp_content_el_id; ?>" /><span> ( The Id  of the element in which all the posts will be loaded.By default this will be '<em><strong>content</strong></em>')</span>
		</div>
		
		<div><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></div>
       
		</form>	  
        <div  class="notes">  
       	 <h4>How to use?</h4>
         <p> This plugin is simple to use.<br /> Just copy the code <code>&lt;?php if(function_exists('twg_tfsp_paginate')) twg_tfsp_paginate();?&gt;</code> and paste it in your posts page that could be your <strong>Index Page Template</strong>, <strong>Category/Archive Page Template</strong> or any <strong>Custom Post Type Archive Template</strong> etc.</p><br />
         
         <h4>Usage</h4>
         <code>&lt;?php if(function_exists('twg_tfsp_paginate')) twg_tfsp_paginate($loop_file,$content_el);?&gt;</code> 
         
         <h4>Parameters</h4>
         <dl>
            <dt>$loop_file</dt>
            <dd>(string)(optional).The file from which the posts/content will be loaded. If you donot pass this, the plugin will take the global value set in the form above. You will require this parameter when you use the pagination in several places in your site and if you have different file to load the posts/content from.<br /><em><strong>Default: loop.php</strong></em></dd>
           
            <dt>$content_el</dt>
            <dd>(string)(optional).The id of the element to which the content loaded via the above defined file will be rendered.If you donot pass this, the plugin will take the global value set in the form above. You will require this parameter when you use the pagination in several places in your site and if you have different content element to render the posts/content.<br /><em><strong>Default: content</strong></em></dd>
         </dl> 
          <h4>Hook E.g.</h4>
           <code> 
              add_action('twg_tfsp_query_posts','twg_tfsp_custom_query_posts');
              
               function twg_tfsp_custom_query_posts(){
                #You can add any parameters here but the 'paged' parameter is a must	
                query_posts(array('post_type' => 'custom_post_type', 'paged' => $paged));
               }
               
           </code>
        </div>	
	</div> 
    
	
	<div id="donate"><h3>Donate Us</h3>
       <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="JSTVUUXEJU2D6">
            <input type="hidden" name="on0" value="Help The Developer">
          
            <div  id="">
             <select name="os0">
                <option value="Donate">Donate $5.00</option>
                <option value="Donate">Donate $10.00</option>
                <option value="Donate">Donate $15.00</option>
            </select> 
            </div>
            <input type="hidden" name="currency_code" value="USD">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
            </form>

	</form>
	</div>
</div>
<?php } ?>