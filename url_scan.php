<?php
header('Content-Type: application/json');

$VT_API_KEY="c0e98bb5e478ab006c5fdd2f2885716ba42a7bc702c562d3e52045d366555f8b";

$url=$_POST['url'] ?? '';

function sanitizeURL($url){
    $url=trim($url);
    $normalized=$url;
    if(!preg_match("/^https?:\/\//",$normalized)){
        $normalized="http://".$normalized;
    }
    $defanged=$url;
    $defanged=str_replace("https://","hxxps://",$defanged);
    $defanged=str_replace("http://","hxxp://",$defanged);
    $defanged=str_replace(".","[.]",$defanged);
    return [$normalized,$defanged];
}

function checkVirusTotalURL($url,$apiKey){
    $url_id=rtrim(strtr(base64_encode($url),'+/','-_'),'=');
    $lookup="https://www.virustotal.com/api/v3/urls/".$url_id;

    $opts=["http"=>[
        "method"=>"GET",
        "header"=>"x-apikey: ".$apiKey
    ]];

    $res=@file_get_contents($lookup,false,stream_context_create($opts));

    if($res===false){
        return ["No Data","Unknown"];
    }

    $data=json_decode($res,true);

    if(!isset($data["data"]["attributes"]["last_analysis_stats"])){
        return ["No Data","Unknown"];
    }

    $stats=$data["data"]["attributes"]["last_analysis_stats"];

    $m=$stats["malicious"]??0;
    $s=$stats["suspicious"]??0;
    $h=$stats["harmless"]??0;

    $score="M:$m S:$s H:$h";

    if($m>5) $verdict="Malicious";
    elseif($m>0 || $s>0) $verdict="Suspicious";
    else $verdict="Clean";

    return [$score,$verdict];
}

list($normalized,$defanged)=sanitizeURL($url);
list($score,$verdict)=checkVirusTotalURL($normalized,$VT_API_KEY);

echo json_encode([
    "url"=>$defanged,
    "vt_score"=>$score,
    "verdict"=>$verdict
]);
