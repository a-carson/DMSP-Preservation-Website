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
  <link rel="icon" href="../img/tab-icon.png">

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
session_start();
$index = $_SESSION["index"];
session_destroy();

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

// EFFECTS
var synthVol = new Tone.Volume();
synthVol.volume.value = -30;

var phaser = new Tone.Phaser({
  "frequency": 0.5
});
var delay = new Tone.FeedbackDelay(0.5);
delay.wet.value = 0.1;
var lpf = new Tone.Filter(4000, "lowpass", -12);
lpf.Q.value = 5;
var childhood = false;
function setUpSynth(category)
{
switch (category)
{
  case "childhood":
      synthA = new Tone.Synth();
      synthA.oscillator.type = 'triangle';
      synthA.chain(waveform, delay, synthVol, master);
      synthB = new Tone.Synth();
      synthB.oscillator.type = 'triangle';
      synthB.chain(waveform, delay, synthVol, master);
      childhood = true;
      break;

  case "travel":
      synthA = new Tone.DuoSynth();
      synthA.voice1.oscillator.type = "sawtooth"
      synthA.harmonicity.value = 1;
      synthA.chain(phaser, waveform, synthVol, master);
      break;
  case "student-life":
      synthA = new Tone.FMSynth();
      synthA.oscillator.type = "square";
      synthA.harmonicity.value = 1;
      synthA.chain(waveform, synthVol, master);
      synthA.portamento = 0.03;
      break;

  case "others":
      synthA = new Tone.DuoSynth();
      synthA.harmonicity.value = 0.75;
      synthA.chain(waveform, synthVol, master);
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
  cnv.mouseOver(() => noiseOn = true);
  cnv.mouseOut(() => noiseOn = false);
  noiseSynth.triggerAttack();

  //console.log("setup success");
}

function draw() {
  background(frameCount % 360, 360, 43);
  push();
  pop();
  sound();
  drawWaveform();
  noiseFcn();
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


  var memory_data = '<?php echo json_encode($memory); ?>';
  var text = JSON.parse(memory_data);
  setUpSynth(JSON.parse('<?php echo json_encode($category); ?>'));
  setInputText(text);
  setColours();
  play();
  typeOutput = false;

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

  "use strict";

  // NOISE %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
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

  var noiseVol = new Tone.Volume(-40);
  noiseSynth.chain(filterSweep, noiseVol, waveform, master);
  noiseSynth.sync();
  var noiseOn = false;

  function noiseFcn()
  {

    if (noiseOn)
    {
          var val = noiseVol.volume.value;
          if (val < 50)
          {
          noiseVol.volume.value += 0.4;
          synthVol.volume.value -= 0.1;
          }
    }

  }

  //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
  
  //ONLOAD
  $(function () {
    //DECLARE GLOBAL VARIABLE FOR USE IN HANDLERS
    var orig, sib;
    var runs = 0;
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
      }, 200);
    }, function()
    {
      clearInterval(sib);
      noiseOn = false;
    }
  );

    function distortText(i) {
      //MAINTAINS SOME READABILITY IN THE TEXT BY ONLY ALLOWING 3 CHARACTERS TO BE DISTORTED
      // if (runs >= 10){
      //   runs = 0;
      //   i.text(orig);
      //   return;
      // }
      //GET EACH INDIVIDUAL CHARACTER
      noiseOn = true;

      var chars = i.text().split(''); //GET A RANDOM CHARACTER FROM THE TEXT

      var rand = Math.floor(Math.random() * chars.length); //GET A RANDOM REPLACEMENT CHARACTER

      var randRep = Math.floor(Math.random() * charSet.length); //CHECK TO MAKE SURE THAT THE NEW CHARACTER IS DIFFERENT FROM THE OLD

      if (chars[rand] != charSet[randRep])
      {
        chars[rand] = charSet[randRep];
      }
      else {
        //distortText(i);
      } //UPDATE TEXT

      i.text(chars.join(''));
      //runs += 1;
    }
  });




  </script>


</html>
