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
    ?>
    <script defer data-domain="<?php get_bloginfo('url') ?>" src="https://plausible.io/js/plausible.js"></script>
    <?php

}
