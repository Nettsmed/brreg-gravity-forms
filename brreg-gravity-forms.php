<?php
/**
 * Plugin Name: Brønnøysund + Gravity Forms Autocomplete
 * Description: Autocomplete company info from Brønnøysund by using CSS classes on Gravity Forms fields.
 * Author: SimplyLearn / Nettsmeds
 * Version: 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Brreg_GravityForms_Autocomplete {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    /**
     * Default config for mappings.
     *
     * Long-term: move this to options/admin page. Short-term: edit here or via filter.
     */
    public static function get_config() {
        $config = array(
            'profiles' => array(
                array(
                    'id'            => 'default',
                    // CSS class on the company name field wrapper (GF "CSS Class Name")
                    'trigger_class' => 'bedrift',
                    // Minimum characters before we call Brønnøysund
                    'min_chars'     => 2,
                    // Output field CSS classes
                    'outputs'       => array(
                        'orgnr'  => 'org_nummer',
                        'street' => 'invoice_street',
                        'zip'    => 'invoice_zip',
                        'city'   => 'invoice_city',
                    ),
                    // Restrict where this profile is active (optional, can be extended later)
                    'conditions'    => array(
                        // e.g. 'post_type' => 'arrangement'
                    ),
                ),
            ),
        );

        /**
         * Filter so we can override config from theme/other plugin.
         * Example: add more profiles, or change CSS classes.
         */
        return apply_filters( 'brreg_gf_autocomplete_config', $config );
    }

    public function enqueue_scripts() {
        // Only load on frontend
        if ( is_admin() ) {
            return;
        }

        // Optional: only load on pages where Gravity Forms is rendered
        // If Gravity Forms not active, bail out
        if ( ! class_exists( 'GFForms' ) ) {
            return;
        }

        // You can add your own conditions here if you want to restrict further
        // e.g. only on arrangement CPT:
        // if ( ! is_singular( 'arrangement' ) ) return;

        $handle = 'brreg-gf-autocomplete';

        wp_enqueue_script(
            $handle,
            plugin_dir_url( __FILE__ ) . 'assets/js/brreg-gf-autocomplete.js',
            array(), // no dependencies
            '0.1.0',
            true
        );

        wp_localize_script(
            $handle,
            'BrregGFConfig',
            self::get_config()
        );
    }
}

new Brreg_GravityForms_Autocomplete();

