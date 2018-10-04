<?php

/*
  Plugin Name:  OKI Cookie Consent
  Plugin URI:   https://github.com/okfn/oki-wp-consent
  Description:  WordPress plugin for enabling Cookie Consent on Open Knowledge International websites
  Version:      0.1
  Author:       Goce Mitevski
  Author URI:   https://www.nicer2.com/
  License:      GPL2
  License URI:  https://www.gnu.org/licenses/gpl-2.0.html
  Text Domain:  oki-wp-consent
  Domain Path:  /languages
 */

add_action( 'wp_enqueue_scripts', 'oki_cookieconsent_init' );

function oki_cookieconsent_init() {

    if ( is_multisite() ):
      $theme_options = get_blog_option( get_current_blog_id(), "theme_options_option_name", false );
    else:
      $theme_options = get_site_option( "theme_options_option_name", false );
    endif;

    // When used with the official OKI WordPress theme, the Google Analytics tracking ID can be set
    // per site and that value will be read and set first. If the GA ID is not set or not available it will
    // default to the value set in wp-config.php. If that value is not available as well, an error in
    // the browser console will be shown.
    if ($theme_options["okfnwp_ga_id"]):
      $analyticsTrackingID = $theme_options["okfnwp_ga_id"];
    else:
      /* OKI_GA_ID needs to be defined in the wp-config.php file of the running WordPress instance. */
      $analyticsTrackingID = (defined( 'OKI_GA_ID' ) ? OKI_GA_ID : '');
    endif;

    ?>
    <script>
      var okiConsent = {
        analyticsTrackingID: '<?php echo esc_attr( $analyticsTrackingID ); ?>'
      };
    </script>
    <?php

    wp_enqueue_script( 'consent', 'https://a.okfn.org/html/oki/consent/assets/js/consent.js', array(), '', false );

}
