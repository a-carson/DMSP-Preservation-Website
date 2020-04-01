import ddf.minim.*;

Minim minim=new Minim(this);;
AudioInput in;

boolean lerping = true;

int linesX = 40; 
int linesY = 26; 

boolean repel = true;
boolean autopilot = false;
boolean controls = true;
boolean voice = false;

int coef = 1;
int mode = 0;
float magnitude = 0;
float maxMagnitude = 848.5281374;

color c;
PVector distance;
PFont sourcecode;
float stepsX, stepsY, radius, intensity, movement, last_sum, scale, factor, wave, sum;

class Node {
  float xpos, ypos, speed, anchorx, anchory;
  Node (float x, float y, float s) {
    anchorx = x;
    anchory = y;
    ypos = y;
    xpos = x;
    speed = s;
  }
}

Node[][] Nodes = new Node[linesX][linesY]; 


int index=0;
void input(){
  minim.stop();
 
  in = minim.getLineIn(Minim.MONO, 1024);
  
  textAlign(LEFT);
  sourcecode = createFont("D:\\Ftp/ebrima.ttf", 100);
  
}
void setup() {

  fullScreen();
  noSmooth();
  colorMode(HSB, 255);
  stepsX = (width) / linesX;
  stepsY = (height) / linesY;
  for (int i = 0; i < linesX; i++) {
    for (int j = 0; j < linesY; j++) {
      Nodes[i][j] = new Node((i+0.5)*stepsX, (j+0.5)*stepsY, 2);
    }
  minim=new Minim(this);
  in = minim.getLineIn(Minim.MONO);  
  }
  input();
}

void keyPressed() {
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
    saveFrame("wavepttrn-####.jpg");
    break;
  case 'h':
    controls = !controls;
    break;
  case 'n':
    index++;
    index=0;
    }
    
    input();
 
    voice = !voice;
    if (!voice) {
  
    } 
    //break;
  }
//}

void draw() {
  background(frameCount%255, 255, 30);
  stroke(0);
  int r=120;
  int g=120;
  int b=120;
  int step = in.bufferSize() / 100;
  float a = 0;
  float angle = (2*PI) /100;
  
  for(int i = 0; i < in.bufferSize() -step; i+=step)
  {
    float x1 = width/2 + cos(a) * (1000 * in.mix.get(i) + 200);
    float y1 = height/2 + sin(a) * (1000 * in.mix.get(i) + 200);
    float x2 = width/2 + cos(a + angle) * (1000 * in.mix.get(i+step) + 200);
    float y2 = height/2 + sin(a + angle) * (1000 * in.mix.get(i+step) + 200);
    fill(r,g,b);
    stroke(34, 225, 273);
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
  for (int i = 0; i < in.bufferSize() - 1; i++)
  {
    if (voice) {
    line(i*factor, height/2 + in.left.get(i)*last_sum + 2, i*factor+1, height/2 + in.left.get(i+1)*last_sum + 2);
    sum += abs(in.left.get(i));
    } else {
   line(i*factor, height/2 + in.left.get(i)*last_sum + 2, i*factor+1, height/2 + in.left.get(i+1)*last_sum + 2);
   sum += abs(in.left.get(i));
    }
  }
  last_sum = sum;
  if (controls) {
    fill(255, 0, 255);
    textSize(18);
  }
}
