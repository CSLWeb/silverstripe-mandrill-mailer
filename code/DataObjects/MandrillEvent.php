<?php
class MandrillEvent extends DataObject
{

    public static $db = array(
    'ts' => 'varchar',
    'event' => 'varchar',
    'url' => 'varchar',
    'user_agent' => 'varchar',
    'MessageID' => 'varchar'
    );

    public static $has_one = array(
    'MandrillMessage'=>'MandrillMessage'
  );

    public function onBeforeWrite()
    {
        if ($this->MessageID &&!$this->MandrillMessageID) {
            if ($MM = MandrillMessage::get()->filter(array('MandrillID' => $this->MessageID))) {
                $this->MandrillMessageID = $MM->First()->ID;
            }
        }
    }
}
