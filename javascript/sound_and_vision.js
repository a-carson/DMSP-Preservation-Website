
// Variables - sound +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
var master = Tone.Master;
let toneWaveform = new Tone.Waveform(256);
var text;
var textLength;
var midi = [0, 0];
var freqs = [0, 0];
var octave = 0;
var node = new Tone.AudioNode();
var analyser = new Tone.Analyser("fft", 1024);
var dft = new Tone.FFT([1024]);

var i = 0;
mute = true;
var t = 0;
var dur = 15;
var delta;

var synthA = new Tone.Synth();
synthA.oscillator.type = 'triangle';
synthA.chain(toneWaveform, master);
Tone.Transport.start();
Tone.Transport.loopEnd = dur;
Tone.Transport.loop = true;
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// Variables - visual  ------------------------------------------------------------
let mic;
let fft;
let lerping = true;
console.log(lerping);
let repel = true
let autopilot = false
let controls = true
let voice = false
let coef = 1;
let mode = 0;
let magnitude = 0;
let maxMagnitude = 848.5281374;
let linesX = 40;
let linesY = 26;
let sourcecode
let stepsX, stepsY, radius, intensity, movement, last_sum, scale, factor, wave, sum;

class Node
{
  constructor(x, y, s)
  {
    this.anchorx = x;
    this.anchory = y;
    this.ypos = y;
    this.xpos = x;
    this.speed = s;
  }
}

let Nodes = Array.from(Array(linesX), () => new Array(linesY))
let index = 0;
//---------------------------------------------------------------------------------

// Text to Code - Create MIDI vector -------------------------------------
function setInputText(string)
{
  text = string;
  textLength = text.length;

  for (var j = 0; j < textLength; j++)
  {
    midi[j] = text.charCodeAt(j) + octave;
    freqs [j] = 440 * Math.pow(2, (midi[j]-69)/12);
  }
}


function sound()
{

  delta = (dur/textLength)*0.5;

  // Plays next note of array
  function triggerSynth(time)
  {
    i %= textLength;
  	synthA.triggerAttackRelease(freqs[i], '8n', time)
    i++;
  }

  // Schedules and calls the notes
  for (var i = 0; i < textLength; i++)
  {
    Tone.Transport.schedule(triggerSynth, t);
    if (midi[i] - octave == 32) {t += delta*3;}
    else if (midi[i] - octave == 44) {t += delta*3;}
    else if (midi[i] - octave == 46){t += delta*6;}
    else t += delta;
  }
}

function setup()
{
  let cnv = createCanvas(800, 600);
  fft = new p5.FFT();
  //mic = new p5.AudioIn();
  //mic.start();
  //fft.setInput(node);
  noSmooth();
  let c = color(0,0,0);
  colorMode(HSB, 255);

  console.log("setup success");
}

//----------------------------------------
function draw()
{

  background(frameCount % 255, 255, 30);
  //stroke(0);
  let r = 120;
  let g = 120;
  let b = 120;
  console.log("draw success");
  let linesX = 40;
  let linesY = 26;

  let stepsX = width / 40;
  let stepsY = height / 26;

  let a = 0;
  let angle = (2 * PI) / 100;
  let waveform = fft.waveform();
  //let waveform = analyser;
  let step = floor(waveform.length / 300);


  for (let i = 0; i < waveform.length - step; i += step) {
    let x1 = (width / 2) + cos(a) * (width/2 * (waveform[i] + 1) / 2);

    let y1 = height / 2 + sin(a) * (width/2 * (waveform[i] + 1) / 2);
    let x2 = width / 2 + cos(a + angle) * (width/2 * (waveform[i + step] + 1) / 2);
    let y2 = height / 2 + sin(a + angle) * (width/2 * (waveform[i + step] + 1) / 2);
    //stroke(34, 225, 273);
    stroke(190, 190,255);
    strokeWeight(3);
    line(x1, y1, x2, y2);
    a += angle;
    if (i < 300)
    {
      r += 255;
    }
    if (i >= 300 && i < 600)
    {
      g += 255;
    }
    if (i >= 600)
    {
      b += 255;
    }

  }
    sound();
}
