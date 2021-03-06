<!doctype html>
<html>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T40QBMYD00"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-T40QBMYD00');
</script>

  <meta charset="UTF-8">
  <title>View Memory - Memory Booth </title>
  <link rel="icon" href="../img/bg/tab-icon.png">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">


<script src="https://cdn.jsdelivr.net/npm/p5@1.0.0/lib/p5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.1/addons/p5.dom.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.1/addons/p5.sound.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src="https://unpkg.com/tone"></script>
<!--<script type="text/javascript" src="../js/sound_and_vision.js"></script>-->

<link href="https://fonts.googleapis.com/css2?family=Orbitron" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400&display=swap" rel="stylesheet">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel="stylesheet" href="../css/style.css">
</head>

<?php
error_reporting(0);
session_start();
$index = $_SESSION["index"];        // only relevant if user has arrived from save.php
session_destroy();

// GET JSON CONTENTS
$memoriesJson = file_get_contents('../../json/memories.json');
$memoriesArray = json_decode($memoriesJson, true);
$array_length = count($memoriesArray);

// FIND WHICH BUTTON WAS CLICKED
for ($i = 0; $i < $array_length; $i++)
{
		$submit_name = "submit_";
		$submit_name .= strval($i);
		//echo $submit_name;
		$check = isset($_GET[$submit_name]);

		if ($check == 1)
				$index = $i;
}

// GET CORRESPONDING MEMORY
$name = $memoriesArray[$index]["name"];
$memory = $memoriesArray[$index]["memory"];
$category = $memoriesArray[$index]["category"];
$h = $memoriesArray[$index]["h"];
$s = $memoriesArray[$index]["s"];
$b = $memoriesArray[$index]["b"];
?>

<body id="body3" style="overflow:hidden;">

	<div class="nav">
		<a href="memory_list.php">
			<img class="nav" src="../img/button/close.png" style="width: 30px;" alt="" />
		</a>
	</div>


	<div class="center" style="width:90%">
		<div class="row">
			<div class="col-md-5">
				<div id="sketch-holder">

        <div class="sound-control" id="muteButton">
						<svg t="1588159547287" class="icon" viewBox="0 0 1024 1024" version="1.1"
							xmlns="http://www.w3.org/2000/svg" p-id="3660" width="34" height="34">
							<path
								d="M773.12 315.168a374.24 374.24 0 0 1 57.168 199.408 374.24 374.24 0 0 1-59.12 202.464 15.392 15.392 0 0 1-23.84 2.592l-12.16-12.16a16 16 0 0 1-2.224-19.856l2.976-4.8a326.48 326.48 0 0 0 46.368-168.24c0-60.256-16.256-116.736-44.624-165.264a281.712 281.712 0 0 0-4.736-7.76 16 16 0 0 1 2.224-19.84l11.632-11.632a16 16 0 0 1 24.752 2.624l1.568 2.464z m-81.024 84.64a262.944 262.944 0 0 1 26.192 114.768 262.88 262.88 0 0 1-28.512 119.44 15.136 15.136 0 0 1-24.208 3.84l-12.832-12.832a16 16 0 0 1-3.104-18.272c0.976-2.016 1.792-3.76 2.432-5.216a215.264 215.264 0 0 0 18.224-86.96c0-29.072-5.76-56.8-16.16-82.128a201.184 201.184 0 0 0-4.56-10.032 16 16 0 0 1 3.12-18.24l12.032-12.032a16 16 0 0 1 25.52 3.984c0.704 1.328 1.312 2.56 1.856 3.68zM240 601.392h91.248a16 16 0 0 1 10.416 3.856L528 765.168V261.568l-186.688 159.968a16 16 0 0 1-10.4 3.84H240v176z m-48 32v-240a16 16 0 0 1 16-16h111.072L549.584 179.84A16 16 0 0 1 576 192v642.8a16 16 0 0 1-26.416 12.144L319.392 649.392H208a16 16 0 0 1-16-16z"
								p-id="3661" fill="var(--lgreen)"></path>
						</svg>
					</div>


				</div>
			</div>
			<div class="col-md-7 my-auto" style="text-align: left; padding-left: 8vw;">
				<span class="view-memory" id="id">#0<?php echo $index + 1;?> </span>
				<span class="view-memory" id="name"><?php echo $name ;?></span>
				<div class="view-content scroll" id="content">
					<p class="distort">
						<?php echo $memory?>
					</p>
				</div>


				<h3 style="display: inline-block;">Category:</h3>
				<span class="view-memory" id="category"><?php echo $category ?></span>
			</div>
		</div>
	</div>



