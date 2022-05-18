# Cookie Consent WordPress plugin for Open Knowledge Foundation websites

WordPress plugin for loading Cookie Consent assets across Open Knowledge Foundation websites.

The plugin looks for the `OKI_GA_ID` constant -- defined within `wp-config.php` of the running WordPress instance -- and uses it as a tracking id for Google Analytics.

```
define('OKI_GA_ID', 'UA-XXXXXX-XX');
```
