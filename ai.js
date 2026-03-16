function markov(){

let m={H:{H:0,L:0},L:{H:0,L:0}}

for(let i=0;i<history.length-1;i++){

let a=history[i]
let b=history[i+1]

m[a][b]++

}

return m[history[history.length-1]]

}

function aiPredict(){

let m=markov()

let result

if(m.H>m.L)

result="HIGH"

else

result="LOW"

document.getElementById("predict").innerText=

"AI Prediction: "+result

}
