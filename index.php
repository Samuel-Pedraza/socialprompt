<?php 
/*
	Plugin Name: SocialPrompt
	Description: Alpha Version of SocialPrompt
	Version:     0.0.1
	Author:      Samuel Pedraza
 */
	function initialize_options(){
		add_option('shared_count', 0);
		add_option('display_text');
	}

	function register_css(){
		wp_enqueue_style('sharedcountCSS', plugin_dir_url( __FILE__ ) . 'css/main.css' );
	}

	function register_js(){
		wp_register_script('mainJS', '/wp-content/plugins/socialprompt/js/index.js');
		wp_enqueue_script('indexJS');		
	}

	function output_socialprompt(){
		initialize_options();
		register_js(); ?>
		
		      <div class="card">
		        <div class="card-body typewriter">
			          <p class="pb-3"><?php echo get_option('display_text') ?></p>          
			          <div class="form-group">
			            <input type="text" name="tweettext" id="texttweet">
			          </div>
			          <div class="form-group">
			            <button id="tweetthis">Tweet</button>
			          </div>
		          </form>
		        </div>
		      </div>
		<?php
	}

	//this is a workaround ensuring widget doesnt show on top of page
	function social_prompt_shortcode($atts, $content = null) { 
      ob_start();
      output_socialprompt();
      $output = ob_get_clean();

	    return $output; 
	}

	function update_shared_count(){
		$shared_count_value = get_option('shared_count');
		$shared_count_value += 1;
		update_option('shared_count', $shared_count_value);
	}

	function display_social_sharing_count(){
		register_css();?>
		<div>
			<h3>Social Sharing Count</h3>
		</div>
		<div>
			<p><?php echo get_option('shared_count'); ?></p>
		</div>
		<div>
			<h3>Shortcode</h3>
		</div>
		<div>
			<p>[output_social_prompt_shortcode]</p>
		</div>
		<div>
			<h3>Set Text</h3>
		</div>
		<div>
			<form method="POST" action="<?php echo admin_url( 'admin-post.php' ); ?>">
				<input type="hidden" name="action" value="updatetext">
				<input type="text" value="<?php echo get_option('display_text'); ?>" name="display_text">
				<input type="submit">
			</form>
		</div>
		<?php
	}

	function update_display_text(){
		global $wp; 
		$display_text_new = sanitize_text_field($_POST['display_text']);
		update_option('display_text', $display_text_new);
		return wp_redirect("/wp-admin/admin.php?page=shared-count");
	}

	function addMenu(){
		add_menu_page("Shared Count", "Shared Count", 4, "shared-count", "display_social_sharing_count");
	}

	add_action('wp_enqueue_scripts', 'register_js');
	add_action('wp_head', 'register_css');

	//ajax update for clicks on social
	add_action( 'wp_ajax_updatesocialsharecount', 'update_shared_count' );
	add_action('wp_ajax_nopriv_updatesocialsharecount', 'update_shared_count');

	//updating text from admin menu
	add_action( 'admin_post_updatetext', 'update_display_text');
	add_action("admin_menu", "addMenu");

	//shortcode
	add_shortcode('output_social_prompt_shortcode', 'social_prompt_shortcode');
 ?>