<?php
include_once 'conf.php';
if (isset($_GET['exit'])) $auth->exit_user();	//~ выход пользователя
$authorized = false;
$r='';
$exit='';
if ($auth->check()) {	//~ проверка авторизации
	$authorized = true;		 
	$r.='<div class="col-sm-10">
		Привет '.$_SESSION['login_user'].
		'</div>';	 	 
	$exit = '<a href="?exit">Выход</a>';
	$title='Добро пожаловать '.$_SESSION['login_user'];
}else {
		header("Location: signin.php");
}

$a = $appFormAction->appFormGet();	
if (isset($_GET['delete'])) $appFormAction->appFormDelete($_GET['delete']);	//~ удаление анкеты
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

</head>
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
<main>
<a id="vacancy">
<section class="reviews">
</a>
	<div class="container">	
		<div class="question">
			<?php if ($authorized): ?>
				<div class="row padding-top-40 grid">	
					<?php for($i=0; $i<(count($a)); $i++) {?>				
					<div class="col-xs-6 col-sm-3 col-md-3 reviews-block-admin grid-item">	
					
						<div class="text">			
							<p class="name text-left"><strong><?php echo $a[$i]->getName()?> <?php echo $a[$i]->getLastName()?></strong></p>
							<p class="date text-left"><strong><?php echo $a[$i]->getTel()?></strong></p>
							<p class="date text-left"><strong><a href="mailto:<?php echo $a[$i]->getEmail()?>"><?php echo $a[$i]->getEmail()?></a></strong></p>
							<p class="age text-left"><strong>Возраст: <?php echo $a[$i]->getAge() ?></strong></p>				
							<p class="date text-left">Дата заполнения: <?php echo $a[$i]->getDate()?></p>	
							<p class="date text-left">На последнем м/р, мес.: в платной версии)))</p>				
							<p class="text-left"><strong>Вакансия: </strong><?php echo $a[$i]->getPosition()?></p>
							<p class="text-justify"><strong>Обязанности: </strong><?php echo $a[$i]->getResponsibilities()?></p>
							<p class="text-justify"><strong>Навыки: </strong><?php echo $a[$i]->getSkills()?></p>
						</div>	
						<div class="post_full_like_wrap">	
							<div class="col-sm-3"></div>					
							<div class="col-sm-2"><a id="tooltip" href="?delete=<?php echo $a[$i]->getId()?>" title="Удалить"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></div>
							<div class="col-sm-2"><a id="tooltip" href="?print=<?php echo $a[$i]->getId()?>" title="Распечатать"><i class="fa fa-print fa-2x" aria-hidden="true"></i></a></div>
							<div class="col-sm-2"></div>
							<div class="col-sm-3"></div>					
						</div>					
					</div>
				<?php }?>					
				</div>
			<? endif; ?>					
			</div>				
	</div>	
</section> 
</main>
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
	<script src="../../libs/masonry/masonry.pkgd.min.js"></script>
	<script src="../../js/myscripts.js" type="text/javascript"></script>
	<script>
	$(function() {
	  // инициализировать элемент, имеющий идентификатор tooltip, как компонент tooltip
	  $('#tooltip').tooltip();
	});

	$('.grid').masonry({
	  // options
	  itemSelector: '.grid-item'//,
	  /* columnWidth: 350 */
	});
	</script>
</body>
</html>