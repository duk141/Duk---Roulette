let history=[];

let count=[0,0,0];

let chart;

function getColumn(n){

if(n==0) return null;

if(n%3==1) return 1;

if(n%3==2) return 2;

return 3;

}


function addNumber(){

let num = parseInt(document.getElementById("numberInput").value);

if(num<0 || num>36){

alert("Sai số");

return;

}


let col = getColumn(num);

if(col!=null){

count[col-1]++;

history.push({num,col});

}


updateUI();

}


function percent(c){

let total = history.length;

if(total==0) return 0;

return ((c/total)*100).toFixed(1);

}


function updateUI(){

let p1=percent(count[0]);

let p2=percent(count[1]);

let p3=percent(count[2]);

document.getElementById("p1").innerText=p1+"%";

document.getElementById("p2").innerText=p2+"%";

document.getElementById("p3").innerText=p3+"%";


predict(p1,p2,p3);

updateHistory();

updateChart();

}


function predict(p1,p2,p3){

let arr=[

{col:1,val:p1},

{col:2,val:p2},

{col:3,val:p3}

];

arr.sort((a,b)=>a.val-b.val);

document.getElementById("predict").innerText=

"Đánh cột "+arr[1].col+" và "+arr[2].col+

" | Bỏ cột "+arr[0].col;

}


function updateHistory(){

let h=document.getElementById("history");

h.innerHTML="";

history.forEach(x=>{

let li=document.createElement("li");

li.innerText=

"Số "+x.num+" → Cột "+x.col;

h.appendChild(li);

});

}


function updateChart(){

if(chart) chart.destroy();

chart=new Chart(

document.getElementById("chart"),

{

type:"bar",

data:{

labels:["Cột 1","Cột 2","Cột 3"],

datasets:[{

data:count

}]

}

}

);

  }
