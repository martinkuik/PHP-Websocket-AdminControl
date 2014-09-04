#!/usr/bin/env php
<?php

require_once('./websockets.php');

class echoServer extends WebSocketServer {
  //protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.
  protected $user_list = array();

	protected function process ($user, $message) {
		foreach($this->user_list as $a) {
			$this->send($a,$message);
		
		
		}
	error_log("message : $message");
	}
  
  protected function connected ($user) {
		$this->user_list[] =	$user;
		error_log("connected user: $user->id");
		$cnt = count($this->user_list);
		error_log("user  list count: $cnt");
		
    // Do nothing: This is just an echo server, there's no need to track the user.
    // However, if we did care about the users, we would probably have a cookie to
    // parse at this step, would be looking them up in permanent storage, etc.
  }
  
  protected function closed ($user) {
		$idx = array_search($user, $this->user_list);
		unset($this->user_list[$idx]);
		$cnt = count($this->user_list);
		error_log("user  list count: $cnt");
    // Do nothing: This is where cleanup would go, in case the user had any sort of
    // open files or other objects associated with them.  This runs after the socket 
    // has been closed, so there is no need to clean up the socket itself here.
  }
}

$echo = new echoServer("0.0.0.0","9000");

try {
  $echo->run();
}
catch (Exception $e) {
  $echo->stdout($e->getMessage());
}
