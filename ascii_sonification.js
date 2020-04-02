
// Synth Settings   -------------------------------------------------
function sonify(string)
{
//var master = new Tone.Master();

// Octave?
var octave = 0;

// Reverb
var reverb = new Tone.JCReverb(0.8);
var delay = new Tone.FeedbackDelay(Tone.Time('8n'));

// Volume
var vol = new Tone.Volume(-1);

// Filter
var hpf = new Tone.Filter(100, "highpass", -48);
var lpf = new Tone.Filter(5000, "lowpass", -48);

// Phaser
var phaser = new Tone.Phaser({
	"frequency" : 0.1,
});



// Synths
var synthA = new Tone.Synth
({
oscillator: {
    type: 'triangle'
  },
}).chain(vol,
  phaser,
  delay,
  //reverb,
  lpf,
  hpf,
  Tone.Master)


var synthB = new Tone.Synth
({
oscillator: {
    type: 'triangle'
  },
}).chain(vol,
  phaser,
  delay,
  //reverb,
  lpf,
  hpf,
  Tone.Master)

  var synthC = new Tone.Synth
  ({
  oscillator: {
      type: 'square'
    },
  }).chain(vol,
    phaser,
    delay,
    //reverb,
    lpf,
    hpf,
    Tone.Master)

    var synthD = new Tone.Synth
    ({
    oscillator: {
        type: 'square'
      },
    }).chain(vol,
      phaser,
      delay,
      //reverb,
      lpf,
      hpf,
      Tone.Master)

// Text to Code - Create MIDI vector -------------------------------------
var text = string;
var textLength = text.length;
var midi = [0, 0];
var freqs = [0, 0];

for (var j = 0; j < textLength; j++)
{
  midi[j] = text.charCodeAt(j) + octave;
  freqs [j] = 440 * Math.pow(2, (midi[j]-69)/12);
}

// ----------------------------------------------------------------------

// Playback
var i = 0;
mute = true;
var t = 0;
var dur = 15;
var delta = (dur/textLength)*0.5;

// Called when play pressed


function play()
{
  Tone.Transport.toggle();
  Tone.Transport.loopEnd = dur;
  i = 0;
  t = 0;
  mute = !mute;
  Tone.Master.mute = mute;
}

// Plays next note of array
function triggerSynth(time)
{
  i %= textLength;
	synthA.triggerAttackRelease(freqs[i], '8n', time)
  synthB.triggerAttackRelease(freqs[i]*0.98, '8n', time)
  synthC.triggerAttackRelease(freqs[i]/2, '8n', time)
  synthC.triggerAttackRelease((freqs[i]/4), '8n', time)
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
//changeRate(0.5);
}

// Changes playbackrate - still weird shit going on
//  function changeRate(increment)
// {
//   dur -= increment;
//   delta = (dur/textLength)*0.5;
//   Tone.Transport.loopEnd = dur;
// }



document.querySelector('button').addEventListener('click', e => play())
//document.querySelector('tone-slider').addEventListener('change', e => changeRate(e.detail))
Tone.Transport.loop = true;
//play();

}
