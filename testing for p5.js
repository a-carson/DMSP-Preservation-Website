let mic;
let fft;

fft = new p5.FFT();
mic = new p5.AudioIn();
mic.start();
fft.setInput(mic)

let Booleanlerping = true;
console.log(typeof Booleanlerping);

let linesX = 40;
let linesY = 26;

boolean(repel = true);
boolean(autopilot = false);
boolean(controls = true);
boolean(voice = false);

let coef = 1;
let mode = 0;
let magnitude = 0;
let maxMagnitude = 848.5281374;

color c;
PVector distance;
PFont sourcecode;
let stepsX, stepsY, radius, intensity, movement, last_sum, scale, factor, wave, sum;


let xpos,ypos,speed, anchorx,anchory;
class Node{

  Node ( x, y, s) {
    anchorx = x;
    anchory = y;
    ypos = y;
    xpos = x;
    speed = s;
}

}
let v = createVector(linesX, linesY);
let Nodes=v.array();


Node[][] Nodes = new Node[linesX][linesY];


let index=0;
function input(){
  textAlign(LEFT);
}

function setup() {
  fullScreen();
  noSmooth();
  colorMode(HSB, 255);
  stepsX = (width) / linesX;
  stepsY = (height) / linesY;
  for (int i = 0; i < linesX; i++) {
    for (int j = 0; j < linesY; j++) {
      Nodes[i][j] = new Node((i+0.5)*stepsX, (j+0.5)*stepsY, 2);
    }
  }
  input();
}

function keyPressed() {
  switch(key) {
  case ' ':
    repel = !repel;
    break;
  case 'm':
    mode += 1;
    if (mode > 1) {
      mode = 0;
    }
    break;
  case 'a':
    autopilot = !autopilot;
    break;
  case 's':
    saveFrames("wavepttrn-####.jpg");
    break;
  case 'h':
    controls = !controls;
    break;
  case 'n':
    index++;
    input();
  }
}
function draw() {
  background(frameCount%255, 255, 30);
  stroke(0);
  let r=120;
  let g=120;
  let b=120;

  let a = 0;
  let angle = (2*PI) /100;
  let waveform = fft.waveform();
  let step = floor(waveform.length/100);

  for (let i = 0;i<floor(waveform.length)-step; i+=step)
  {
    let x1 = width/2 + cos(a) * (1000 * floor.mix.get(i) + 200);
    let y1 = height/2 + sin(a) * (1000 * floor.mix.get(i) + 200);
    let (x2 = width/2 + cos(a + angle) * (1000 * floor.mix.get(i+step) + 200));
    let (y2 = height/2 + sin(a + angle) * (1000 * floor.mix.get(i+step) + 200));
    fill(r,g,b);
    stroke(random(0), 255, 255);
    line(x1, y1, x2, y2);
    a += angle;
    if(i<300)
    {
      r += 255;
    }
    if (i>= 300 && i<600)
    {
      g += 255;
    }
    if (i>=600)
    {
      b += 255;
    }
  }

  coef = (repel ? 1 : -1);
  if (lerping) {
    magnitude = lerp(sum, last_sum, 0.7)/2.5;
  } else {
    magnitude = last_sum;
  }
  wave = last_sum/2.5;

  for (int i = 0; i < linesX; i++) {
    for (int j = 0; j < linesY; j++) {
      if (autopilot) {

      } else {
        distance = new PVector(Nodes[i][j].xpos - mouseX, Nodes[i][j].ypos - mouseY);
      }
      scale = (1/distance.mag())*magnitude;
      fill(255);
      intensity = pow(1 - distance.mag()/(maxMagnitude), 5) / 5;
      radius = (intensity*magnitude);
      Nodes[i][j].xpos += coef*(distance.x*scale)/25;
      Nodes[i][j].ypos += coef*(distance.y*scale)/25;
      Nodes[i][j].xpos = lerp(Nodes[i][j].xpos, Nodes[i][j].anchorx, 0.05);
      Nodes[i][j].ypos = lerp(Nodes[i][j].ypos, Nodes[i][j].anchory, 0.05);
      if (radius > 50) {
        radius = 50;
      }
      if (radius < 2) {
        radius = 2;
      }
      c = color(170 + magnitude/2, magnitude*5, 255, 255);
      fill(c);
      stroke(c);
      if (mode == 0) {
        ellipse(Nodes[i][j].xpos + coef*(distance.x*scale), Nodes[i][j].ypos + coef*(distance.y*scale), radius, radius);
      }
      if (mode == 1) {
        strokeWeight(radius/3);
        strokeCap(PROJECT);
        line(Nodes[i][j].xpos + coef*(distance.x*scale), Nodes[i][j].ypos + coef*(distance.y*scale), Nodes[i][j].xpos, Nodes[i][j].ypos);
      }
    }
  }

  c = color(170 + wave/2, wave*5, 255, 255);
  fill(c);
  stroke(c);
  strokeWeight(2);
  sum = 0;
  for (let i = 0; i < floor.wavefrom() - 1; i++)
  {
    if (voice) {
    line(i*factor, height/2 + floor.left.get(i)*last_sum + 2, i*factor+1, height/2 + floor.left.get(i+1)*last_sum + 2);
    sum += abs(floor.left.get(i));
    } else {
   line(i*factor, height/2 + floor.left.get(i)*last_sum + 2, i*factor+1, height/2 + floor.left.get(i+1)*last_sum + 2);
   sum += abs(floor.left.get(i));
    }
  }
  last_sum = sum;
  if (controls) {
    fill(255, 0, 255);
    textSize(18);
  }
}
