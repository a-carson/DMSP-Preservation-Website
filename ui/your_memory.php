<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T40QBMYD00"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-T40QBMYD00');
</script>

	<title>Your Memory - Memory Booth</title>
	<link rel="icon" href="../img/bg/tab-icon.png">
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<script src="https://cdn.jsdelivr.net/npm/p5@1.0.0/lib/p5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.1/addons/p5.dom.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.1/addons/p5.sound.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/tone"></script>
<!--<script type = "text/javascript" src = "../js/sound_and_vision.js"></script>-->

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Orbitron" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<!-- <link rel="stylesheet" href="../css/style_old.css"> -->

    <?php
		session_start();

		// GET JSON
		$memoriesJson = file_get_contents('../../json/memories.json');
		$memoriesArray = json_decode($memoriesJson, true);

		// GET FORM DATA
    $name = test_for_hackers($_POST["name"]);
    $category = test_for_hackers($_POST["category"]);
    $memory = test_for_hackers($_POST["memory"]);
		$memory.= " ";

		// UPDATE SESSION
		$_SESSION["name"] = $name;
		$_SESSION["category"] = $category;
		$_SESSION["memory"] = $memory;
		$_SESSION["index"] = count($memoriesArray);

		// RANDOM COLOUR GENERATION
		$h = array_fill(0, 8, 0);
		$s = array_fill(0, 8, 0);
		$b = array_fill(0, 8, 0);
		$offset = 0;
		$range = 90;

		if ($category == 'travel')
			{
				// yellow
				$offset = 0;
				$range = 90;
			}
		if ($category == 'others')
			{
				// green
				$offset = 90;
				$range = 90;
			}
		if ($category == 'student-life')
			{
				// blue
				$offset = 180;
				$range = 90;
			}
		if ($category == 'childhood')
			{
				// pink
				$offset = 270;
				$range = 90;
			}

		for ($j = 0; $j < 8; $j++)
			{
					$h[$j] = $offset + rand(0, $range);
					$s[$j] = rand(70, 360);
					$b[$j] = rand(210, 360);
			}

		// ADD TO SESSION
		$_SESSION["h"] = $h;
		$_SESSION["s"] = $s;
		$_SESSION["b"] = $b;


    function test_for_hackers($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
			$data = str_replace("'", '', $data);
			$data = str_replace('"', '', $data);
      return $data;
    }

    ?>

		<body id="body3">
			<!--
			<div class="backicon-fixed" style="margin: 20px 20px">
				<a href="record_memory.html">
					<svg t="1588027382315" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"
						p-id="1479" width="48" height="48">
						<path
							d="M960.243 456.737v110.526h-682.875l312.547 315.789-78.793 78.948-449.121-450 449.122-450 81.419 78.948-315.173 315.789h682.875z"
							p-id="1480" fill="var(--ccyan)"></path>
					</svg>
				</a>
			</div>
				<div style="text-align: center;">
					<h1 class="memory-title" style="margin: -30px">Your Memory</h1>
					<h2>Hello, <span id="name"><?php echo $name ?></span>!<br />Thanks for sharing your memory with me! <br> <span id = "encoding">Now encoding...</span></h2>
					<p id = "letters" style="color:white; margin-top: 5px;">.</p>
				<div id="sketch-holder"> </div>
		    <a href="choice.html">
		      <div class="svg-wrapper-light purple" style="border: solid 5px var(--cpurple); margin-top: 80px;">
		        <div id = "button-text" class="button-text-light" style="top:12px; color:white">Encoding...</div>
		      </div>
				</a>
		  </div>
-->
<div class="backicon-fixed" style="margin: 20px 20px">
	<a href="record_memory.html">
		<svg t="1588027382315" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"
			p-id="1479" width="48" height="48">
			<path
				d="M960.243 456.737v110.526h-682.875l312.547 315.789-78.793 78.948-449.121-450 449.122-450 81.419 78.948-315.173 315.789h682.875z"
				p-id="1480" fill="var(--lgreen)"></path>
		</svg>
	</a>
