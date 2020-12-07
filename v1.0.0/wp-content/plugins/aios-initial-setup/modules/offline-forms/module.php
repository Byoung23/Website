<?php
/**
 * Name: Offline Forms
 * Description: Allow to save inputed data when connections gone
 */
class AIOS_Initial_Setup_Offline_Forms {
	
	function __construct() {

		if ( isset(get_option( 'aios_initial_setup_modules' )['offline-forms'])  ) {
			add_action( 'wp_enqueue_scripts', array($this,'enqueue_scripts') );
		}

	}
	
	function enqueue_scripts() {

		wp_enqueue_style('offline-forms-scripts', AIOS_INITIAL_SETUP_URL . 'modules/offline-forms/css/offline-form.css');
		wp_enqueue_script('offline-forms-scripts', AIOS_INITIAL_SETUP_URL . 'modules/offline-forms/js/offline-form.js', "", "", false);

		wp_localize_script( 'offline-forms-scripts', 'shared_var', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'testConnection' => AIOS_INITIAL_SETUP_URL . 'modules/offline-forms/test-connection-return.php' ) );

		wp_localize_script( 
            'offline-forms-scripts', 
            'options', 
            array(
                'noncf7' => get_option( 'aios_offline_form_noncf7' ),
                'settings' => get_option( 'aios_offline_form_settings' )
            )
        );

	}

}

$aios_initial_setup_module_instances_object['aios_initial_setup_offline_forms_module'] = new AIOS_Initial_Setup_Offline_Forms();
