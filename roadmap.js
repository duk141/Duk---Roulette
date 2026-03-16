function bigRoad(){

let html=""

history.forEach(x=>{

if(x=="H")

html+='<div class="cell h"></div>'

else if(x=="L")

html+='<div class="cell l"></div>'

})

document.getElementById("bigroad").innerHTML=html

}
