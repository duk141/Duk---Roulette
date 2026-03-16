function heatmap(){

let map={}

history.forEach((v,i)=>{

if(!map[v]) map[v]=0

map[v]++

})

let html=""

for(let k in map){

html+=k+" : "+map[k]+"<br>"

}

document.getElementById("heatmap").innerHTML=html

}
