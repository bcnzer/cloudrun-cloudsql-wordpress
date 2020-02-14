<?php
/*
@package: File Manager Advanced
@Class: fma_main
*/
if(class_exists('class_fma_main')) {
	return;
}
class class_fma_main {
	     var $settings;
          public function __construct()
		    {
			 add_action('admin_menu', array(&$this, 'fma_menus'));
			 add_action( 'admin_enqueue_scripts', array(&$this,'fma_scripts'));
			 add_action( 'wp_ajax_fma_load_fma_ui', array(&$this, 'fma_load_fma_ui'));
			 add_action('wp_ajax_fma_review_ajax', array($this, 'fma_review_ajax'));
			 $this->settings = get_option('fmaoptions');
			}
			public function fma_menus() {
				include('class_fma_admin_menus.php');
				$fma_menus = new class_fma_admin_menus();
				$fma_menus->load_menus();
			}
			public function fma_load_fma_ui() {
				include('class_fma_connector.php');
				$fma_connector = new class_fma_connector();
				 if ( wp_verify_nonce( $_REQUEST['_fmakey'], 'fmaskey' ) ) {
				    $fma_connector->fma_local_file_system();
				 }
			}
			public function fma_scripts() {
                wp_enqueue_script( 'elfinder-ui.min', plugins_url('library/js/jquery-ui.min.js', __FILE__));
				wp_enqueue_script( 'elfinder_min', plugins_url('library/js/elfinder.full.js',  __FILE__ ));
				//wp_enqueue_script( 'elfinder_editors', plugins_url('library/js/extras/editors.default.js',  __FILE__ ));
				wp_enqueue_script( 'codemirror', plugins_url('library/codemirror/lib/codemirror.js',  __FILE__ ));
				wp_enqueue_style( 'codemirror', plugins_url('library/codemirror/lib/codemirror.css', __FILE__));
				wp_enqueue_script( 'htmlmixed', plugins_url('library/codemirror/mode/htmlmixed/htmlmixed.js',  __FILE__ ));
				wp_enqueue_script( 'xml', plugins_url('library/codemirror/mode/xml/xml.js',  __FILE__ ));
				wp_enqueue_script( 'css', plugins_url('library/codemirror/mode/css/css.js',  __FILE__ ));
				wp_enqueue_script( 'javascript', plugins_url('library/codemirror/mode/javascript/javascript.js',  __FILE__ ));
				wp_enqueue_script( 'clike', plugins_url('library/codemirror/mode/clike/clike.js',  __FILE__ ));
				wp_enqueue_script( 'php', plugins_url('library/codemirror/mode/php/php.js',  __FILE__ ));	
				wp_enqueue_script( 'elfinder_script', plugins_url('library/js/elfinder_script.js', __FILE__));
				wp_enqueue_style( 'user_interface', plugins_url('library/css/user_interface.css', __FILE__));
				wp_enqueue_style( 'elfinder.min', plugins_url('library/css/elfinder.min.css', __FILE__));
				wp_enqueue_style( 'fma_theme', plugins_url('library/css/theme.css', __FILE__));
				if(isset($this->settings['fma_theme']) && $this->settings ['fma_theme'] == 'dark') {
				  wp_enqueue_style( 'fma_themee', plugins_url('library/new/css/theme.css', __FILE__));
				}
                else if(isset($this->settings['fma_theme']) && $this->settings ['fma_theme'] == 'grey') {
				  wp_enqueue_style( 'fma_themee', plugins_url('library/themes/grey/css/theme.css', __FILE__));
				}
                else if(isset($this->settings['fma_theme']) && $this->settings ['fma_theme'] == 'windows10') {
				  wp_enqueue_style( 'fma_themee', plugins_url('library/themes/windows10/css/theme.css', __FILE__));
				}
                 else if(isset($this->settings['fma_theme']) && $this->settings ['fma_theme'] == 'bootstrap') {
				  wp_enqueue_style( 'fma_themee', plugins_url('library/themes/bootstrap/css/theme.css', __FILE__));
				}
			    wp_enqueue_style( 'fma_custom', plugins_url('library/css/custom_style_filemanager_advanced.css', __FILE__));
				if(isset($this->settings['fma_locale'])) {
				 $locale = $this->settings['fma_locale'];
				 if($locale != 'en') {
				  wp_enqueue_script( 'fma_lang', plugins_url('library/js/i18n/elfinder.'.$locale.'.js', __FILE__));
				 }
				}
			}
			/*
         Close Help
        */
        public function fma_review_ajax()
        {
            $task = sanitize_text_field($_POST['task']);
            $done = update_option('fma_hide_review_section', $task);
                if ($done) {
                    echo '1';
                } else {
                    echo '0';
                }
            die;
        }
}