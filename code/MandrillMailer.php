<?php

class MandrillMailer extends Mailer
{

    /**
   * @var string $APIKey - Mandrill APIKey
   */
  protected $APIKey;

  /**
   * @var string $important
   */
  protected $important = false;
  /**
   * @var string $track_opens
   */
  protected $track_opens = null;
  /**
   * @var string $track_clicks
   */
  protected $track_clicks = null;
  /**
   * @var string $auto_text
   */
  protected $auto_text = null;
  /**
   * @var string $auto_html
   */
  protected $auto_html = null;
  /**
   * @var string $inline_css
   */
  protected $inline_css = null;
  /**
   * @var string $url_strip_qs
   */
  protected $url_strip_qs = null;
  /**
   * @var string $preserve_recipients
   */
  protected $preserve_recipients = null;
  /**
   * @var string $view_content_link
   */
  protected $view_content_link = null;
  /**
   * @var string $tracking_domain
   */
  protected $tracking_domain = null;
  /**
   * @var string $signing_domain
   */
  protected $signing_domain = null;
  /**
   * @var string $return_path_domain
   */
  protected $return_path_domain = null;
  /**
   * @var string $tags
   */
  protected $tags = array('');
  /**
   * @var string $subaccount
   */
  protected $subaccount = '';
  /**
   * @var string $google_analytics_domains
   */
  protected $google_analytics_domains = array();
  /**
   * @var string $google_analytics_campaign
   */
  protected $google_analytics_campaign = '';
  /**
   * @var string $metadata
   */
  protected $metadata = array();
  /**
   * @var string $ip_pool
   */
  protected $ip_pool = 'Mail Pool';
  /**
   * @var string $async
   */
  protected $async = false;
  /**
   * @var timestamp (YYYY-MM-DD HH:MM:SS) $send_at
   */
  protected $send_at = '2012-05-31 05:40:00';

  /**
   * creates and configures the mailer
   */
  public function __construct($APIKey)
  {
      if (strlen($APIKey)) {
          $this->setAPIKey($APIKey);
      } else {
          user_error("Could not create Mandrill Object: No API Key passed");
      }
  }

  /**
   * sets the Mandrill APIKey
   * @param string $APIKey
   */
  public function setAPIKey($APIKey)
  {
      $this->APIKey = $APIKey;
      return $this;
  }

  /**
   * optional extra headers to add to the message (most headers are allowed)
   * @param array $headers
   */
  public function set_headers($headers)
  {
      $this->headers = (array)$headers;
      return $this;
  }
  /**
   * whether or not this message is important, and should be delivered ahead of non-important messages
   * @param boolean $important
   */
  public function set_important($important)
  {
      $this->important = (boolean)$important;
      return $this;
  }
  /**
   * whether or not to turn on open tracking for the message
   * @param boolean $important
   */
  public function set_track_opens($track_opens)
  {
      $this->track_opens = (boolean)$track_opens;
      return $this;
  }
  /**
   * whether or not to turn on click tracking for the message
   * @param boolean $important
   */
  public function set_track_clicks($track_clicks)
  {
      $this->track_clicks = (boolean)$track_clicks;
      return $this;
  }
  /**
   * whether or not to automatically generate a text part for messages that are not given text
   * @param boolean $important
   */
  public function set_auto_text($auto_text)
  {
      $this->auto_text = (boolean)$auto_text;
      return $this;
  }
  /**
   * whether or not to automatically generate an HTML part for messages that are not
   * given HTML
   * @param boolean $important
   */
  public function set_auto_html($auto_html)
  {
      $this->auto_html = (boolean)$auto_html;
      return $this;
  }
  /**
   * whether or not to automatically inline all CSS styles provided in the message
   * HTML - only for HTML documents less than 256KB in size
   * @param boolean $important
   */
  public function set_inline_css($inline_css)
  {
      $this->inline_css = (boolean)$inline_css;
      return $this;
  }
  /**
   * whether or not to strip the query string from URLs when aggregating tracked URL data
   * @param boolean $url_strip_qs
   */
  public function set_url_strip_qs($url_strip_qs)
  {
      $this->url_strip_qs = (boolean)$url_strip_qs;
      return $this;
  }
  /**
   * whether or not to expose all recipients in to "To" header for each email
   * @param boolean $preserve_recipients
   */
  public function set_preserve_recipients($preserve_recipients)
  {
      $this->preserve_recipients = (boolean)$preserve_recipients;
      return $this;
  }
  /**
   * set to false to remove content logging for sensitive emails
   * @param boolean $view_content_link
   */
  public function set_view_content_link($view_content_link)
  {
      $this->view_content_link = (boolean)$view_content_link;
      return $this;
  }
  /**
   * a custom domain to use for tracking opens and clicks instead of mandrillapp.com
   * @param string $tracking_domain
   */
  public function set_tracking_domain($tracking_domain)
  {
      $this->tracking_domain = $tracking_domain;
      return $this;
  }
  /**
   * a custom domain to use for SPF/DKIM signing instead of mandrill (for "via"
   * or "on behalf of" in email clients)
   * @param string $signing_domain
   */
  public function set_signing_domain($signing_domain)
  {
      $this->signing_domain = $signing_domain;
      return $this;
  }
  /**
   * a custom domain to use for the messages's return-path
   * @param string $return_path_domain
   */
  public function set_return_path_domain($return_path_domain)
  {
      $this->return_path_domain = $return_path_domain;
      return $this;
  }
  /**
   * an array of string to tag the message with. Stats are accumulated using tags,
   * though we only store the first 100 we see, so this should not be unique or
   * change frequently. Tags should be 50 characters or less. Any tags starting
   * with an underscore are reserved for internal use and will cause errors.
   * @param array $tags
   */
  public function set_tags($tags)
  {
      $this->tags = $tags;
      return $this;
  }
  /**
   * the unique id of a subaccount for this message - must already exist or will fail with an error
   * @param string $subaccount
   */
  public function set_subaccount($subaccount)
  {
      $this->subaccount = $subaccount;
      return $this;
  }
  /**
   * an array of strings indicating for which any matching URLs will automatically have Google Analytics
   * parameters appended to their query string automatically.
   * @param array $google_analytics_domains
   */
  public function set_google_analytics_domains($google_analytics_domains)
  {
      $this->google_analytics_domains = $google_analytics_domains;
      return $this;
  }
  /**
   * optional string indicating the value to set for the utm_campaign tracking parameter. If this isn't
   * provided the email's from address will be used instead.
   * @param string $google_analytics_campaign
   */
  public function set_google_analytics_campaign($google_analytics_campaign)
  {
      $this->google_analytics_campaign = $google_analytics_campaign;
      return $this;
  }
  /**
   * metadata an associative array of user metadata. Mandrill will store this metadata and make it available for retrieval. In addition, you can select up to
   * 10 metadata fields to index and make searchable using the Mandrill search api.
   * @param boolean $metadata
   */
  public function set_metadata($metadata)
  {
      $this->metadata = $metadata;
      return $this;
  }

