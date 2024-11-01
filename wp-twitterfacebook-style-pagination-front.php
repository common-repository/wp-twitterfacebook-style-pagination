<?php
/**
 * @package WP Twitter/Facebook Style Pagination
 * @version 1.0.1
 * @author Sagar Bhandari <webgig.sagar@gmail.com>
 */
 

add_action('init','init_js_scipts');
add_action('wp_head','init_pagination_js');
add_action('wp_ajax_paginate', 'wp_ajaxpaginate');
add_action('wp_ajax_nopriv_paginate', 'wp_ajaxpaginate');

$loopFile  = get_option('twg_tfsp_loop_file');
$contentEl = get_option('twg_tfsp_content_el_id');


function init_js_scipts(){
   wp_enqueue_script('jquery');
}

function wp_ajaxpaginate(){ 
    global $wp_query,$loopFile,$paged;

	$loop_file 		 = $_POST['loop_file'];
	if($loop_file)
	  $loopFile = $loop_file;

	$paged 		     = $_POST['page_no'];
	$posts_per_page  = get_option('posts_per_page');
	
	# Load the posts
	query_posts(array('paged' => $paged )); 
    
	# This action hook can be used to override the query_post used above
	do_action('twg_tfsp_query_posts');
	
	get_template_part( $loopFile );
		
	exit;
}


/***** Your custom query post hook  [Add this in your functions.php]
add_action('twg_tfsp_query_posts','twg_tfsp_custom_query_posts');

function twg_tfsp_custom_query_posts(){
  global $paged;
  # You can add any parameters here but the 'paged' parameter is a must	
  query_posts(array('post_type' => 'custom_post_type', 'paged' => $paged));
}
*/


function init_pagination_js(){
  global $wp_query,$contentEl,$loopFile;


?>
	<script type="text/javascript">
	  var content_el = '<?php echo $contentEl; ?>';
	  var loop_file  = '<?php echo $loopFile; ?>';
		jQuery(function() {
		
			jQuery('.load_more').live("click",function() {
				var last_post_id = jQuery(this).attr("id");
			
					jQuery.ajax({
						type: "POST",
						url: "<?php echo  admin_url( 'admin-ajax.php' )?>",
						data: "page_no="+ last_post_id + '&action=paginate&loop_file='+loop_file, 
						beforeSend:  function() {
								jQuery('a.load_more').html('<img src="<?php echo get_bloginfo('url');?>/wp-content/plugins/wp-twitterfacebook-style-pagination/images/loading.gif" />');
						},
						success: function(html){
							jQuery("#more").remove();
							jQuery("#"+content_el).append(html)
						}
					});
			return false;
			
			});
		});
	
	</script>
<?php
}

function twg_tfsp_paginate($loop_file='',$content_el=''){
global $wp_query,$contentEl,$loopFile;

if($loop_file) 
 $loopFile = $loop_file;


if($content_el)
 $contentEl = $content_el;

$page_no = $_POST['page_no'];

if(empty($page_no)) $page_no = 1;
	
if($page_no < $wp_query->max_num_pages):
	 
	if (  $wp_query->max_num_pages > 1 ) :  
?>      <script>content_el ='<?php  echo $contentEl; ?>'; loop_file ='<?php  echo $loopFile; ?>';  </script>
		<div id="more" class="navigation" style="cursor:pointer"><a  id="<?php echo $page_no+1;?>" class="load_more" href="#"><img src="<?php echo get_bloginfo('url');?>/wp-content/plugins/wp-twitterfacebook-style-pagination/images/loadmore.png" /></a></div>
<?php	
	endif; 
	
endif; 

}
?>