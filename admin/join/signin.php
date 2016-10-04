<?php
include_once "conf.php";
$r='';
$exit='';

//~ authorization
if (isset($_POST['send'])) {
	if (!$auth->authorization()) {
		$error = $auth->error_reporting();
	}
}

if (isset($_GET['exit'])) $auth->exit_user();

//~ Check auth
 if ($auth->check()) {
	header("Location: index.php");
	//$r.='<div class="col-sm-10">Привет '.$_SESSION['login_user'].'</div>';$exit = '<a href="?exit">Выход</a>';$title='Добро пожаловать!';
} else {
	if (isset($error)) 
	$r.='<div class="row col-sm-12" style="color: red;">'.$error.'</div>';
	$r.='<div class="col-sm-10">
		<form class="form-horizontal" action="" method="post">
			<div class="form-group">
				<label for="login" class="col-xs-4 control-label">Login:</label>
				<div class="col-xs-4">
					<input type="text" class="form-control semi-transparent-button" required name="login" value="'.@$_POST['login'].'" />
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-xs-4 control-label">Password:</label>
				<div class="col-xs-4">
					<input type="password" class="form-control semi-transparent-button" required name="passwd" placeholder="Введите пароль" />
				</div>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember" value="on"> Запомнить
				</label>
			</div>
		<button type="submit" class="btn btn-primary" value="send" name="send">Войти</button>					
		</form>
		</div>';
	$title='Вход пользователя';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?print $title;?></title>

	<link href="../../css/normalize.css" rel="stylesheet" type="text/css" />
	<link href="../../fonts/MyriadPro/css/MyriadPro.css" rel="stylesheet" type="text/css" />
	<link href="../../fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../../css/bootstrap.min.css" rel="stylesheet">	
	<link href="../../css/style.css" rel="stylesheet" type="text/css" />		
	<link href="../../css/navbar.css" rel="stylesheet" type="text/css" />		

<body data-spy="scroll" data-target="#navbar-example">
<header>
	<div class="navbar-example">
		<nav class="navbar navbar-inverse navbar-fixed-top">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="/">
			  <img alt="Brand" src="http://dev.lostaspb.ru/img/logo_small.png">
			  </a> 
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			  <ul class="nav navbar-nav  navbar-right">
				<!-- тут нужно проверить пользователя - если он из отдела персонала, то вывести новое меню:
				Все вакансии/Добавить вакансию/Выход-->		  
				<li><a href="../">О Компании</a></li>
				<li><a href="../index.htm#our_project">Проекты</a></li>
				<li><a href="../index.htm#optimization">Команда</a></li>
				<li><a href="../events.htm">Мероприятия</a></li>
				<li><a href="../vacancy.htm">Вакансии</a></li>
				<li><a href="../index.htm#reviews">Отзывы</a></li>
				<li><a href="../index.htm#contact">Контакты</a></li>
				<li><?print $exit;?></li>
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav> 
	</div>	
	<div class="splash-third">
		<div class="container">
			<div class="row padding-top-70 padding-bottom-70">
				<div class="col-sm-1"></div>
				<?print $r;?>			
				<div class="col-sm-1"></div>				
			</div>					
		</div>
	</div>
</header>
<footer>
<div class="container">
	<nav class="bot_mnu">		
			<ul class="nav navbar-nav">
			    <li class="col-sm-2"><span>О компании</span>
					<ul>
						<li><a href="\#about">История</a></li>
						<li><a href="\#about">Сферы деятельности</a></li>
						<li><a href="\#about">Наши принципы</a></li>
					</ul>
			    </li>
			    <li class="col-sm-2"><span>Проекты</span>
					<ul>
						<li><a href="\#our_project">Наши проекты</a></li>
						<li><a href="\#our_project">Управление проектами</a></li>
					</ul>
			    </li>
			    <li class="col-sm-2"><span>Команда</span>
					<ul>
						<li><a href="\#optimization">Наша стратегия</a></li>
						<li><a href="\#optimization">Оптимизация процессов</a></li>
						<li><a href="\#optimization">Наши возможности</a></li>					
					</ul>
			    </li>
			    <li class="col-sm-2"><span>О нас</span>
					<ul>
						<li><a href="events.htm">Мероприятия</a></li>
						<li><a href="\#our_partners">Партнеры</a></li>
						<li><a href="\#reviews">Отзывы</a></li>
						<li><a href="\#reviews">Оставить отзыв</a></li>						
					</ul>
			    </li>	
			    <li class="col-sm-2"><span>Вакансии</span>
					<ul>
						<li><a href="vacancy.htm">Список вакансий</a></li>				
					</ul>
				</li>				
			</ul>
	</nav>
</div>	
</footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/myscripts.js" type="text/javascript"></script>
</body>
</html>