  /**
   * the name of the dedicated ip pool that should be used to send the message. If you do not have any
   * dedicated IPs, this parameter has no effect. If you specify a pool that does not exist, your default pool will be used instead.
   * @param boolean $ip_pool
   */
  public function set_ip_pool($ip_pool)
  {
      $this->ip_pool = $ip_pool;
      return $this;
  }

  /**
   * enable a background sending mode that is optimized for bulk sending. In async mode, messages/send will immediately return
   * a status of "queued" for every recipient. To handle rejections when sending in async mode, set up a webhook for the 'reject'
   * event. Defaults to false for messages with no more than 10 recipients; messages with more than 10 recipients are always sent
   * asynchronously, regardless of the value of async.
   * @param boolean $async
   */
  public function set_async($async)
  {
      $this->async = (boolean)$async;
      return $this;
  }

  /**
  * when this message should be sent as a UTC timestamp in YYYY-MM-DD HH:MM:SS format. If you specify a time in the past, the
  * message will be sent immediately. An additional fee applies for scheduled email, and this feature is only available to
  * accounts with a positive balance.
  */
  public function set_sent_at($sent_at)
  {
      $this->sent_at = $sent_at;
      return $this;
  }
  /**
   * creates a new Mandrill object
   */
  protected function initMailer()
  {
      $mail = new Mandrill($this->APIKey);
      return $mail;
  }

  /**
   * takes an email with or without a name and returns
   * email and name as separate parts
   * @param string $in
   * @return array ($email, $name)
   */
  protected function splitName($in)
  {
      if (preg_match('/^\s*(.+)\s+<(.+)>\s*$/', $in, $m)) {
          return array($m[2], $m[1]);
      } else {
          return array($in,'');
      }
  }


  /**
   * takes a list of emails, splits out the name and calls
   * the given function. meant to be used with to, cc and bcc
   */
  protected function explodeList($in, $type)
  {
      $list = explode(',', $in);
      foreach ($list as $item) {
          list($a, $b) = $this->splitName(trim($item));
          return array(
        'email' => $a,
        'name'  => $b,
        'type'  => $type
      );
      }
  }

