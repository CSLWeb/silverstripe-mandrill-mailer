<?php
class MandrillMessage extends DataObject
{
    public static $db = array(
    'MandrillID' => 'Text',
    'To' => 'Text',
    'From' => 'Text',
    'Subject' => 'Text',
    'MandrillMessage' => 'Text',
    'MandrillStatus' => 'Text',
    'MandrillRejectReason' => 'Text'
  );
    public static $has_many = array(
    'MandrillEvents' => 'MandrillEvent'
  );
}
