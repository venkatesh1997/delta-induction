function getcolor()
{
var num=Math.floor(Math.random()*900000) + 100000;
return '#'+num;
}

function functionI(ID) {
document.getElementById(ID).style.backgroundColor=getcolor();
}