</div>
	<!--<div class="nav">
		<a href="memory_list.php">
			<img class="nav" src="../img/button/close.png" style="width: 30px;" alt="" />
		</a>
	</div>-->

	<div class="center" style="width:90%;z-index:-1">
		<div class="row">

			<div class="col-md-5">
				<div id="sketch-holder">
					<!--Canvas goes here-->
					<div class="sound-control" id="muteButton">
						<svg t="1588159547287" class="icon" viewBox="0 0 1024 1024" version="1.1"
							xmlns="http://www.w3.org/2000/svg" p-id="3660" width="34" height="34">
							<path
								d="M773.12 315.168a374.24 374.24 0 0 1 57.168 199.408 374.24 374.24 0 0 1-59.12 202.464 15.392 15.392 0 0 1-23.84 2.592l-12.16-12.16a16 16 0 0 1-2.224-19.856l2.976-4.8a326.48 326.48 0 0 0 46.368-168.24c0-60.256-16.256-116.736-44.624-165.264a281.712 281.712 0 0 0-4.736-7.76 16 16 0 0 1 2.224-19.84l11.632-11.632a16 16 0 0 1 24.752 2.624l1.568 2.464z m-81.024 84.64a262.944 262.944 0 0 1 26.192 114.768 262.88 262.88 0 0 1-28.512 119.44 15.136 15.136 0 0 1-24.208 3.84l-12.832-12.832a16 16 0 0 1-3.104-18.272c0.976-2.016 1.792-3.76 2.432-5.216a215.264 215.264 0 0 0 18.224-86.96c0-29.072-5.76-56.8-16.16-82.128a201.184 201.184 0 0 0-4.56-10.032 16 16 0 0 1 3.12-18.24l12.032-12.032a16 16 0 0 1 25.52 3.984c0.704 1.328 1.312 2.56 1.856 3.68zM240 601.392h91.248a16 16 0 0 1 10.416 3.856L528 765.168V261.568l-186.688 159.968a16 16 0 0 1-10.4 3.84H240v176z m-48 32v-240a16 16 0 0 1 16-16h111.072L549.584 179.84A16 16 0 0 1 576 192v642.8a16 16 0 0 1-26.416 12.144L319.392 649.392H208a16 16 0 0 1-16-16z"
								p-id="3661" fill="var(--lgreen)"></path>
						</svg>


					</div>
					<div class="record-hint" id="recordHint">
						<img src="../img/gif/encoding.gif" id="encoding" style="width:50%">
						<img src="../img/gif/ready.png" id="ready" style="width:50%; margin-left: 4vh;
						margin-top: 4vh;">
					</div>
					<button class="play paused" type="button">
					<svg t="1588590812767" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2129" width="24" height="24"><path d="M897.113042 467.478259 182.539132 8.904348C166.956523-2.226087 144.695654-2.226087 129.113045 6.678261c-15.582609 8.904348-26.713043 26.713043-26.713043 44.521739l0 919.373909c0 20.034783 11.130435 35.617391 26.713043 44.521739C138.017393 1021.773909 144.695654 1023.999996 153.600001 1023.999996c8.904348 0 20.034783-2.226087 28.93913-8.904348L897.113042 556.521737c15.582609-8.904348 24.486956-26.713043 24.486956-44.521739C921.599998 494.191302 912.695651 478.608694 897.113042 467.478259zM204.800001 877.078257 204.800001 146.921739 774.67826 511.999998 204.800001 877.078257z" p-id="2130" fill="var(--lgreen)"></path></svg>
					</button>
				</div>
			</div>
			<div class="col-md-7 my-auto data-panel" style="text-align: left; padding-left: 8vw;">
				<h1 class="memory-title">Your Memory</h1>
				<h2>Hello, <span id="name"><?php echo $name ?></span>. Thanks for sharing your memory with me!</h2>
				<div class="view-content scroll" id="letters">
					<p>
					</p>
				</div>

				<a href="choice.html">
					<div class="svg-wrapper-light cyan"
						style="border: solid 5px var(--ccyan);width:100%; transform:none">
						<div id="button-text" class="button-text-light" style="top:5px; color:white">Continue</div>
					</div>
				</a>

			</div>
		</div>
	</div>

		</body>

<script>
// JAVA SCRIPT CODE FOR SONIFICATION AND VISUALIZATION
//
// DMSP PRESERVATION GROUP


// VARIABLES -------------------------------------------------------------------
var memory = '';
var string = '';
var typeOutput = true;
var textLength;
var midi = [0, 0];
var freqs = [0, 0];
var octave = 0;
var i = 0;
var mute = true;
var t = 0;
var dur = 15;
var delta;
var synthA;
var synthB;
const blockSize = 1024;
var master = Tone.Master;
let waveform = new Tone.Waveform(blockSize);
//let delay = new Tone.FeedbackDelay(Tone.Time('8n'));

