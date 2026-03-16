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
