// JAVA SCRIPT CODE FOR SONIFICATION AND VISUALIZATION
//
// DMSP PRESERVATION GROUP


// VARIABLES -------------------------------------------------------------------
var master = Tone.Master;
let waveform = new Tone.Waveform(1024);
synthA = new Tone.Synth();
synthA.oscillator.type = 'triangle';
synthA.chain(waveform, master);
Tone.Transport.loopEnd = dur;
Tone.Transport.loop = true;

var text;
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

// TEXT TO CODE -------------------------- -------------------------------------
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

// VISUALS --------------------------------------------------------------------
function setup()
{
  let cnv = createCanvas(800, 600);
  noSmooth();
  colorMode(HSB, 255);
  console.log("setup success");
}

function draw()
{
background(frameCount % 255, 255, 30);
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
  let angle = (2 * PI) / 100;
  let step = floor(waveform.size / 300);
  let r = [190, 190, 190, 190];
  let g = [190, 100, 100, 100];
  let b = [255, 200, 100, 50];
    for (let i = 0; i < waveform.size - step; i += step)
    {

        let x1 = (width / 2) + cos(a) * (width/2 * (waveform.getValue()[i] + 1) / 2);
        let y1 = height / 2 + sin(a) * (width/2 * (waveform.getValue()[i] + 1) / 2);
        let x2 = width / 2 + cos(a + angle) * (width/2 * (waveform.getValue()[i + step] + 1) / 2);
        let y2 = height / 2 + sin(a + angle) * (width/2 * (waveform.getValue()[i + step] + 1) / 2);
        stroke(r[0], g[0], b[0]);
        strokeWeight(3);
        line(x1, y1, x2, y2);

        let x3 = width / 2 + cos(a) * (width/2 * (waveform.getValue()[i] + 1) / 4);
        let y3 = height / 2 + sin(a) * (width/2 * (waveform.getValue()[i] + 1) / 4);
        let x4 = width / 2 + cos(a + angle) * (width/2 * (waveform.getValue()[i + step] + 1) / 4);
        let y4 = height / 2 + sin(a + angle) * (width/2 * (waveform.getValue()[i + step] + 1) / 4);
        stroke(190, 100, 200);
        strokeWeight(2);
        line(x3, y3, x4, y4);

        let x5 = width / 2 + cos(a) * (width/2 * (waveform.getValue()[i] + 1) / 8);
        let y5 = height / 2 + sin(a) * (width/2 * (waveform.getValue()[i] + 1) / 8);
        let x6 = width / 2 + cos(a + angle) * (width/2 * (waveform.getValue()[i + step] + 1) / 8);
        let y6 = height / 2 + sin(a + angle) * (width/2 * (waveform.getValue()[i + step] + 1) / 8);
        stroke(190, 100, 100);
        strokeWeight(1);
        line(x5, y5, x6, y6);

        let x7 = width / 2 + cos(a) * (width/2 * (waveform.getValue()[i] + 1) / 16);
        let y7 = height / 2 + sin(a) * (width/2 * (waveform.getValue()[i] + 1) / 16);
        let x8 = width / 2 + cos(a + angle) * (width/2 * (waveform.getValue()[i + step] + 1) / 16);
        let y8 = height / 2 + sin(a + angle) * (width/2 * (waveform.getValue()[i + step] + 1) / 16);
        stroke(190, 100, 50);
        strokeWeight(1);
        line(x7, y7, x8, y8);

        a += angle;
      }

}
