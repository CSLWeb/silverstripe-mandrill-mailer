<?php

// $mailer = new MandrillMailer('APIKEYHERE');
// $mailer->set_track_opens(true);
// $mailer->set_track_clicks(true);

Director::addRules(50, array('mandrillevent//$Action/$ID/$Name'=> 'MandrillEvent_Controller'));