var masterVol = new Tone.Volume();
masterVol.volume.value = -30;

let phaser = new Tone.Phaser({
  "frequency": 0.5
});

var fbDelay = new Tone.FeedbackDelay(0.5);
fbDelay.wet.value = 0.1;
// var lpf = new Tone.Filter(4000, "lowpass", -12);
// lpf.Q.value = 5;
var childhood = false;

function setUpSynth(category)
{
switch (category)
{
  case "childhood":
      synthA = new Tone.Synth();
      synthA.oscillator.type = 'triangle';
      synthA.chain(waveform, fbDelay, masterVol, master);
      synthB = new Tone.Synth();
      synthB.oscillator.type = 'triangle';
      synthB.chain(waveform, fbDelay, masterVol, master);
      childhood = true;
      break;

  case "travel":
      synthA = new Tone.DuoSynth();
      synthA.voice1.oscillator.type = "sawtooth"
      synthA.harmonicity.value = 1;
      synthA.chain(phaser, waveform, masterVol, master);
      break;
  case "student-life":
      synthA = new Tone.FMSynth();
      synthA.oscillator.type = "square";
      synthA.harmonicity.value = 1;
      synthA.chain(waveform, masterVol, master);
      synthA.portamento = 0.03;
      break;

  case "others":
      synthA = new Tone.DuoSynth();
      synthA.harmonicity.value = 0.75;
      synthA.chain(waveform, masterVol, master);
      break;
}

}

Tone.Transport.loopEnd = dur;
Tone.Transport.loop = true;


// TEXT TO CODE -------------------------- -------------------------------------
function setInputText(string) {
  memory = string;
  textLength = memory.length;
  dur = textLength / 2;
  for (var j = 0; j < textLength; j++) {
    midi[j] = memory.charCodeAt(j) + octave;
    freqs[j] = 440 * Math.pow(2, (midi[j] - 69) / 12);
  }
}

// SOUND ----------------------------------------------------------------------
function play() {
  Tone.Transport.toggle();
  Tone.Transport.loopEnd = dur;
  i = 0;
  t = 0;
  mute = !mute;
  Tone.Master.mute = mute;
}

function sound() {
  delta = (dur / textLength) * 0.5;

  // Plays next note of array
  function triggerSynth(time) {
    i %= textLength;
    synthA.triggerAttackRelease(freqs[i], '8n', time);
    if (childhood)
        synthB.triggerAttackRelease(0.99 * freqs[i], '8n', time);
    // output text characters
    var letter = String.fromCharCode(midi[i]);
    i++;

    if (typeOutput) {
      string = string.concat(letter);
    }

    if (string.length == textLength - 1)
    {
      typeOutput = false;
      Tone.Transport.stop();
      ready();
    }

    console.log(string);
    document.getElementById("letters").innerHTML = string;
  }

  // Schedules and calls the notes
  for (var i = 0; i < textLength; i++) {
    Tone.Transport.schedule(triggerSynth, t);
    if (midi[i] - octave == 32) {
      t += delta * 3;
    } else if (midi[i] - octave == 44) {
      t += delta * 3;
    } else if (midi[i] - octave == 46) {
      t += delta * 6;
    } else t += delta;
  }

}

// VISUALS --------------------------------------------------------------------
let numCircles = 8;
let spacing = 1;
var x1 = new Uint32Array(numCircles);
var x2 = new Uint32Array(numCircles);
var y1 = new Uint32Array(numCircles);
var y2 = new Uint32Array(numCircles);
var strokes = new Uint32Array(numCircles);
var h = new Uint32Array(numCircles);
var s = new Uint32Array(numCircles);
var b = new Uint32Array(numCircles);


function setup() {
  let cnv = createCanvas(600, 600);
  cnv.parent('sketch-holder');
  noSmooth();
  colorMode(HSB, 360);
  //console.log("setup success");
}

function draw() {
  background(frameCount % 360, 360, 43);
  push();
  pop();
  sound();
  drawWaveform();
}