  /**
  * Sets up an attachment in Mandrill format - a base64 encoded string
  * Not sure how Mandrill reacts to no name / minetype to testing for them too.
  */
  protected function setupAttachment($file)
  {
      return array(
      'type'=> $file['mimetype'],
      'name' =>$file['filename'],
      'content' =>base64_encode($file['contents'])
    );
  }
  /**
   * shared setup for both html and plain
   */
  protected function initEmail($to, $from, $subject, $attachedFiles = false, $customheaders = false)
  {
      $message = array(
      'important' => $this->important,
      'track_opens' => $this->track_opens,
      'track_clicks' => $this->track_clicks,
      'auto_text' => $this->auto_text,
      'auto_html' => $this->auto_html,
      'inline_css' => $this->inline_css,
      'url_strip_qs' => $this->url_strip_qs,
      'preserve_recipients' => $this->preserve_recipients,
      'view_content_link' => $this->view_content_link,
      'tracking_domain' => $this->tracking_domain,
      'signing_domain' => $this->signing_domain,
      'return_path_domain' => $this->return_path_domain,
      'tags' => $this->tags,
      'subaccount' => $this->subaccount,
      'google_analytics_domains' => $this->google_analytics_domains,
      'google_analytics_campaign' => $this->google_analytics_campaign,
      'metadata' => $this->metadata
    );


    // set the from
    $from = $this->splitName($from);
      $message['from_email'] = $from[0];
      $message['from_name'] = $from[1];

    // set the to
    $toArray = array();
      $toArray[] = $this->explodeList($to, 'to');

    // set cc and bcc if needed
    if (is_array($customheaders) && isset($customheaders['Cc'])) {
        $toArray[] = $this->explodeList($customheaders['Cc'], 'cc');
        unset($customheaders['Cc']);
    }

      if (is_array($customheaders) && isset($customheaders['Bcc'])) {
          $toArray[] = $this->explodeList($customheaders['Bcc'], 'bcc');
          unset($customheaders['Bcc']);
      }
      $message['to'] = $toArray;

    // set up the subject
    $message['subject'] = $subject;

    // add any attachments
    $attachments=array();
      if (is_array($attachedFiles)) {
          // include any specified attachments as additional parts
      foreach ($attachedFiles as $file) {
          $attachments[] = $this->setupAttachment($file);
      }
      }

      $message['attachments'] = $attachments;

      $headers["X-Mailer"]  = X_MAILER;
      if (!isset($customheaders["X-Priority"])) {
          $headers["X-Priority"]  = 3;
      }

      $headers = array_merge((array)$headers, (array)$customheaders);

      $message['headers'] = $headers;


      return $message;
  }


  /**
   * Send a plain-text email.
   *
   * @param string $to
   * @param string $from
   * @param string �subject
   * @param string $plainContent
   * @param bool $attachedFiles
   * @param array $customheaders
   * @return bool
   */
  public function sendPlain($to, $from, $subject, $plainContent, $attachedFiles = false, $customheaders = false)
  {
      $message = $this->initEmail($to, $from, $subject, $attachedFiles, $customheaders);

    // set up the body
    $message['text'] = $plainContent;

    // send and return
    try {
        $mail = $this->initMailer();
        $result = $result = $this->initMailer()->messages->send($message, $this->async, $this->ip_pool, $this->send_at);

        foreach ($result as $sentmessage) {
            $MandrillMessage = new MandrillMessage();
            $MandrillMessage->MandrillID = $sentmessage['_id'];
            $MandrillMessage->To = $to;
            $MandrillMessage->From = $from;
            $MandrillMessage->Subject = $subject;
            if (isset($sentmessage['status'])) {
                $MandrillMessage->MandrillStatus = $sentmessage['status'];
            }
            if (isset($sentmessage['reject_reason'])) {
                $MandrillMessage->MandrillRejectReason = $sentmessage['reject_reason'];
            }
            $MandrillMessage->MandrillMessage = json_encode($message);
            $MandrillMessage->write();
        }

        return true;
    } catch (Mandrill_Error $e) {
        // Mandrill errors are thrown as exceptions
      user_error('A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage());
      // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    } catch (Exception $e) {
        error_log('Unknown');
        return $this->httpError(403, 'An error occurred');
    }
  }


  /**
   * Send a multi-part HTML email.
   *
   * @return bool
   */
  public function sendHTML($to, $from, $subject, $htmlContent, $attachedFiles = false, $customheaders = false, $plainContent = false, $inlineImages = false)
  {
      $message = $this->initEmail($to, $from, $subject, $attachedFiles, $customheaders);

    // set up the body
    // @todo inlineimages
    $message['html'] = $htmlContent;
      if ($plainContent) {
          $message['text']= $plainContent;
      }

    // send and return
    try {
        $mail = $this->initMailer();
        $result = $mail->messages->send($message, $this->async, $this->ip_pool, $this->send_at);

        foreach ($result as $sentmessage) {
            $MandrillMessage = new MandrillMessage();
            $MandrillMessage->MandrillID = $sentmessage['_id'];
            $MandrillMessage->To = $to;
            $MandrillMessage->From = $from;
            $MandrillMessage->Subject = $subject;
            if (isset($sentmessage['status'])) {
                $MandrillMessage->MandrillStatus = $sentmessage['status'];
            }
            if (isset($sentmessage['reject_reason'])) {
                $MandrillMessage->MandrillRejectReason = $sentmessage['reject_reason'];
            }
            $MandrillMessage->MandrillMessage = json_encode($message);
            $MandrillMessage->write();
        }
        return true;
    } catch (Mandrill_Error $e) {
        // Mandrill errors are thrown as exceptions
      user_error('A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage());
      // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    } catch (Exception $e) {
        error_log('Unknown');
        return $this->httpError(400, 'An error occurred');
    }
  }
}
