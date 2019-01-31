<?php
error_reporting(E_ERROR);
  $client_id = "G777mZaKHQjWtIJvNrzX";
  $client_secret = "HtchWwdoKB";
  $encText = urlencode($_POST['query']);
  
  $url = "https://openapi.naver.com/v1/search/book.json?query=".$encText; // json 결과
//  $url = "https://openapi.naver.com/v1/search/book.xml?query=".$encText; // xml 결과

  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //echo "status_code:".$status_code."";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
    echo "Error 내용:".$encText;
  }
?>