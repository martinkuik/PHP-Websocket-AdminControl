#!/usr/bin/env php
<?php
/** WebSocketRunner
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   Martin
 * @author    Martin Kuik <martinn_@outlook.com>
 * @copyright 2014 Martin Kuik
 * @license   https://gnu.org/licenses/gpl.html GPL v3 License
 * @link      https://github.com/martinkuik
 */
require_once 'websockets.php';
/**
 * Everyone opens the Websocket at this Chat Server
 *
 * @category  PHP
 * @package   Martin
 * @author    Martin Kuik <martinn_@outlook.com> 
 * @copyright 2014 Martin Kuik
 * @license   https://gnu.org/licenses/gpl.html GPL v3 License 
 * @link      https://github.com/martinkuik 
 */
class EchoServer extends WebSocketServer
{
    /**
     *  Array holding the active clients
     */
    protected $user_list = array();
    /**
     *  Process is called every time a user sends a message to the server
     *
     * @param WebsocketUser $user    connection to a client  browser
     * @param string        $message the user chat message
     *
     * @return void
     */
    protected function process($user, $message) 
    {
        foreach ($this->user_list as $a) {
            $this->send($a, $message);
        }
        error_log("message : $message");
    }

    /**
     *  Process is called every time a user connect
     *
     * @param WebsocketUser $user connection to a client  browser
     *
     * @return void
     */
    protected function connected($user) 
    {
        $this->user_list[] = $user;
        error_log("connected user: $user->id");
        $cnt = count($this->user_list);
        error_log("user  list count: $cnt");
    }

    /**
     *  Process is called every time a user disconnect 
     *
     * @param WebsocketUser $user connection to a client  browser
     *
     * @return void
     */
    protected function closed($user) 
    {
        $idx = array_search($user, $this->user_list);
        unset($this->user_list[$idx]);
        $cnt = count($this->user_list);
        error_log("user  list count: $cnt");
    }
}
$echo = new EchoServer("0.0.0.0", "9000");
try
{
    $echo->run();
}
catch(Exception $e) 
{
    $echo->stdout($e->getMessage());
}
