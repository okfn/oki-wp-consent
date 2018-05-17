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
    wp_enqueue_style( 'cookieconsent', plugin_dir_url( __FILE__ ) . 'assets/css/cookieconsent.min.css' );
    wp_enqueue_script( 'cookieconsent-core', plugin_dir_url( __FILE__ ) . 'assets/js/cookieconsent.min.js', array(), array(), false );
    wp_enqueue_script( 'cookieconsent-ga', plugin_dir_url( __FILE__ ) . 'assets/js/cookieconsent-ga.js', array(), array(), false );
}

add_action( 'wp_footer', 'oki_cookieconsent_load' );

function oki_cookieconsent_load() {

    /* GA_ID needs to be defined in the wp-config.php file of the running WordPress instance. */
    $googleAnalyticsCode = (defined( 'OKI_GA_ID' ) ? OKI_GA_ID : '');

    ?>
    <script>
        var url_string = window.location.href;
        var url = new URL(url_string);

        var googleAnalyticsCode = {
            id: '<?php echo esc_attr( $googleAnalyticsCode ); ?>'
        };

        window.addEventListener("load", function () {
            window.cookieconsent.initialise({
                palette: {
                    popup: {
                        background: "#efefef",
                        text: "#404040"
                    },
                    button: {
                        background: "#8ec760",
                        text: "#ffffff"
                    }
                },
                content: {
                    message: 'This website uses some cookies that collect information so we can improve user experience and report to our funders.',
                    dismiss: 'Allow cookies',
                    link: 'Read our privacy policy',
                    href: "https://okfn.org/privacy-policy/"
                },
                type: "opt-out",

                onInitialise: function (status) {
                    var type = this.options.type;
                    var didConsent = this.hasConsented();
                    if (!didConsent) {
                        // disable cookies
                        ga_reset();
                    } else {
                        ga_init();
                    }
                },

                onStatusChange: function (status, chosenBefore) {
                    var type = this.options.type;
                    var didConsent = this.hasConsented();
                    if (didConsent) {
                        ga_init();
                    } else {
                        ga_reset();
                    }
                }
            });
        });
    </script>
    <?php

}
