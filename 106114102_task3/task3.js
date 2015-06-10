var canvas = document.getElementById('myCanvas');
var ctx = canvas.getContext('2d');
var dx = 10;
var dy = 10;
var x = 900;
var y = 400;
var WIDTH = 1800;
var HEIGHT = 800;
var r = 15;
function movecentre(){/* just a function to move the circle to the centre for making the webpage look neat */
	localStorage.setItem("X","900");
	localStorage.setItem("Y","400");
	draw();
}
function keysense(evt){
	var e1=localStorage.getItem("X");
	var e2=localStorage.getItem("Y");
	x=parseInt(e1,"10");
	y=parseInt(e2,"10");
	switch (evt.keyCode) {
		
		case 38:  /* Up arrow was pressed */
		if (y-dy-r>0){
		y-=dy;
		}
		break;
		
		case 40:  /* Down arrow was pressed */
		if (y+dy+r<HEIGHT){
		y+=dy;
		}
		break;
		
		case 37:  /* Left arrow was pressed */
		if (x-dx-r>0){
		x-=dx;
		}
		break;
		
		case 39:  /* Right arrow was pressed */
		if (x+dx+r<WIDTH){
		x+=dx;
		}
		break;
		}

	//push the centre of circle to local storage
	localStorage.setItem("X",x);
	localStorage.setItem("Y",y);
	draw();

}

function draw(){
//get the coordinates of circle from local script
if(localStorage.getItem("X")==null||localStorage.getItem("Y")==null){
x=900;
y=400;
}
else{
var e1=localStorage.getItem("X");
var e2=localStorage.getItem("Y");
x=parseInt(e1,"10");
y=parseInt(e2,"10");
}
//draw the circle

ctx.clearRect(0, 0, WIDTH, HEIGHT);
ctx.fillStyle = "purple";
ctx.beginPath();
ctx.arc(x,y,r, 0, Math.PI*2, true);
ctx.fill();
}

//to trigger the keysense function when the arrow keys are pressed
window.addEventListener('keydown',keysense,true);