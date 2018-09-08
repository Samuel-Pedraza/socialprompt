<?php 
/*
	Plugin Name: SocialPrompt
	Description: Alpha Version of SocialPrompt
	Version:     0.0.1
	Author:      Samuel Pedraza
 */

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
	register_files(); ?>
	
	<div class="container">
	  <div class="row">
	    <div class="col-md-12  p-5" id="element">
	      <div class="card">
	        <div class="card-body typewriter">
	          <p class="pb-3">Hi! We'd love to know what you thought of our article so far. Could you tweet us your thoughts?</p>          
	          <div class="form-group">
	            <input type="text" class="form-control">
	          </div>
	          <div class="form-group">
	            <button class="btn btn-primary">Tweet</button>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<?php


	}
	add_action('wp_head', 'register_files');
	add_action( 'wp_enqueue_scripts', 'register_files');
	add_shortcode('output_social_prompt_shortcode', 'social_prompt_shortcode');
 ?>