<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
	<title>Sinch VIDEO Sample app</title>
	<link rel="stylesheet" href="style.css"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="sinch/sinch.min.js"></script>
</head>

<body>
	<div class="top1">
		<h1>Video calling</h1>
	</div>
	
	<div class="container">

		<div id="chromeFileWarning" class="frame big">
			<b style="color: red;">Warning!</b> Protocol "file" used to load page in Chrome.<br><br>
			Please avoid loading files directly from disk when developing WebRTC applications using Chrome.<br>
			Chrome disables access to microphone which prevents proper functionality.<br>
			<br>
			You can allow working with "file:", if you start Chrome with the flag <i>--allow-file-access-from-files</i>
		</div>

		<div class="clearfix"></div>

		<div class="frame small">
			<div class="inner loginBox">
				<h3 id="login">Sign in</h3>
				<form id="userForm">
					<input id="username" placeholder="USERNAME"><br>
					<input id="password" type="password" placeholder="PASSWORD"><br>
					<button id="loginUser">Login</button>
					<button id="createUser">Create</button>
				</form>
				<div id="userInfo">
					<h3><span id="username"></span></h3>
					<button id="logOut">Logout</button>
				</div>
			</div>

			<div class="inner takeaways">
				<h3>Takeaways</h3>
				<ul>
					<li>Authenticate users and act on success / failures</li>
					<li>How to create user and login automatically</li>
					<li>After page load, look for an earlier session and try to start it</li>
					<li>Place a video web-to-web call</li>
					<li>Wire up the incoming stream + start/stop ringback tone as needed</li>
					<li>Receiving a video call</li>
					<li>Ending a video call</li>
				</ul>
			</div>
		</div>

		<div class="frame">
			<h3>Video Call</h3>
			<div id="call">
				<form id="newCall">
					<input id="callUserName" placeholder="Username (alice)"><br>
					<button id="call">Call</button>
					<button id="hangup">Hangup</button>
					<button id="answer">Answer</button>
					
				</form>
			</div>
			<div class="clearfix"><br></div>
			<video id="videooutgoing" autoplay muted></video>
			<video id="videoincoming" autoplay></video>

			<div id="callLog">
			</div>
			<div class="error">
			</div>
		</div>
	</div>

	<!-- <script src="VIDEOsample.js"></script>
 -->
</body>

</html>
<script>
var global_username = '';
/*** After successful authentication, show user interface ***/
//alert('cffvbvvdb');
var showUI = function () {
	$('div#call').show();
	$('form#userForm').css('display', 'none');
	$('div#userInfo').css('display', 'inline');
	$('h3#login').css('display', 'none');
	$('video').show();
	$('span#username').text(global_username);
}


/*** If no valid session could be started, show the login interface ***/

var showLoginUI = function () {
	$('form#userForm').css('display', 'inline');
}


//*** Set up sinchClient ***/

sinchClient = new SinchClient({
	applicationKey: '02768cf5-00c6-492a-a89d-b0f0e4faab94',
	capabilities: { calling: true, video: true },
	supportActiveConnection: true,
	//Note: For additional loging, please uncomment the three rows below
	onLogMessage: function (message) {
		console.log(message);
	},
});

sinchClient.startActiveConnection();

/*** Name of session, can be anything. ***/

var sessionName = 'sinchSessionVIDEO-' + sinchClient.applicationKey;
//alert(sessionName);

/*** Check for valid session. NOTE: Deactivated by default to allow multiple browser-tabs with different users. ***/

var sessionObj = JSON.parse(localStorage[sessionName] || '{}');
if (sessionObj.userId) {
	sinchClient.start(sessionObj)
		.then(function () {
			global_username = sessionObj.userId;
			alert(global_username);
			//On success, show the UI
			showUI();
			//Store session & manage in some way (optional)
			localStorage[sessionName] = JSON.stringify(sinchClient.getSession());
		})
		.fail(function () {
			//No valid session, take suitable action, such as prompting for username/password, then start sinchClient again with login object
			showLoginUI();
		});
}
else {
	showLoginUI();
}


/*** Create user and start sinch for that user and save session in localStorage ***/

$('button#createUser').on('click', function (event) {
	event.preventDefault();
	$('button#loginUser').attr('disabled', true);
	$('button#createUser').attr('disabled', true);
	clearError();

	var signUpObj = {};
	signUpObj.username = $('input#username').val();
	signUpObj.password = $('input#password').val();

	//Use Sinch SDK to create a new user
	sinchClient.newUser(signUpObj, function (ticket) {
		//On success, start the client
		sinchClient.start(ticket, function () {
			global_username = signUpObj.username;
			//On success, show the UI
			showUI();

			//Store session & manage in some way (optional)
			localStorage[sessionName] = JSON.stringify(sinchClient.getSession());
		}).fail(handleError);
	}).fail(handleError);
});


/*** Login user and save session in localStorage ***/

$('button#loginUser').on('click', function (event) {
	event.preventDefault();
	$('button#loginUser').attr('disabled', true);
	$('button#createUser').attr('disabled', true);
	clearError();

	var signInObj = {};
	signInObj.username = $('input#username').val();
	signInObj.password = $('input#password').val();

	//Use Sinch SDK to authenticate a user
	sinchClient.start(signInObj, function () {
		global_username = signInObj.username;
		//On success, show the UI
		showUI();

		//Store session & manage in some way (optional)
		localStorage[sessionName] = JSON.stringify(sinchClient.getSession());
	}).fail(handleError);
});

