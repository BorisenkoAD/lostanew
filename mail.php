<?php
	$uploaddir = '/var/www/vhosts/22/137870/webspace/httpdocs/lostaspb.ru/tmp/';
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
	$mes = " ";

try {
    
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['userfile']['error']) ||
        is_array($_FILES['userfile']['error'])
    ) {
        throw new RuntimeException('Неверные параметры. повторите операцию.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['userfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('Файл не отправлен.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Превышен размер файла.');
        default:
            throw new RuntimeException('Неизвестная ошибка.');
    }

    // You should also check filesize here. 
    if ($_FILES['userfile']['size'] > 1900000) {
        throw new RuntimeException('Превышен размер файла.');
    }

    // DO NOT TRUST $_FILES['userfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['userfile']['tmp_name']),
        array(
			'pdf' => 'application/pdf',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
			'doc' => 'application/msword',
			'docx'=> 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
		),
        true
    )) {
        throw new RuntimeException('Неверный формат.');	
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['userfile']['tmp_name'],$uploadfile
  /*      sprintf('/var/www/vhosts/22/137870/webspace/httpdocs/istria-spb.ru/istria2/tmp/%s.%s', sha1_file($_FILES['userfile']['tmp_name']), $ext)*/
    )) {
        throw new RuntimeException('Перемещение файла невозможно.');
    }
        throw new RuntimeException('Ваше сообщение успешно отправлено.');

 } catch (RuntimeException $e) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title></title>
	<link href="css/normalize.css" rel="stylesheet"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic' rel='stylesheet' type='text/css'/>	
    <link href="css/style.css" rel="stylesheet"/>	
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">			
					<h2 class="text-center"><strong><?echo $e->getMessage();}?></strong></h2>
<?
//---------------------------------
$filename = $uploadfile; // $_FILES['userfile']['name']; //Имя файла для прикрепления $uploadfile;
$to = "info@lostaspb.ru"; 
$from="admin@lostaspb.ru";
$subject = "Прикрепленное резюме с сайта";
$message = $_POST['message'];
$subj = "=?utf-8?B?".base64_encode($subject)."?=";
$boundary = uniqid('np');
$nl = "\n";
$file = fopen($filename, "r");
$blob = fread($file, filesize($filename));
fclose($file);

$headers = "MIME-Version: 1.0" . $nl;
$headers .= "From: " . $from . $nl . "Reply-To: " . $from . $nl;
$headers .= "Content-Type: multipart/mixed;boundary=" . $boundary . $nl;

$msg = "This is a MIME encoded message."; 
$msg .= $nl . $nl . "--" . $boundary . $nl;
$msg .= "Content-type: text/html;charset=utf-8" . $nl . $nl;
$msg .= $message;
$msg .= $nl . $nl . "--" . $boundary . $nl;
$msg .= "Content-Type: application/octet-stream" . $nl;
$msg .= "Content-Transfer-Encoding: base64" . $nl;
$msg .= "Content-Disposition: attachment; " .
 "filename=\"=?utf-8?B?".base64_encode($filename)."?=\"" . $nl . $nl;
$msg .= chunk_split(base64_encode($blob)) . $nl;
$msg .= $nl . $nl . "--" . $boundary . "--";

mail($to, $subj, $msg, $headers);
//---------------------------------	
	// теперь этот файл нужно переименовать желательно в дату_время отправки
	// потом его отправить по почте админу и удалить его.
?>								
                </div>
            </div>
        </div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
/*             setTimeout('location.replace("/vacancy.html")', 3000);
 */        </script>

    </body>
</html>