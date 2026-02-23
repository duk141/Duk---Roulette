let history = [];

let count = [0,0,0];

let chart;

let aiPredictText="";


// xác định cột

function getColumn(n){

if(n==0) return null;

if(n%3==1) return 1;

if(n%3==2) return 2;

return 3;

}


// bấm số từ bảng casino

function clickNumber(num){

let col = getColumn(num);

if(col!=null){

count[col-1]++;

history.push({num,col});

}else{

history.push({num,col:"0"});

}

updateUI();

}


// tính %

function percent(c){

let total = count[0]+count[1]+count[2];

if(total==0) return 0;

return ((c/total)*100).toFixed(1);

}


// cập nhật giao diện

function updateUI(){

let p1 = percent(count[0]);

let p2 = percent(count[1]);

let p3 = percent(count[2]);

document.getElementById("p1").innerText = p1+"%";

document.getElementById("p2").innerText = p2+"%";

document.getElementById("p3").innerText = p3+"%";

predict(p1,p2,p3);

aiAnalysis();

updateHistory();

updateChart();

}


// dự đoán

function predict(p1,p2,p3){

let arr=[

{col:1,val:p1},

{col:2,val:p2},

{col:3,val:p3}

];

arr.sort((a,b)=>a.val-b.val);

document.getElementById("predict").innerText=

"Đánh cột "+arr[1].col+

" và "+arr[2].col+

" | Bỏ cột "+arr[0].col;

}


// lịch sử

function updateHistory(){

let h=document.getElementById("history");

h.innerHTML="";

history.slice().reverse().forEach(x=>{

let li=document.createElement("li");

li.innerText="Số "+x.num+" → Cột "+x.col;

h.appendChild(li);

});

}


// biểu đồ

function updateChart(){

if(chart) chart.destroy();

chart=new Chart(

document.getElementById("chart"),

{

type:"bar",

data:{

labels:["Cột 1","Cột 2","Cột 3"],

datasets:[{

label:"Số lần",

data:count

}]

},

options:{

responsive:true

}

}

);

}


// ===== casino grid =====


let redNumbers=[

1,3,5,7,9,12,14,16,18,

19,21,23,25,27,30,32,34,36

];


function createGrid(){

let grid=document.getElementById("grid");

if(!grid) return;

grid.innerHTML="";

for(let i=1;i<=36;i++){

let div=document.createElement("div");

div.innerText=i;

div.classList.add("number");

if(redNumbers.includes(i)){

div.classList.add("red");

}else{

div.classList.add("black");

}

div.onclick=function(){

clickNumber(i);

flash(div);

};

grid.appendChild(div);

}

}


// hiệu ứng sáng

function flash(el){

el.classList.add("active");

setTimeout(()=>{

el.classList.remove("active");

},300);

}

function aiAnalysis(){

if(history.length < 5){

aiPredictText="AI: Chưa đủ dữ liệu";

return;

}


// lấy 6 kết quả gần nhất

let recent = history.slice(-6);

let freq=[0,0,0];

recent.forEach(x=>{

if(x.col!="0"){

freq[x.col-1]++;

}

});


// tìm cột yếu

let min = Math.min(...freq);

let weak = freq.indexOf(min)+1;


// kiểm tra cầu bệt

let last = history[history.length-1].col;

let streak=1;

for(let i=history.length-2;i>=0;i--){

if(history[i].col==last){

streak++;

}else{

break;

}

}


// AI quyết định

if(streak>=3){

aiPredictText=

"AI: Cầu bệt Cột "+last+

" → Nên đánh tiếp";

}else{

aiPredictText=

"AI: Cột "+weak+

" lâu chưa ra → Có thể sắp ra";

}

           }


// chạy khi mở web

window.onload=function(){

createGrid();

updateChart();

}
