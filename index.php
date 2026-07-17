<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SOC URL Intelligence Panel</title>
<style>
body{background:#0d1117;color:#c9d1d9;font-family:Consolas;margin:0}
.header{padding:15px 20px;background:#161b22;border-bottom:1px solid #30363d}
.container{padding:20px}
textarea{width:100%;height:120px;background:#0d1117;color:#c9d1d9;border:1px solid #30363d;padding:10px}
button{margin-top:10px;margin-right:10px;padding:10px 20px;background:#238636;border:none;color:#fff;cursor:pointer}
table{width:100%;margin-top:20px;border-collapse:collapse}
th,td{border:1px solid #30363d;padding:10px}
th{background:#161b22}
.malicious{color:#ff4d4d;font-weight:bold}
.suspicious{color:#ffa500;font-weight:bold}
.clean{color:#3fb950;font-weight:bold}
.unknown{color:#58a6ff;font-weight:bold}
</style>
</head>
<body>
<div class="header">SOC URL Intelligence Panel</div>
<div class="container">
<textarea id="urls" placeholder="Enter URLs (one per line)"></textarea><br>
<button onclick="scanURLs()">Run Scan</button>
<button onclick="copyResults()">Copy Results</button>

<table>
<thead><tr><th>Sanitized URL</th><th>VT Score</th><th>VT Verdict</th></tr></thead>
<tbody id="results"></tbody>
</table>
</div>

<script>
async function scanURLs(){
 const urls=document.getElementById("urls").value.trim().split(/\s+/);
 const table=document.getElementById("results");
 table.innerHTML="";
 for(const url of urls){
   const res=await fetch("url_scan.php",{
      method:"POST",
      headers:{"Content-Type":"application/x-www-form-urlencoded"},
      body:"url="+encodeURIComponent(url)
   });
   const data=await res.json();
   table.innerHTML+=`<tr>
   <td>${data.url}</td>
   <td>${data.vt_score}</td>
   <td class="${data.verdict.toLowerCase()}">${data.verdict}</td>
   </tr>`;
   await new Promise(r=>setTimeout(r,16000));
 }
}
function copyResults(){
 let out="";
 document.querySelectorAll("#results tr").forEach(r=>{
   const c=r.querySelectorAll("td");
   if(c.length!==3)return;
   out+=`Sanitized URL : ${c[0].innerText}
VT Score : ${c[1].innerText}
VT Verdict : ${c[2].innerText}
---------------------------
`;
 });
 navigator.clipboard.writeText(out).then(()=>alert("Copied"));
}
</script>

<div style="margin-top:40px;padding:15px;text-align:center;border-top:1px solid #30363d;color:#8b949e">
False positives build character.<br><br>
Dev: <a href="https://github.com/SanjayKotabagi/" target="_blank" style="color:#58a6ff;text-decoration:none;">github.com/SanjayKotabagi</a>
</div>
</body>
</html>
