//네이버 검색 API예제는 블로그를 비롯 전문자료까지 호출방법이 동일하므로 blog검색만 대표로 예제를 올렸습니다.
// ssl 이슈가 있으면 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 를 추가해보시길 바랍니다.
<?php
  $client_id = "G777mZaKHQjWtIJvNrzX";
  $client_secret = "HtchWwdoKB";
  $encText = urlencode("네이버오픈API");
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
  echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?>