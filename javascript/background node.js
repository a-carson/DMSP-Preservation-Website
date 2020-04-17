let linesX = 40;
let linesY = 26;
//--------------------------------------------------------------------
let autopilot = false
//--------------------------------------------------------------------
let coef = 1;
let mode = 0;
let node_scale = 0.1;
//--------------------------------------------------------------------
let stepsX, stepsY, radius, intensity, movement, last_sum, factor, wave, sum;
//--------------------------------------------------------------------
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
//--------------------------------------------------------------------
Nodes = []
//--------------------------------------------------------------------
function setup()
{
  createCanvas(800, 600);
  //------------------------------------------------------------------
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
  //------------------------------------------------------------------
}
//--------------------------------------------------------------------
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
}