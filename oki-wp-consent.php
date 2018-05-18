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
    /* GA_ID needs to be defined in the wp-config.php file of the running WordPress instance. */
    $googleAnalyticsCode = (defined( 'OKI_GA_ID' ) ? OKI_GA_ID : '');

    ?>
    <script>
        var googleAnalyticsCode = {
            id: '<?php echo esc_attr( $googleAnalyticsCode ); ?>'
        };
    </script>
    <?php

    wp_enqueue_script( 'consent', 'https://a.okfn.org/html/oki/consent/assets/js/consent.js', array(), '', false );

}