/*** Create audio elements for progresstone and incoming sound */
const audioProgress = document.createElement('audio');
const audioRingTone = document.createElement('audio');
const videoIncoming = document.getElementById('videoincoming');
const videoOutgoing = document.getElementById('videooutgoing');

/*** Define listener for managing calls ***/
var callListeners = {
	onCallProgressing: function (call) {
		audioProgress.src = 'style/ringback.wav';
		audioProgress.loop = true;
		audioProgress.play();
		videoOutgoing.srcObject = call.outgoingStream;

		//Report call stats
		$('div#callLog').append('<div id="stats">Ringing...</div>');
	},
	onCallEstablished: function (call) {
		videoOutgoing.srcObject = call.outgoingStream;
		videoIncoming.srcObject = call.incomingStream;
		audioProgress.pause();
		audioRingTone.pause();
		//Report call stats
		var callDetails = call.getDetails();
		$('div#callLog').append('<div id="stats">Answered at: ' + (callDetails.establishedTime && new Date(callDetails.establishedTime)) + '</div>');
	},
	onCallEnded: function (call) {
		audioProgress.pause();
		audioRingTone.pause();
		videoIncoming.srcObject = null;
		videoOutgoing.srcObject = null;

		$('button').removeClass('incall');
		$('button').removeClass('callwaiting');

		//Report call stats
		var callDetails = call.getDetails();
		$('div#callLog').append('<div id="stats">Ended: ' + new Date(callDetails.endedTime) + '</div>');
		$('div#callLog').append('<div id="stats">Duration (s): ' + callDetails.duration + '</div>');
		$('div#callLog').append('<div id="stats">End cause: ' + call.getEndCause() + '</div>');
		if (call.error) {
			$('div#callLog').append('<div id="stats">Failure message: ' + call.error.message + '</div>');
		}
	}
}

/*** Set up callClient and define how to handle incoming calls ***/

var callClient = sinchClient.getCallClient();
callClient.initStream().then(function () { // Directly init streams, in order to force user to accept use of media sources at a time we choose
	$('div.frame').not('#chromeFileWarning').show();
});
var call;

callClient.addEventListener({
	onIncomingCall: function (incomingCall) {
		//Play some groovy tunes 
		audioRingTone.src = 'style/phone_ring.wav';
		audioRingTone.loop = true;
		audioRingTone.play();

		//Print statistics
		$('div#callLog').append('<div id="title">Incoming call from ' + incomingCall.fromId + '</div>');
		$('div#callLog').append('<div id="stats">Ringing...</div>');
		$('button').addClass('incall');

		//Manage the call object
		call = incomingCall;
		call.addEventListener(callListeners);
		$('button').addClass('callwaiting');

		//call.answer(); //Use to test auto answer
		//call.hangup();
	}
});

$('button#answer').click(function (event) {
	event.preventDefault();

	if ($(this).hasClass("callwaiting")) {
		clearError();

		try {
			call.answer();
			$('button').removeClass('callwaiting');
		}
		catch (error) {
			handleError(error);
		}
	}
});

/*** Make a new data call ***/

$('button#call').click(function (event) {
	event.preventDefault();

	if (!$(this).hasClass("incall") && !$(this).hasClass("callwaiting")) {
		clearError();

		$('button').addClass('incall');

		$('div#callLog').append('<div id="title">Calling ' + $('input#callUserName').val() + '</div>');

		console.log('Placing call to: ' + $('input#callUserName').val());
		call = callClient.callUser($('input#callUserName').val());

		call.addEventListener(callListeners);
	}
});

/*** Hang up a call ***/

$('button#hangup').click(function (event) {
	event.preventDefault();

	if ($(this).hasClass("incall")) {
		clearError();

		console.info('Will request hangup..');

		call && call.hangup();
	}
});

/*** Log out user ***/

$('button#logOut').on('click', function (event) {
	event.preventDefault();
	clearError();

	//Stop the sinchClient
	sinchClient.terminate();
	//Note: sinchClient object is now considered stale. Instantiate new sinchClient to reauthenticate, or reload the page.

	//Remember to destroy / unset the session info you may have stored
	delete localStorage[sessionName];

	//Allow re-login
	$('button#loginUser').attr('disabled', false);
	$('button#createUser').attr('disabled', false);

	//Reload page.
	window.location.reload();
});


/*** Handle errors, report them and re-enable UI ***/

var handleError = function (error) {
	//Enable buttons
	$('button#createUser').prop('disabled', false);
	$('button#loginUser').prop('disabled', false);

	//Show error
	$('div.error').text(error.message);
	$('div.error').show();
}

/** Always clear errors **/
var clearError = function () {
	$('div.error').hide();
}

/** Chrome check for file - This will warn developers of using file: protocol when testing WebRTC **/
if (location.protocol == 'file:' && navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
	$('div#chromeFileWarning').show();
}

$('button').prop('disabled', false); //Solve Firefox issue, ensure buttons always clickable after load






</script>



