<?php    
    header("Content-type: text/html; charset=utf-8");
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = 'temp/';
    include "phpqrcode.php";
   
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);

    //(L,M,Q,H)容错等级，如果要在二维中间加logo图标，容错等级设置Q或者H
    $errorCorrectionLevel = 'Q'; 
    $matrixPointSize = 6;  //二维码像素点大小
    $margin = 4;  //二维图像的外边距
    $filename = $PNG_TEMP_DIR.'test.png'; //二维码图片的文件路劲和文件名
    $data = "QR code creator"; //需要生成二维码的数据
    $bgColor = "#ffffff"; //二维码的背景色
    $color = '#8a2707'; //二维码的像素颜色

    //制作二维码
    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 
    $margin, false, '#ffffff','#8a2707');    
     
    $logo = $PNG_WEB_DIR.'logo.jpg';//准备好的logo图片   
    //$QR = $PNG_WEB_DIR.basename($filename);//已经生成的原始二维码图   
    $dst = $PNG_WEB_DIR."testLogo.png"; //带logo图标二维码生成的文件名路径
    //制作带logo的二维码
    QrLogo::addLogo($filename, $logo, $dst);
    
    echo '<img src='.$dst.' />'; 
    //display generated file
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
    
    // benchmark
    QRtools::timeBenchmark();    

    