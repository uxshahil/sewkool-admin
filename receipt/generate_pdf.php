<?php
$file = "pdf/" . $_POST["filename"];

if (file_exists($file)) {

    header('Content-type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Transfer-Encoding: binary');
    readfile($file);

}else{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode(array("source" => $_POST["url"], "landscape" => false, "use_print" => false, "sandbox" => true, "css" => "https://dev.themidastouch.co.za/sewkool-admin/libs/css/print-pdf.css")),
        CURLOPT_HTTPHEADER => array('Content-Type:application/json'),
        CURLOPT_USERPWD => '4e49c96236e44d1e847da3e4c7aad2f7:'
    ));

    $response = curl_exec($curl);
    file_put_contents($file, $response);

    header('Content-type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Transfer-Encoding: binary');
    readfile($file);

}
?>