</body>

<script>
// JAVA SCRIPT CODE FOR SONIFICATION AND VISUALIZATION
//
// DMSP PRESERVATION GROUP

/////////////////////////// SONIFICATION //////////////////////////////////////////////////////
// VARIABLES -------------------------------------------------------------------
var memory = '';                                    // input string
var textLength;                                     // length of memory
var midi = [0, 0];                                  // midi array
var freqs = [0, 0];                                 // frequency array
var octave = 0;                                     // shifts the notes by an octave
var i = 0;                                          // current index
var mute = true;                                    // mute boolean
var t = 0;                                          // current time (s)
var dur = 15;                                       // length of one loop (s)
var delta;                                          // time step between notes (s)

// SYNTHESISERS ----------------------------------------------------------------------
var synthA;
var synthB;
const blockSize = 1024;
var master = Tone.Master;
var masterVol = new Tone.Volume(-30);
let waveform = new Tone.Waveform(blockSize);        // to connect with

// volume
var synthVol = new Tone.Volume();
synthVol.volume.value = 0;
console.log(synthVol.volume.value);

// phaser
let phaser = new Tone.Phaser({
  "frequency": 0.5
});

// delay
var fbDelay = new Tone.FeedbackDelay(0.5);
fbDelay.wet.value = 0.1;

// low pass filter
var lpf = new Tone.Filter(4000, "lowpass", -12);
lpf.Q.value = 5;
var others = false;

// set synth settings based on category
function setUpSynth(category)
{
switch (category)
{
  case "childhood":
  synthA = new Tone.DuoSynth();
  synthA.harmonicity.value = 0.75;
  synthA.chain(waveform, fbDelay, masterVol, master);
  fbDelay.wet.value = 0;
  break;

  case "travel":
      synthA = new Tone.DuoSynth();
      synthA.voice1.oscillator.type = "sawtooth"
      synthA.harmonicity.value = 1;
      synthA.chain(phaser, waveform, fbDelay, masterVol, master);
      fbDelay.wet.value = 0;
      break;
  case "student-life":
      synthA = new Tone.FMSynth();
      synthA.oscillator.type = "square";
      synthA.harmonicity.value = 1;
      synthA.chain(waveform, fbDelay, masterVol, master);
      synthA.portamento = 0.03;
      fbDelay.wet.value = 0;
      break;

  case "others":
  synthA = new Tone.Synth();
  synthA.oscillator.type = 'triangle';
  synthA.chain(synthVol, waveform, fbDelay, masterVol, master);
  synthB = new Tone.Synth();
  synthB.oscillator.type = 'triangle';
  synthB.chain(synthVol, waveform, fbDelay, masterVol, master);
  others = true;
  fbDelay.wet.value = 0.1;
  break;
}

}

// transport
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

// SYNTHESIS PROCESS -----------------------------------------------------------
function play()
{
  Tone.Transport.toggle();
  Tone.Transport.loopEnd = dur;
  i = 0;
  t = 0;
  mute = !mute;
  Tone.Master.mute = mute;
}

