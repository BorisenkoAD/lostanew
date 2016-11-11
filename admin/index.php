<?php
include "dbLib.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Отзывы</title>

	<link href="../css/normalize.css" rel="stylesheet" type="text/css" />
	<link href="http://allfont.ru/allfont.css?fonts=open-sans" rel="stylesheet" type="text/css" />
	<link href="http://allfont.ru/allfont.css?fonts=open-sans-bold" rel="stylesheet" type="text/css" />
	<link href="../fonts/MyriadPro/css/MyriadPro.css" rel="stylesheet" type="text/css" />
	<link href="../fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">	
	<link href="../css/style.css" rel="stylesheet" type="text/css" />		
	<link href="../css/navbar.css" rel="stylesheet" type="text/css" />	

 	<!-- <link href="css/ui.totop.css" rel="stylesheet" media="screen,projection" />		 -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
		  <img alt="Brand" src="../img/logo_small.png">
		  </a> 
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav  navbar-right">
			<li><a href="../">О Компании</a></li>
			<li><a href="../index.htm#our_project">Проекты</a></li>
			<li><a href="../index.htm#optimization">Команда</a></li>
			<li><a href="../events.htm">Мероприятия</a></li>
			<li><a href="../vacancy.htm">Вакансии</a></li>
			<li><a href="../index.htm#reviews">Отзывы</a></li>
			<li><a href="../index.htm#contact">Контакты</a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav> 
</div>	
	<div class="splash-second">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-6">
					 <img alt="ЛОСТА" src="../img/logo_header.png" style="padding-top: 40px;">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-6" style="padding-top: 94px;"></div>
			</div>
			<div class="row padding-top-100 padding-bottom-40">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				<blockquote class="pull-right text-left">
					<p>
					<h2>“Откуда мне знать?! Я этих русских раньше только в кино видел!”</h2>
					</p>
					<cite style="color:#fff;">Мастер-сержант Мэтт Купер</cite>
				</blockquote>
			</div>
			<div class="col-xs-1"></div>			
			</div>						
		</div>
	</div>
