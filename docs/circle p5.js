//----------------------------------------
let mic;
let fft;
//----------------------------------------

//----------------------------------------
let lerping = true;
console.log(lerping);
//----------------------------------------

//----------------------------------------
let repel = true
let autopilot = false
let controls = true
let voice = false

//----------------------------------------
let coef = 1;
let mode = 0;
let magnitude = 0;
let maxMagnitude = 848.5281374;
//----------------------------------------
let linesX = 40;
let linesY = 26;
//console.log(typeof c);
//let distance = createVector(0,0);

//
let sourcecode
let stepsX, stepsY, radius, intensity, movement, last_sum, scale, factor, wave, sum;
//----------------------------------------
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
//----------------------------------------

let Nodes = Array.from(Array(linesX), () => new Array(linesY))

//----------------------------------------
let index = 0;

//----------------------------------------
function setup()
{
  let cnv = createCanvas(800, 600);
  fft = new p5.FFT();
  mic = new p5.AudioIn();
  mic.start();
  fft.setInput(mic)
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






//----------------------------------------

}
