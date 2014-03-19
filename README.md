SilverStripe-Mandrill-Mailer
============================

Mandrill Mailer for SilverStripe to send SilverStripe Email through the [Mandrill.com](http://www.mandrill.com) service.

This is a new Silverstripe Mailer services that communicates with the Mandrill PHP SDK to send email through their service. The benefits of which are outlined at [Mandrill.com](http://www.mandrill.com).

Events
------
As well as delivering mail through Mandrill this module contains a controller that will accept Mandrill events set up through their [Webhook](http://help.mandrill.com/entries/21738186-Introduction-to-Webhooks) and [Rules](http://help.mandrill.com/entries/25142202-Example-rules) system

Requires
--------
This module requires [Silverstripe](http://www.silverstripe.org), I've tested this with version 2.4, 3.0 and 3.1

Installation
------------
You can either install this through composer or through placing this module alongside the cms and framework directories. If you are manually installing this you'll need to download the [Mandrill SDK](https://bitbucket.org/mailchimp/mandrill-api-php)

Setup
-----

Inside the _config.php file you'll notice there are three lines that set out the instantiation of the Mailer - you'll need a Mandrill API key in place of APIKEYHERE. You can of course leve these commented out and set the mailer at a more specific month.

```
// $mailer = new MandrillMailer('APIKEYHERE');
// $mailer->set_track_opens(true);
// $mailer->set_track_clicks(true);
```

All of these functions map to their mandrill properties with
$mailer->set_[property]();

+   important
+   track_opens
+   track_clicks
+   auto_text
+   auto_html
+   inline_css
+   url_strip_qs
+   preserve_recipients
+   view_content_link
+   tracking_domain
+   signing_domain
+   return_path_domain
+   tags
+   subaccount
+   google_analytics_domains
+   google_analytics_campaign
+   metadata
+   ip_pool
+   async
+   send_at

To-do
-----
+   Integrate Templating through the mandrill service