</header>
<main>
<a id="reviews">
<section class="reviews">
</a>
	<div class="container-fluid">	
		<div class="check-reviews"><h2>Отзывы на модерацию</h2>		
 		<div class="row padding-top-40 grid">		
		<?php $stmt = $connection->query('SELECT * FROM reviews WHERE status = 0 AND deleted = 0 order by id desc');
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{?>
			<div class="col-xs-6 col-sm-4 col-md-3 reviews-block-admin grid-item">
				<div class="text">			
				<p class="name text-left"><strong><?php echo $row["firstname"] ?></strong></p><p class="date text-left"><?php echo $row["date"] ?></p>		
				<p class="text-justify"><?php echo $row["message"] ?></p>
				</div>	
				<div class="post_full_like_wrap">	
					<div class="col-sm-3"></div>					
					<div class="col-sm-2"><a id="tooltip" href="delete.php?id=<?php echo $row["id"]?>" title="Удалить"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></div>
					<div class="col-sm-2"></div>
					<div class="col-sm-2"><a id="tooltip" href="post.php?id=<?php echo $row["id"]?>" title="Опубликовать на сайте"><i class="fa fa-hdd-o fa-2x" aria-hidden="true"></i></a></div>
					<div class="col-sm-3"></div>					
				</div>				
			</div>
			<?}?>
		</div>
		</div>
		<div class="public-reviews"><h2>Опубликованные отзывы</h2>	
 		<div class="row padding-top-40 grid">		
		<?php $stmt = $connection->query('SELECT * FROM reviews WHERE status = 1 order by id desc');
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{?>
			<div class="col-xs-6 col-sm-4 col-md-3 reviews-block-admin grid-item">
				<div class="text">			
					<p class="name text-left"><strong><?php echo $row["firstname"] ?></strong></p><p class="date text-left"><?php echo $row["date"] ?></p>		
					<p class="text-justify"><?php echo $row["message"] ?></p>
				</div>	
				<div class="post_full_like_wrap">	
					<div class="col-sm-3"></div>					
					<div class="col-sm-2"><a id="tooltip" href="delete.php?id=<?php echo $row["id"]?>" title="Удалить"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></div>
					<div class="col-sm-2"></div>
					<div class="col-sm-2"><a id="tooltip" href="post.php?id=<?php echo $row["id"]?>" title="Опубликовать на сайте"><i class="fa fa-hdd-o fa-2x" aria-hidden="true"></i></a></div>
					<div class="col-sm-3"></div>					
				</div>
			</div>
			<?}?>
		</div>	
		</div>
		<div class="deleted-reviews"><h2>Удаленные отзывы</h2>
 		<div class="row padding-top-40 grid">		
		<?php $stmt = $connection->query('SELECT * FROM reviews WHERE deleted = 1 order by id desc');
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{?>
			<div class="col-xs-6 col-sm-4 col-md-3 reviews-block-admin grid-item">
				<div class="text">			
				<p class="name text-left"><strong><?php echo $row["firstname"] ?></strong></p><p class="date text-left"><?php echo $row["date"] ?></p>		
				<p class="text-justify"><?php echo $row["message"] ?></p>
				</div>	
				<div class="post_full_like_wrap">	
					<div class="col-sm-3"></div>					
					<div class="col-sm-2"><a id="tooltip" href="delete.php?id=<?php echo $row["id"]?>" title="Удалить"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></div>
					<div class="col-sm-2"></div>
					<div class="col-sm-2"><a id="tooltip" href="post.php?id=<?php echo $row["id"]?>" title="Опубликовать на сайте"><i class="fa fa-hdd-o fa-2x" aria-hidden="true"></i></a></div>
					<div class="col-sm-3"></div>					
				</div>				
			</div>
			<?}?>
		</div>
		</div>
 <!--/*<a id="anketa"></a>

		<div class="question"><h2>Анкеты</h2>
 		<div class="row padding-top-40 grid">		
		<?php $stmt = $connection->query('SELECT * FROM anketa WHERE deleted = 0 order by id desc');
			while($row = $stmt->fetch(PDO::FETCH_ASSOC))
			{?>
			<div class="col-xs-6 col-sm-4 col-md-3 reviews-block-admin grid-item">
				<div class="text">			
				<p class="name text-left"><strong><?php echo $row["Name"]?> <?php echo $row["LastName"]?></strong></p>
				<p class="date text-left"><strong><?php echo $row["Tel"]?></strong></p>
				<p class="date text-left"><strong><a href="mailto:<?php echo $row["Email"]?>"><?php echo $row["Email"]?></a></strong></p>
				<p class="age text-left"><strong>Возраст: <?php echo $row["age"] ?></strong></p>				
				<p class="date text-left">Дата заполнения: <?php echo $row["date"]?></p>	
				<p class="date text-left">На последнем м/р, мес.: в платной версии)))</p>				
				<p class="text-left"><strong>Вакансия: </strong><?php echo $row["position"]?></p>
				<p class="text-justify"><strong>Обязанности: </strong><?php echo $row["responsibilities"]?></p>
				<p class="text-justify"><strong>Навыки: </strong><?php echo $row["skills"]?></p>
				</div>	
				<div class="post_full_like_wrap">	
					<div class="col-sm-3"></div>					
					<div class="col-sm-2"><a id="tooltip" href="delete_anketa.php?id=<?php echo $row["id"]?>" title="Удалить"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></div>
					<div class="col-sm-2"></div>
					<div class="col-sm-2"></div>
					<div class="col-sm-3"></div>					
				</div>				
			</div>
			<?}?>
		</div>
		</div>	*/--> 	
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
<div class="container">
	<span class="title h4 col-xs-12">Контакты</span>
		<div class="col-md-4">
			<p>
			    190000, Санкт-Петербург <br>
				м. Ладожская, Проспект Косыгина, 21 лит. А
			</p>
			<p>			    
			    Телефон: (800) 888-88-88 <br>
			    Телефон: (800) 888-88-88 <br>
			    Электронная почта: <a href="mailto:lostaspb@mail.ru">lostaspb@mail.ru</a>
			</p>
		</div>
</div>	
<div class="container clearfix">
	<p><br>Просим обратить Ваше внимание на то, что данный сайт носит информационный характер.</p>
</div>	
</footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.scrollUp.min.js" type="text/javascript"></script>	
	<script src="../libs/masonry/masonry.pkgd.min.js"></script>
	<script src="../js/myscripts.js" type="text/javascript"></script>
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