function drawWaveform() {
  let linesX = 40;
  let linesY = 26;
  let stepsX = width / 40;
  let stepsY = height / 26;
  let a = 0;
  let angle = (2 * PI) / 100; //can change these to change the shape originl /100
  let step = 3; // can change these to change the shape
  //let step = floor(waveform.size / 300);


  for (let i = 0; i < waveform.size - step; i += step) {
    let value = waveform.getValue()[i];
    let stepValue = waveform.getValue()[i + step];

    for (let j = 0; j < numCircles; j++) {
      let denom = 2 * Math.pow((1 + j * spacing), 0.8);
      x1[j] = width / 2 + cos(a) * (width / 2 * (value + 1) / denom);
      y1[j] = height / 2 + sin(a) * (width / 2 * (value + 1) / denom);
      x2[j] = width / 2 + cos(a + angle) * (width / 2 * (stepValue + 1) / denom);
      y2[j] = height / 2 + sin(a + angle) * (width / 2 * (stepValue + 1) / denom);
      stroke(h[j], s[j], b[j]);
      strokeWeight(strokes[j]);
      line(x1[j], y1[j], x2[j], y2[j]);
    }

    a += angle;
  }

}

function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}


// Generates semi-random colours
function setRandomColoursByCategory(colour) {
  var offset;
  var range = 90;

  if (colour.localeCompare('travel') == 0) {
    // yellow
    offset = 0;
    range = 90;
  }

  if (colour.localeCompare('others') == 0) {
    // green
    offset = 90;
    range = 90;
  }

  if (colour.localeCompare('student-life') == 0) {
    // blue
    offset = 180;
    range = 90;
  }

  if (colour.localeCompare('childhood') == 0) {
    // pink
    offset = 270;
    range = 90;
  }

  for (let j = 0; j < numCircles; j++) {
    strokes[j] = 3 - 0.3 * j;
    h[j] = offset + getRndInteger(0, range);
    s[j] = getRndInteger(70, 360);
    b[j] = getRndInteger(210, 360);
  }
}

var memory_data = '<?php echo json_encode($memory); ?>'
var text = JSON.parse(memory_data);
setUpSynth(JSON.parse('<?php echo json_encode($category); ?>'));
setInputText(text);
setColours();
play();

function setColours()
{
	h = JSON.parse('<?php echo json_encode($h); ?>');
	s = JSON.parse('<?php echo json_encode($s); ?>');
	b = JSON.parse('<?php echo json_encode($b); ?>');
	for (var i = 0; i < 8; i++)
	{
		strokes[i] = 3 - 0.3*i;
	}
}

document.getElementById("ready").style.display = "none";

var mutebutton = document.getElementById("muteButton");
var curHTML = mutebutton.innerHTML;
var isSoundOn = true;
var soundoff = '<svg t="1588158708997" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3330" width="34" height="34"><path d="M240 601.392h91.248a16 16 0 0 1 10.416 3.856L528 765.168V261.568l-186.688 159.968a16 16 0 0 1-10.4 3.84H240v176z m-48 32v-240a16 16 0 0 1 16-16h111.072L549.584 179.84A16 16 0 0 1 576 192v642.8a16 16 0 0 1-26.416 12.144L319.392 649.392H208a16 16 0 0 1-16-16z m528-155.328l62.24-62.24a16 16 0 0 1 22.608 0l11.312 11.328a16 16 0 0 1 0 22.624L753.936 512l62.24 62.24a16 16 0 0 1 0 22.608l-11.328 11.312a16 16 0 0 1-22.624 0L720 545.936l-62.24 62.24a16 16 0 0 1-22.608 0l-11.312-11.328a16 16 0 0 1 0-22.624L686.064 512l-62.24-62.24a16 16 0 0 1 0-22.608l11.328-11.312a16 16 0 0 1 22.624 0L720 478.064z" p-id="3331" fill="var(--lgreen)"></path></svg>';

mutebutton.addEventListener("click", function () {
	if (isSoundOn) {
		mutebutton.innerHTML = soundoff;
		Tone.Master.mute = true;
		isSoundOn = false;
	}
	else {
		mutebutton.innerHTML = curHTML;
		Tone.Master.mute = false;
		isSoundOn = true;
	}
});


function ready()
{
	document.getElementById("ready").style.display = "block";
	document.getElementById("encoding").style.display = "none";
}
document.querySelector('button').addEventListener('click', e => play())

$(document).ready(function() {
  var btn = $(".play");
  btn.click(function() {
    btn.toggleClass("paused");
    return false;
  });
});


</script>


</html>
