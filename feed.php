<?php
try 
{
$lastname = substr(htmlspecialchars(trim($_POST['lastname'])), 0, 100);
$name = substr(htmlspecialchars(trim($_POST['name'])), 0, 100);
$email = substr(htmlspecialchars(trim($_POST['email'])), 0, 30);
$text= substr(trim(nl2br($_POST['text'])), 0, 1100);

$message = "Имя: $name\nФамилия: $lastname\nEmail: $email\nТекст: $text\n";
$subj = "Форма обратной связи с сайта lostaspb.ru";
$to = "info@lostaspb.ru"; 
$from="admn@lostaspb.ru";
$headers = "From: $from\nReply-To: $from\n";
if (!mail($to, $subj, $message, $headers)){
	throw new RuntimeException('Ваше сообщение не отправлено.');
    }
	throw new RuntimeException('Ваше сообщение отправлено.');
} 
catch (RuntimeException $e) {
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
                </div>
            </div>
        </div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            setTimeout('location.replace("/index.htm")', 2300);
        </script>

    </body>
</html>