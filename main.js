let history=[]

function add(v){

history.push(v)

update()

}

function skip(){

history.push("S")

update()

}

function reset(){

history=[]

update()

}

function paste(){

navigator.clipboard.readText().then(t=>{

t=t.replace(/[^HL]/g,'')

history=t.split("")

update()

})

}

function update(){

showHistory()

detectPattern()

aiPredict()

trend()

bigRoad()

smallRoad()

heatmap()

chartUpdate()

}

function showHistory(){

let html=""

history.forEach(v=>{

if(v=="H")
html+="<span style='color:green'>H </span>"

else if(v=="L")
html+="<span style='color:blue'>L </span>"

else
html+="<span style='color:gray'>S </span>"

})

document.getElementById("history").innerHTML=html

}

function update(){

showHistory()

}
