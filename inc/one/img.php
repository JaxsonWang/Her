<?php
function get_file($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

//准备收集数据
$url = 'http://wufazhuce.com';//one一个url
$data = get_file($url);
$img = '/(?<=(<img class="fp-one-imagen" src="))[^<]*(?=(" alt="" \/><\/a> ))/';//匹配图片
$num_2 = preg_match_all($img, $data, $match_img);

$imgurl = $match_img[0][0];
//准备接收图片
if ($imgurl) {
    header('Content-Type: image/JPEG');
    @ob_end_clean();
    @readfile($imgurl);
    @flush();
    @ob_flush();
    exit();
} else {
    exit('error');
}
//图片接收完毕
?>
