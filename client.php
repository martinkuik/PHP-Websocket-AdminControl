<?php
function addr() {
    $a = $_SERVER['SERVER_ADDR'];
    if ($a == "::1") {
        $a = "localhost";
    }
    return $a;
}
function title() {
    $a = $_SERVER['SERVER_ADDR'];
    if ($a == "::1") {
        $a = "<b>Admin</b>";
    }
    return $a;
}
?>
<html>
<head><title>Messenger API</title>
<style type="text/css">
html,body {
	font-family:verdana;
	font-size:15px;
}
#log {
	width:600px; 
	height:300px; 
	border:1px solid #7F9DB9; 
	overflow:auto;
}
#msg {
	width:400px;
}
</style>
<script type="text/javascript">
var socket;
var server_ip = "<?php echo addr(); ?>";

function init() {
	var host = "ws://" + server_ip + ":9000/echobot"; 
	try {
		socket = new WebSocket(host);
		log('WebSocket - status '+socket.readyState);
		socket.onopen    = function(msg) { 
							   log("Welcome - status "+this.readyState); 
						   };
		socket.onmessage = function(msg) { 
							   log("Received: "+msg.data); 
						   };
		socket.onclose   = function(msg) { 
							   log("Disconnected - status "+this.readyState); 
						   };
	}
	catch(ex){ 
		log(ex); 
	}
	$("msg").focus();
}

function send(){
	var txt,msg;
	txt = $("msg");
	msg = txt.value;
	if(!msg) { 
		alert("Message can not be empty"); 
		return; 
	}
	txt.value="";
	txt.focus();
	try { 
		socket.send(msg); 
		log('Sent: '+msg); 
	} catch(ex) { 
		log(ex); 
	}
}
function quit(){
	if (socket != null) {
		log("Goodbye!");
		socket.close();
		socket=null;
	}
}

function reconnect() {
	quit();
 	init();
}

function $(id){ return document.getElementById(id); }
function log(msg){ $("log").innerHTML+="<br>"+msg; }
function onkey(event){ if(event.keyCode==13){ send(); } }
</script>

</head>
<body onload="init()">
	<h3>Your ip : 
		<?php
error_reporting(E_STRICT);
echo title(); ?>
	</h3>
<div id="log"></div>
<input id="msg" type="textbox" onkeypress="onkey(event)"/>
<button onclick="send()">Send
</button>
<button onclick="quit()">Quit</button>
<button onclick="reconnect()">Reconnect</button>
</body>
</html>
