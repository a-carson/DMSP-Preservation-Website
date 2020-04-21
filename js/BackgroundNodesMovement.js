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

//--------------------------------------------------------------------
let linesX = 40;
let linesY = 26;


//----------------------------------------
let coef = 1;
let mode = 0;
let node_scale = 0.1;
let magnitude = 0;
let maxMagnitude = 848.5281374;
//----------------------------------------
// let c = color([0],[0],[0]);
// console.log(typeof c);
// let distance = createVector(0,0);

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
Nodes = [];
for (let x = 0; x  < linesX; x++)
{
  for (let y = 0; y  < linesY; y++)
  {
    Nodes = new Node((x + 0.5) * stepsX, (y + 0.5) * stepsY, 2);
  }
}
//----------------------------------------
let index = 0;
function input()
{
  textAlign(LEFT);
  console.log("input success");
}
//----------------------------------------
function setup()
{
  createCanvas(800, 600);
  
    let stepsX = width / linesX;
  let stepsY = height / linesY;
  for (let x = 0; x < linesX; x++)
  {
    Nodes[x] = []; // create nested array
    for (let y = 0; y < linesY; y++)
    {
      Nodes[x][y] = new Node((x + 0.5) * stepsX, (y + 0.5) * stepsY, 2);
    }
  }
  console.log(Nodes);

  
  fft = new p5.FFT();
  mic = new p5.AudioIn();
  mic.start();
  fft.setInput(mic)
  //fullScreen();
  //noSmooth();
  colorMode(HSB, 255);

 
  // input();
  console.log("setup success");
}
//----------------------------------------
function draw()
{
  background(frameCount % 255, 255, 30);
  background(255);
  radius = 2;
  fill(0);
  
    for (let x = 0; x < linesX; x++)
  {
    for (let y = 0; y < linesY; y++)
    {
      let distance = createVector((Nodes[x][y].xpos - mouseX), (Nodes[x][y].ypos - mouseY));
      ellipse(Nodes[x][y].xpos + coef * (distance.x * node_scale), Nodes[x][y].ypos + coef * (distance.y * node_scale), radius, radius);
    }
  }
  
  
  
  
  


  
  //-----------------------------------------------

  coef = (repel ? 1 : -1);
  if (lerping)
  {
    magnitude = lerp(sum, last_sum, 0.7) / 2.5;
  }
  else
  {
    magnitude = last_sum;
  }
  wave = last_sum / 2.5;

  for (let x = 0; x < linesX; x++)
  {
    for (let y = 0; y < linesY; y++)
    {
      if (autopilot)
      {

      }
      else
      {
     let  distance = createVector(Nodes[x][y].xpos - mouseX, Nodes[x][y].ypos - mouseY);
      }
    scale = (1 / mag((Nodes[x][y].xpos - mouseX),(Nodes[x][y].ypos - mouseY))) * magnitude;


      
      fill(255);
      let distance=createVector((Nodes[x][y].xpos - mouseX), (Nodes[x][y].ypos - mouseY));
      intensity = pow(1 - mag(distance) / (maxMagnitude), 5) / 5;
      radius = (intensity * magnitude);
      Nodes[x][y].xpos += coef * (distance.x * scale) / 25;
      Nodes[x][y].ypos += coef * (distance.y * scale) / 25;
      Nodes[x][y].xpos = lerp(Nodes[x][y].xpos, Nodes[x][y].anchorx, 0.05);
      Nodes[x][y].ypos = lerp(Nodes[x][y].ypos, Nodes[x][y].anchory, 0.05);
      if (radius > 50)
      {
        radius = 50;
      }
      if (radius < 2)
      {
        radius = 2;
      }
  c = color(170 + magnitude / 2, magnitude * 5, 255, 255);
      fill(c);
      stroke(c);
      if (mode == 0)
      {
        ellipse(Nodes[x][y].xpos + coef * (distance.x * scale), Nodes[x][y].ypos + coef * (distance.y * scale), radius, radius);
      }
      if (mode == 1)
      {
        strokeWeight(radius / 3);
        strokeCap(PROJECT);
        line(Nodes[x][y].xpos + coef * (distance.x * scale), Nodes[x][y].ypos + coef * (distance.y * scale), Nodes[x][y].xpos, Nodes[x][y].ypos);
      }
    }
    
  }


    sum = 0;

  
  for (let i = 0; i < floor.waveform() - 1; i++)
  {
    if (voice)
    {
      line(i * factor, height / 2 + floor.left.get(i) * last_sum + 2, i * factor + 1, height / 2 + floor.left.get(i + 1) * last_sum + 2);
      sum += abs(floor.left.get(i));
    }
    else
    {
      line(i * factor, height / 2 + floor.left.get(i) * last_sum + 2, i * factor + 1, height / 2 + floor.left.get(i + 1) * last_sum + 2);
      sum += abs(floor.left.get(i));
    }
  }
  last_sum = sum;

//----------------------------------------

}