function sound()
{
  delta = (dur / textLength) * 0.5;

  // Plays next note of array
  function triggerSynth(time) {
    i %= textLength;
    synthA.triggerAttackRelease(freqs[i], '8n', time);

    if (others)
        synthB.triggerAttackRelease(0.99 * freqs[i], '8n', time);

    i++;

    noiseSynth.triggerAttack();
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

////////////////////////////// VISUALS //////////////////////////////////////////
// VARIABLES -------------------------------------------------------------------
let numCircles = 8;                           // number of concentric cirlces in visual
let spacing = 1;                              // spacing between circles
var x1 = new Uint32Array(numCircles);         // initialise arrays
var x2 = new Uint32Array(numCircles);
var y1 = new Uint32Array(numCircles);
var y2 = new Uint32Array(numCircles);
var strokes = new Uint32Array(numCircles);
var h = new Uint32Array(numCircles);
var s = new Uint32Array(numCircles);
var b = new Uint32Array(numCircles);

// SET UP ----------------------------------------------------------------------
function setup() {
  let cnv = createCanvas(600, 600);
  cnv.parent('sketch-holder');
  noSmooth();
  colorMode(HSB, 360);
  cnv.mouseOver(() => noiseOn = true);
  cnv.mouseOut(() => noiseOn = false);
}

// MAIN DRAW FUNCTION ----------------------------------------------------------
function draw() {
  background(frameCount % 360, 360, 43);
  push();
  pop();
  sound();
  drawWaveform();
  noiseFcn();
}

// DRAW WAVEFORM ---------------------------------------------------------------
function drawWaveform() {
  let linesX = 40;
  let linesY = 26;
  let stepsX = width / 40;
  let stepsY = height / 26;
  let a = 0;
  let angle = (2 * PI) / 100; //can change these to change the shape originl /100
  let step = 3;               // can change these to change the shape

  for (let i = 0; i < waveform.size - step; i += step)
  {
    let value = waveform.getValue()[i];
    let stepValue = waveform.getValue()[i + step];

    for (let j = 0; j < numCircles; j++)
    {
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

//////////////////  INITIALISE AND TRIGGER ENTIRE PROCESS /////////////////////
var memory_data = '<?php echo json_encode($memory); ?>';          // get current memory from PHP
var text = JSON.parse(memory_data);
setUpSynth(JSON.parse('<?php echo json_encode($category); ?>'));  // set synth voice based on category
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

/////////////////////////////////////////////////////////////////////////////////
  "use strict";

  ////////////////////// NOISE STUFF /////////////////////////////////////////////////
  var noiseSynth = new Tone.NoiseSynth({
  "envelope" : {
  "attack" : 0.5 ,
  "decay" : 0.1 ,
  "sustain" : 1
  }
  });

  var filterSweep = new Tone.AutoFilter();
  filterSweep.baseFrequency.value = 100;
  filterSweep.octaves.value = 6;
  filterSweep.frequency.value = 0.1;

  var noiseVol = new Tone.Volume(-35);
  noiseSynth.chain(filterSweep, noiseVol, waveform, fbDelay, masterVol, master);
  noiseSynth.sync();
  var noiseOn = false;


  function noiseFcn()
  {
    if (noiseOn)
    {
          // fade out synth
          synthVol.volume.value -= 0.1;

          // increase noise volume logarithmically
          noiseVol.volume.value -= 100;
          noiseVol.volume.value *= 0.995;
          noiseVol.volume.value += 100;

          // fade out master
          if (noiseVol.volume.value > 30)
          {
            masterVol.volume.value -= 0.1;
          }

    }

  }

/////////////////////////////// UI STUFF ///////////////////////////////////////


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

///////////////////////// TEXT DISTORTION //////////////////////////////////////
  $(function () {
    //DECLARE GLOBAL VARIABLE FOR USE IN HANDLERS
    var orig, sib;
    var charSet = '   abcdefghijklmnopqrstuvwxyz1234567890+>?-$#@%&*'; //RUN JS WHEN 'DISTORT' IS HOVERED
    var memory_data = '<?php echo json_encode($memory); ?>';
    var text = JSON.parse(memory_data);

    $('.distort').hover(function ()
    {
      var curr = $(this);
      orig = $(this).text();
      noiseFcn();

      sib = setInterval(function ()
      {
        distortText(curr);
      }, 175);
    }, function()
    {
      clearInterval(sib);
      noiseOn = false;
    }
  );

    function distortText(i)
    {

      noiseOn = true;
      var chars = i.text().split('');                           //GET A RANDOM CHARACTER FROM THE TEXT
      var rand = Math.floor(Math.random() * chars.length);      //GET A RANDOM REPLACEMENT CHARACTER
      var randRep = Math.floor(Math.random() * charSet.length); //CHECK TO MAKE SURE THAT THE NEW CHARACTER IS DIFFERENT FROM THE OLD

      if (chars[rand] != charSet[randRep])
      {
        chars[rand] = charSet[randRep];
      }

      i.text(chars.join(''));
    }
  });

  </script>


</html>
