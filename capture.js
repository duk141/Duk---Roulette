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

setInterval(autoReadGame,3000)

async function scan(){

let file=document.getElementById("img").files[0]

if(!file) return

const worker=Tesseract.createWorker()

await worker.load()

await worker.loadLanguage("eng")

await worker.initialize("eng")

const {data:{text}}=
await worker.recognize(file)

let arr=text
.replace(/[^HL]/g,"")
.split("")

history=arr

update()

await worker.terminate()

}
