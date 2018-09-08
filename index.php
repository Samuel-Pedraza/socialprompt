<?php 
/*
	Plugin Name: SocialPrompt
	Description: Alpha Version of SocialPrompt
	Version:     0.0.1
	Author:      Samuel Pedraza
 */
	function initialize_shared_count(){
		add_option('shared_count', 0);
	}

	function register_files(){
		wp_register_style('mainCSS', plugin_dir_url( __FILE__ ) . 'css/main.css');
		wp_register_script('indexJS', plugin_dir_url( __FILE__ ) . 'js/index.js');	

		wp_enqueue_style('mainCSS');
		wp_enqueue_script('indexJS');
		
	}

	function social_prompt_shortcode($atts, $content = null) { 
	    // Start output buffering
      ob_start();
      // Run the function
      output_socialprompt();
      // Capture buffer as a string
      $output = ob_get_clean();

	    return $output; 
	}

function output_socialprompt(){
	register_files();
	initialize_shared_count(); ?>
	
	      <div class="card">
	        <div class="card-body typewriter">
		          <p class="pb-3">Hi! We'd love to know what you thought of our article so far. Could you tweet us your thoughts?</p>          
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

	function update_shared_count(){
		$shared_count_value = get_option('shared_count');
		$shared_count_value += 1;
		update_option('shared_count', $shared_count_value);
	}
	
	add_action( 'wp_ajax_updatesocialsharecount', 'update_shared_count' );
	add_action('wp_ajax_nopriv_updatesocialsharecount', 'update_shared_count');
	add_shortcode('output_social_prompt_shortcode', 'social_prompt_shortcode');
 ?>