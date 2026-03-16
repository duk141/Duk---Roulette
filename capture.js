function autoReadGame(){

let nodes=document.querySelectorAll(".result-item")

let arr=[]

nodes.forEach(n=>{

let t=n.innerText.trim()

if(t=="HIGH") arr.push("H")

if(t=="LOW") arr.push("L")

})

if(arr.length>0){

history=arr

update()

}

}
