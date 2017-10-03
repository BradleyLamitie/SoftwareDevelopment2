var nachos = 1;
var restarts = 0;
var x=1;
var y=1;
var z=1;
var amanda = 0;
var sarah = 0;
var nachosLeft= nachos;
while(nachos<500){

nachosLeft=nachosLeft-x;

//document.writeln("x= "+  x);
//document.writeln("y= " + y);
//document.writeln("z= " + z);
//document.writeln("nachosLeft= " + nachosLeft);
//document.write("<br>");
if(nachosLeft==0){
	document.writeln(" nachos:" + nachos+ "  restarts:" + restarts);
	nachos =nachos+1;
	var nachosLeft= nachos;
	document.write("<br>");
	if(restarts>amanda){
		amanda = restarts;
		sarah = nachos;
	}
}else if(x>nachosLeft){
	nachos = nachos +1;
	x=1;
	y=1;
	z=1;
	restarts=restarts +1;

}else if( x<nachosLeft){
	x=y;
	y=z;
	z= x+y;
	nachosLeft=nachos;

}


}
	document.writeln(" nachos:" + sarah + "  restarts:" + amanda);
