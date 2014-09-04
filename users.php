<?php
/** Users
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   Martin
 * @author    Martin Kuik <martinn_@outlook.com>
 * @copyright 2014 Martin Kuik
 * @license   https://gnu.org/licenses/gpl.html GPL v3 License
 * @link      https://github.com/martin.kuik
 */
class WebSocketUser {
    public $socket;
    public $id;
    public $headers = array();
    public $handshake = false;
    public $handlingPartialPacket = false;
    public $partialBuffer = "";
    public $sendingContinuous = false;
    public $partialMessage = "";
    public $hasSentClose = false;
    function __construct($id, $socket) {
        $this->id = $id;
        $this->socket = $socket;
    }
}
