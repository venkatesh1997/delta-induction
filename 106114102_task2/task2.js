	var num=[];//to store the numbers entered by the user
	
	var x=0.0;//x & Y coordinates of the top leftmost of the rectangle
	var y=0.0;
	var dx=30.0;//width of each bar
	var dy=0.5;//hieght of one single unit of bar
	

	function a(){//function to draw the x and y axis
		var c = document.getElementById("myCanvas");
		var ctx = c.getContext("2d");

		ctx.beginPath();              
		ctx.lineWidth = "1";
		ctx.strokeStyle = "green";  
		ctx.moveTo(20.0, 40.0);
		ctx.lineTo(20.0, 940.0);
		ctx.stroke();  

		ctx.beginPath();
		ctx.strokeStyle = "purple";  
		ctx.moveTo(20.0,940.0);
		ctx.lineTo(1920.0, 940.0);            
		ctx.stroke();  // Draw it
	}


	function sortt(){//function to sort the array(Hacker mode)
		num.sort(function(a,b){return a-b;});
	}


	function grap(){//to print each bar of unsorted array
		var c = document.getElementById("myCanvas");
		var ctx = c.getContext("2d");

		var big= Math.max.apply(Math, num);
		if(big>1780.0||dx*(num.length-1.0)+dx*(num.length)/2.0>1850.0){
			if(big>1780.0)//checks if the hieght(dy) has to be scaled down
			dy=890.0/big;
			if(dx*(num.length-1.0)+dx*(num.length)/2.0>1850.0)//checks if width of each bar has to be scaled down
			dx=1850.0/(1.5*num.length-1);
			ctx.clearRect(0,0,2000,1000);	

			a();		
			for(var i=0;i<num.length;i++){//redraw the whole graph
				x=dx*i+dx*(i+1)/2+20.0;
				y=940.0-(dy*num[i]);	
				ctx.fillStyle = "blue";
				ctx.fillRect(x, y, dx, dy*num[i]);
				ctx.font="20px Georgia";
				ctx.fillStyle="black";
				ctx.fillText(num[i],x,y-1);
	
			}
		}
		else{//just draw the next bar if nothing has to scaled down
			x=dx*(num.length-1.0)+dx*(num.length)/2.0+20.0;
			y=940.0-(dy*num[num.length-1]);	
			ctx.fillStyle = "blue";
			ctx.fillRect(x, y, dx, dy*num[num.length-1]);
			ctx.font="20px Georgia";
			ctx.fillStyle="black";
			ctx.fillText(num[num.length-1],x,y-1);
		}
	}


	function getno(){//to get the number entered by the user
		var n=prompt("enter a number:","0");
		num.push(n);
		
		grap();
	}


	function sortgrap(){//to print the sorted array on the graph
		sortt();
		var c = document.getElementById("myCanvas");
		var ctx = c.getContext("2d");
	
		ctx.clearRect(0,0,2000,1000);	
		a();
	
		for(var i=0;i<num.length;i++){
		x=dx*i+dx*(i+1)/2.0+20.0;
		y=940.0-(dy*num[i]);	
		ctx.fillStyle = "blue";
		ctx.fillRect(x, y, dx, dy*num[i]);
		ctx.font="20px Georgia";
		ctx.fillStyle="black";
		ctx.fillText(num[i],x,y-1);
	}
	}