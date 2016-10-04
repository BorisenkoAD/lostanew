<?php
include "dbLib.php";
$res = $connection->prepare("INSERT INTO anketa 
												(position,
												schedule,
												date_get_start,
												salary_desired,
												Name,
												LastName,
												DLastName,
												Email,
												Tel,
												citizenship,
												place_liv,
												birthday,
												age,
												Company_name,
												post,
												start_job,
												end_job,
												responsibilities,
												skills,
												Institute,
												speciality,
												diplom,
												Grad_year)
										VALUES	
												(:position,
												:schedule,
												:date_get_start,
												:salary_desired,
												:Name,
												:LastName,
												:DLastName,
												:Email,
												:Tel,
												:citizenship,
												:place_liv,
												:birthday,
												(SELECT TIMESTAMPDIFF(YEAR, :birthday, CURDATE())),
												:Company_name,
												:post,
												:start_job,
												:end_job,
												:responsibilities,
												:skills,
												:Institute,
												:speciality,
												:diplom,
												:Grad_year)"
							);
	$res->bindParam(':position', $position);
	$res->bindParam(':schedule', $schedule);
	$res->bindParam(':date_get_start', $date_get_start);
	$res->bindParam(':salary_desired', $salary_desired);
	$res->bindParam(':Name', $Name);
	$res->bindParam(':LastName', $LastName);
	$res->bindParam(':DLastName', $DLastName);
	$res->bindParam(':Email', $Email);
	$res->bindParam(':Tel', $Tel);
	$res->bindParam(':citizenship', $citizenship);
	$res->bindParam(':place_liv', $place_liv);
	$res->bindParam(':birthday', $birthday);
	$res->bindParam(':Company_name', $Company_name);
	$res->bindParam(':post', $post);
	$res->bindParam(':start_job', $start_job);
	$res->bindParam(':end_job', $end_job);
	$res->bindParam(':responsibilities', $responsibilities);
	$res->bindParam(':skills', $skills);	
	$res->bindParam(':Institute', $Institute);
	$res->bindParam(':speciality', $speciality);
	$res->bindParam(':diplom', $diplom);
	$res->bindParam(':Grad_year', $Grad_year);
	
try 
{
$position = substr(htmlspecialchars(trim($_POST['position'])), 0, 100);
$schedule= substr(htmlspecialchars(trim($_POST['schedule'])), 0, 50);
$date_get_start= substr(htmlspecialchars(trim($_POST['date_get_start'])), 0, 50);
$salary_desired= substr(htmlspecialchars(trim($_POST['salary_desired'])), 0, 50);
$Name= substr(htmlspecialchars(trim($_POST['Name'])), 0, 50);
$LastName= substr(htmlspecialchars(trim($_POST['LastName'])), 0, 50);
$DLastName= substr(htmlspecialchars(trim($_POST['DLastName'])), 0, 50);
$Email= substr(htmlspecialchars(trim($_POST['Email'])), 0, 50);
$Tel= substr(htmlspecialchars(trim($_POST['Tel'])), 0, 50);
$citizenship= substr(htmlspecialchars(trim($_POST['citizenship'])), 0, 50);
$place_liv= substr(htmlspecialchars(trim($_POST['place_liv'])), 0, 50);
$birthday= substr(htmlspecialchars(trim($_POST['birthday'])), 0, 50);
$Company_name= substr(htmlspecialchars(trim($_POST['Company_name'])), 0, 50);
$post= substr(htmlspecialchars(trim($_POST['post'])), 0, 50);
$start_job= substr(htmlspecialchars(trim($_POST['start_job'])), 0, 50);
$end_job= substr(htmlspecialchars(trim($_POST['end_job'])), 0, 50);
$responsibilities= substr(htmlspecialchars(trim($_POST['responsibilities'])), 0, 1500);
$skills= substr(htmlspecialchars(trim($_POST['skills'])), 0, 1500);
$Institute= substr(htmlspecialchars(trim($_POST['Institute'])), 0, 400);
$speciality= substr(htmlspecialchars(trim($_POST['speciality'])), 0, 400);
$diplom= substr(htmlspecialchars(trim($_POST['diplom'])), 0, 50);
$Grad_year= substr(htmlspecialchars(trim($_POST['Grad_year'])), 0, 50);

$res->execute();


$mess = "Должность: $position\nИмя: $Name Фамилия: $LastName Отчество: $DLastName\nдля связи: $Email $Tel\nЖелаемый график: $schedule Дата начала: $date_get_start ЗП: $salary_desired\nГражданство: $citizenship Место жительства: $place_liv День рождения: $birthday\nПрошлая работа:\nОрганизация: $Company_name Должность: $post $start_job - $end_job\nОбязанности: $responsibilities\nНавыки: $skills\nУчебное заведение:\n$Institute\n$speciality $diplom\n$Grad_year";
// $mess = "$lastname $firstname\n$email\n$tel\n $textarea";
$subj = "Анкета с сайта lostaspb.ru";
$to = "info@lostaspb.ru"; 
$from="admin@lostaspb.ru";
$headers = "From: $from\nReply-To: $from\n";
if (!mail($to, $subj, $mess, $headers)){
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
          setTimeout('location.replace("/vacancy.htm")', 3000);
        </script>

    </body>
</html>