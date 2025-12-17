<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json; charset=utf-8");

$path = $_GET['path'] ?? '';
$path = trim($path);

// allowlist supaya aman
if (!preg_match('#^(provinces\.json|regencies/\d+\.json|districts/\d+\.json)$#', $path)) {
  http_response_code(400);
  echo json_encode(["error" => "invalid path"]);
  exit;
}

$url = "https://emsifa.github.io/api-wilayah-indonesia/api/" . $path;

// cURL (paling stabil di XAMPP)
$ch = curl_init($url);
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,

  CURLOPT_CONNECTTIMEOUT => 10,
  CURLOPT_TIMEOUT => 60,

  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_SSL_VERIFYHOST => 0,

  CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,  // << penting!
  CURLOPT_USERAGENT => "Mozilla/5.0",
]);

$out  = curl_exec($ch);
$err  = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($out === false || $code >= 400) {
  http_response_code(502);
  echo json_encode(["error" => "fetch failed", "detail" => $err ?: "HTTP $code"]);
  exit;
}

echo $out;
