function markov(){

let m={H:{H:0,L:0},L:{H:0,L:0}}

for(let i=0;i<history.length-1;i++){

let a=history[i]
let b=history[i+1]

m[a][b]++

}

let last=history[history.length-1]

return m[last]

}
