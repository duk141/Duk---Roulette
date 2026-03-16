function detectPattern(){

let s=history.join("")

let p="Unknown"

if(/H{6,}/.test(s)) p="Bệt High"

else if(/L{6,}/.test(s)) p="Bệt Low"

else if(/(HL){5}/.test(s)) p="1-1"

else if(/HHLLHHLL/.test(s)) p="2-2"

else if(/HHHLLL/.test(s)) p="3-3"

else if(/HHHHLL/.test(s)) p="4-2"

else if(/LLHHLL/.test(s)) p="2-1 đảo"

else if(/HLH/.test(s)) p="Zigzag"

else if(/HHHL/.test(s)) p="Gãy High"

else if(/LLLH/.test(s)) p="Gãy Low"

else if(/HHLHHL/.test(s)) p="Cầu bậc"

else if(/HLHLHH/.test(s)) p="Cầu nhảy"

else if(/HHLLLHH/.test(s)) p="Cầu kéo"

else if(/LLHHHLL/.test(s)) p="Cầu gập"

else if(/HLHHHL/.test(s)) p="Cầu đảo dài"

document.getElementById("pattern").innerText=p

}
