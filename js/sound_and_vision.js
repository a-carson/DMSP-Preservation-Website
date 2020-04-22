// JAVA SCRIPT CODE FOR SONIFICATION AND VISUALIZATION
//
// DMSP PRESERVATION GROUP


// VARIABLES -------------------------------------------------------------------
var text = '';
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

synthA = new Tone.Synth();
synthA.oscillator.type = 'triangle';
synthA.chain(waveform, master);
synthB = new Tone.Synth();
synthB.oscillator.type = 'triangle';
synthB.chain(waveform, master);

Tone.Transport.loopEnd = dur;
Tone.Transport.loop = true;

var delay = new Tone.FeedbackDelay(Tone.Time('8n'));



// TEXT TO CODE -------------------------- -------------------------------------
function setInputText(string)
{
  text = string;
  textLength = text.length;
  dur = textLength/2;
  for (var j = 0; j < textLength; j++)
  {
    midi[j] = text.charCodeAt(j) + octave;
    freqs [j] = 440 * Math.pow(2, (midi[j]-69)/12);
  }
}

// SOUND ----------------------------------------------------------------------
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
  delta = (dur/textLength)*0.5;

  // Plays next note of array
  function triggerSynth(time)
  {
    i %= textLength;
  	synthA.triggerAttackRelease(freqs[i], '8n', time);
    synthB.triggerAttackRelease(0.99 * freqs[i], '8n', time);
    // output text characters
    var letter = String.fromCharCode(midi[i]);
    console.log(letter);
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
// let r = [190, 190, 190, 190, 190, 190, 190, 190];
// let g = [190, 100, 100, 100, 190, 100, 100, 100];
// let b = [255, 200, 100, 50, 190, 100, 100, 100];
//colourThresh = 75;

function setup()
{
  let cnv = createCanvas(800, 600);
  noSmooth();
  colorMode(HSB, 360);
  console.log("setup success");
}

function draw()
{
background(frameCount % 360, 360, 43);
push();
pop();
sound();
drawWaveform();
}

function drawWaveform()
{
  let linesX = 40;
  let linesY = 26;
  let stepsX = width / 40;
  let stepsY = height / 26;
  let a = 0;
  let angle = (2 * PI) / 100;     //can change these to change the shape originl /100
  let step = 3;                   // can change these to change the shape
  //let step = floor(waveform.size / 300);


    for (let i = 0; i < waveform.size - step; i += step)
    {
        let value = waveform.getValue()[i];
        let stepValue = waveform.getValue()[i + step];

        for (let j = 0; j < numCircles; j++)
        {
          let denom = 2 * Math.pow((1 + j*spacing), 0.8);
          x1[j] = width/2   +   cos(a) * (width/2 * (value + 1) / denom);
          y1[j] = height/2  +   sin(a) * (width/2 * (value + 1) / denom);
          x2[j] = width/2   +   cos(a + angle) * (width/2 * (stepValue + 1) / denom);
          y2[j] = height/2  +   sin(a + angle) * (width/2 * (stepValue + 1) / denom);
          stroke(h[j], s[j], b[j]);
          strokeWeight(strokes[j]);
          line(x1[j], y1[j], x2[j], y2[j]);
        }

        a += angle;
      }

}

function getRndInteger(min, max)
{
  return Math.floor(Math.random() * (max - min) ) + min;
}

function getColour(colour,j)
{
  if (colour == 1)
      return r[j];

  if (colour == 2)
      return g[j];

  if (colour == 3)
      return b[j];
}

// Generates semi-random colours
function setRandomColoursByCategory(colour)
{
  var offset;
  var range = 90;

  if (colour.localeCompare('travel') == 0)
    {
      // yellow
      offset = 0;
      range = 90;
    }

  if (colour.localeCompare('others') == 0)
    {
      // green
      offset = 90;
      range = 90;
    }

  if (colour.localeCompare('student-life') == 0)
    {
      // blue
      offset = 180;
      range = 90;
    }

  if (colour.localeCompare('childhood') == 0)
    {
      // pink
      offset = 270;
      range = 90;
    }

for (let j = 0; j < numCircles; j++)
  {
    strokes[j] = 3 - 0.3*j;
    h[j] = offset + getRndInteger(0, range);
    s[j] = getRndInteger(70, 360);
    b[j] = getRndInteger(210, 360);
  }
}

function getColours(i)
{
  return h[i];
}
