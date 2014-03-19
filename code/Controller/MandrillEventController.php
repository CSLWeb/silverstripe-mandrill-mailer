<?php
class MandrillEvent_Controller extends Controller {
    public static $allowed_actions = array('webhook');
    public function webhook(SS_HTTPRequest $request) {
        $mandrill_events = $request->postVars();
        foreach(json_decode($mandrill_events['mandrill_events']) as $event){
        	$MandrillEvent = new MandrillEvent();
        	$MandrillEvent->ts =$event->ts;
    	    $MandrillEvent->event=$event->event;
    	    $MandrillEvent->url=$event->url;
    	    $MandrillEvent->user_agent=$event->user_agent;
    	    $MandrillEvent->MessageID=$event->_id;
    	    $MandrillEvent->write();
		}
    }
}