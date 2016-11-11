<?php
include_once "conf.php";

if(isset($_POST['send'])) {
	$appForm = new 	appForm(
					$_POST['position'],
					$_POST['schedule'],
					$_POST['date_get_start'],
					$_POST['salary_desired'],
					$_POST['Name'],
					$_POST['LastName'],
					$_POST['DLastName'],
					$_POST['Email'],
					$_POST['Tel'],
					$_POST['citizenship'],
					$_POST['place_liv'],
					$_POST['birthday'],
					$_POST['Company_name'],
					$_POST['post'],
					$_POST['start_job'],
					$_POST['end_job'],
					$_POST['responsibilities'],
					$_POST['skills'],
					$_POST['Institute'],
					$_POST['speciality'],
					$_POST['diplom'],
					$_POST['Grad_year']					
					);
	if($appFormAction->appFormAdd($appForm)) {
		echo "Form added!!";
		print_r($appForm);
	} else {
		echo "Form dont added!!";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Вакансии</title>

	<link href="../../css/normalize.css" rel="stylesheet" type="text/css" />
	<link href="../../fonts/MyriadPro/css/MyriadPro.css" rel="stylesheet" type="text/css" />
	<link href="../../fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../../css/bootstrap.min.css" rel="stylesheet">	
	<link href="../../css/style.css" rel="stylesheet" type="text/css" />		
	<link href="../../css/navbar.css" rel="stylesheet" type="text/css" />		
	<link rel="stylesheet" href="../../libs/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
	
 	<!-- <link href="css/ui.totop.css" rel="stylesheet" media="screen,projection" />		 -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body data-spy="scroll" data-target="#navbar-example">
<!-- HTML-код модального окна -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Заголовок модального окна -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title form-heder">Анкета:</h4>
      </div>
      <!-- Основное содержимое модального окна -->
      <div class="modal-body">
        <!-- основное содержимое (тело) модального окна -->
        <div class="container-fluid">
          <!-- Контейнер, в котором можно создавать классы системы сеток -->
						<form class="form-horizontal" method="post" action="">			
								<div class="row">	
									<div class="col-sm-10">
										<div class="form-group">
											<label for="position" class="col-xs-4 control-label"><span class="form__required">*</span> Вакансия:</label>
											<div class="col-xs-8">
												<select class="form-control form__select" name="position" id="position" required>
													<option></option>
													<option value="Менеджер строительных проектов">Менеджер строительных проектов</option>
													<option value="Помощник управляющего проектами (строительство)">Помощник управляющего проектами (строительство)</option>
													<option value="Менеджер проектов автоматизации">Менеджер проектов автоматизации </option>
													<option value="Помощник управляющего проектами автоматизации">Помощник управляющего проектами автоматизации</option>
													<option value="Менеджер технических проектов ">Менеджер технических проектов </option>
													<option value="Помощник руководителя технических проектов">Помощник руководителя технических проектов</option>
													<option value="Менеджер по развитию">Менеджер по развитию</option>
													<option value="Специалист по внедрению АСУ ТП">Специалист по внедрению АСУ ТП</option>
													<option value="Креативный менеджер">Креативный менеджер</option>
													<option value="Технический писатель">Технический писатель</option>
													<option value="Аналитик">Аналитик</option>
													<option value="Инженер">Инженер</option>
													<option value="Электромонтер/Электромонтажник">Электромонтер/Электромонтажник</option>
													<option value="Ведущий юрист">Ведущий юрист</option>
													<option value="IT-специалист">IT-специалист</option>
													<option value="Инженер проектировщик ОВ, ВК">Инженер проектировщик ОВ, ВК</option>
													<option value="Архитектор">Архитектор</option>
													<option value="Офис менеджер">Офис менеджер</option>
													<option value="Заведующий хозяйством в службу эксплуатации">Заведующий хозяйством в службу эксплуатации</option>
													<option value="Главный инженер проекта">Главный инженер проекта</option>
													<option value="HR менеджер">HR менеджер</option>
													<option value="Инженер технического надзора">Инженер технического надзора</option>
													<option value="Конструктор КЖ, КМ">Конструктор КЖ, КМ</option>			
												</select>
											</div>
										</div>
									</div>
								</div>
								<!-- НАЧАЛО -->
								<!-- БЛОК РАЗДЕЛИТЕЛЬ -->
								<div class="row">	
									<div class="col-sm-10">
										<h4 class="text-left text-primary">Общая информация</h4>
									</div>
								</div>
								<!-- БЛОК РАЗДЕЛИТЕЛЬ -->								
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="schedule" class="col-xs-4 control-label"><span class="form__required">*</span> Пожелания по графику:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="schedule" id="schedule" required placeholder="Пятидневка"/>											
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="date_get_start" class="col-xs-4 control-label"><span class="form__required">*</span>  Когда готовы приступить к работе:</label>
											<div class="col-xs-8">
												<input type="date" class="form-control form__input" name="date_get_start" id="date_get_start" required/>												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->		
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="salary_desired" class="col-xs-4 control-label"> Желаемый месячный доход:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="salary_desired" id="salary_desired" placeholder="От 25 000 руб." />												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->			
								<!-- БЛОК РАЗДЕЛИТЕЛЬ -->
								<div class="row">	
									<div class="col-sm-10">
										<h4 class="text-left text-primary">Контакты</h4>
									</div>
								</div>
								<!-- БЛОК РАЗДЕЛИТЕЛЬ -->
								<div class="row">	
									<div class="col-sm-10">
										<div class="form-group">
											<label for="Name" class="col-xs-4 control-label"><span class="form__required">*</span> Имя:</label>
											<div class="col-xs-8">
												<input type="text" maxlength="15" class="form-control form__input" name="Name" id="Name" required placeholder="Ваше имя"/>	
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="LastName" class="col-xs-4 control-label"><span class="form__required">*</span> Фамилия:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="LastName" id="LastName" required placeholder="Ваша фамилия"/>
											</div>
										</div>
									</div>							
								</div>	
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="DLastName" class="col-xs-4 control-label">Отчество:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="DLastName" id="DLastName" placeholder="Ваше Отчество"/>
											</div>
										</div>
									</div>							
								</div>									
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="Email" class="col-xs-4 control-label"><span class="form__required">*</span> E-mail:</label>
											<div class="col-xs-8">						
												<input type="email" class="form-control form__input" name="Email" id="Email" required placeholder="Ваш E-mail"/>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="Tel" class="col-xs-4 control-label"><span class="form__required">*</span> Телефон:</label>
											<div class="col-xs-8">
												<input type="tel" pattern="\(\d\d\d\) ?\d\d\d-\d\d-\d\d" class="form-control form__input" name="Tel" id="Tel" required placeholder="(###) ###-##-##"/>
											</div>
										</div>
									</div>					
								</div>
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="citizenship" class="col-xs-4 control-label">Гражданство:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="citizenship" id="citizenship" placeholder="Гражданство" />												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="place_liv" class="col-xs-4 control-label">Место проживания:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="place_liv" id="place_liv" placeholder="Место проживания" />												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="birthday" class="col-xs-4 control-label"><span class="form__required">*</span> Дата рождения:</label>
											<div class="col-xs-8">
												<input type="date" class="form-control form__input" name="birthday" id="birthday" placeholder="Дата рождения:" />												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->	
								<!-- БЛОК РАЗДЕЛИТЕЛЬ -->
								<div class="row">	
									<div class="col-sm-10">
										<h4 class="text-left text-primary">Профессиональная деятельность</h4>
									</div>
								</div>
								<!-- БЛОК РАЗДЕЛИТЕЛЬ -->	
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="Company_name" class="col-xs-4 control-label">Компания:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="Company_name" id="Company_name" placeholder="Наименование" />												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="post" class="col-xs-4 control-label">Должность:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="post" id="post" placeholder="Должность" />												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->	
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="start_job" class="col-xs-4 control-label"><span class="form__required">*</span> Начало работы:</label>
											<div class="col-xs-8">
												<input type="month" class="form-control form__input" name="start_job" id="start_job" />												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="end_job" class="col-xs-4 control-label"><span class="form__required">*</span> Окончание работы:</label>
											<div class="col-xs-8">
												<input type="month" class="form-control form__input" name="end_job" id="end_job"/>												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->	
								<div class="row">
									<div class="col-sm-10">	
										<div class="form-group">
											<label for="responsibilities" class="col-xs-4 control-label"><span class="form__required">*</span>  Обязанности/Достижения:</label>
											<div class="col-xs-8">						
												<textarea maxlength="350" class="form-control form__textarea" required placeholder="Обязанности и достижения на последнем месте работы, не более 350 знаков"  name="responsibilities" id="responsibilities" rows="3"></textarea>
											</div>
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-sm-10">	
										<div class="form-group">
											<label for="skills" class="col-xs-4 control-label"><span class="form__required">*</span> Ключевые навыки:</label>
											<div class="col-xs-8">						
												<textarea maxlength="350" class="form-control form__textarea" required placeholder="Приобретенные навыки, не более 350 знаков"  name="skills" id="skills" rows="3"></textarea>
											</div>
										</div>
									</div>
								</div>	
								<!-- БЛОК РАЗДЕЛИТЕЛЬ -->
								<div class="row">	
									<div class="col-sm-10">
										<h4 class="text-left text-primary">Образование</h4>
									</div>
								</div>
								<!-- БЛОК РАЗДЕЛИТЕЛЬ -->								
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="Institute" class="col-xs-4 control-label"> Учебное заведение:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="Institute" id="Institute" placeholder="Учебное заведение" />												
											</div>
										</div>
									</div>							
								</div>								
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="speciality" class="col-xs-4 control-label">Специальность:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="speciality" id="speciality" placeholder="Специальность" />												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="diplom" class="col-xs-4 control-label">Вид диплома, степень:</label>
											<div class="col-xs-8">
												<input type="text" class="form-control form__input" name="diplom" id="diplom" placeholder="Бакалавр, сертификат" />												
											</div>
										</div>
									</div>							
								</div>
								<!-- КОНЕЦ -->	
								<!-- НАЧАЛО -->
								<div class="row">
									<div class="col-sm-10">
										<div class="form-group">
											<label for="Grad_year" class="col-xs-4 control-label">Год окончания:</label>
											<div class="col-xs-8">
												<input type="month" class="form-control form__input" name="Grad_year" id="Grad_year" />	
											</div>
										</div>
									</div>							
								</div>
								<div class="row">
									<div class="col-sm-10">	
										<div class="checkbox">
																				
											<label>
											<input type="checkbox" required><h5 class="text-left text-primary"><span class="form__required"> * </span>Подтверждаю право работодателя на обработку персональных данных, указанных мною.</h5>
											</label>
										</div>
								</div>		  
      <!-- Футер модального окна -->
    <div class="modal-footer">
		<div class="row">
			<div class="col-sm-10">
				<div class="form-group">
					<div class="col-xs-3"></div>
						<div class="col-xs-9">
							<button type="submit" class="btn btn-primary" name="send">Отправить</button>
						</div>
				</div>	
			</div>
		</div>
	</div>
		</form>			
    </div>
    </div>
  </div>
</div>	
</div>
</div>
<!-- /HTML-код модального окна -->
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
		  <img alt="Brand" src="img/logo_small.png">
		  </a> 
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav  navbar-right">
			<li><a href="index.htm">О Компании</a></li>
			<li><a href="index.htm#our_project">Проекты</a></li>
			<li><a href="index.htm#optimization">Команда</a></li>
			<li><a href="events.htm">Мероприятия</a></li>
			<li class="active"><a href="#">Вакансии</a></li>
			<li><a href="index.htm#reviews">Отзывы</a></li>
			<li><a href="index.htm#contact">Контакты</a></li>
			<li><a href="/admin/"><i class="fa fa-sign-in" aria-hidden="true"></i></a></li>			
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav> 
</div>	
	<div data-stellar-background-ratio="0.5" class="splash-second">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-1"></div>
				<div class="col-sm-6">
					 <img alt="ЛОСТА" src="img/logo_header.png" style="padding-top: 40px;">
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
					<h2>«Кадры решают всё».</h2>
					</p>
					<cite style="color:#fff;">И. В. Сталин</cite>
				</blockquote>
			</div>
			<div class="col-xs-1"></div>			
			</div>						
		</div>
	</div>
</header>
<main>
<a id="vacancy">
<section class="vacancy">
</a>
	<div class="container-fluid">
		<div class="row vacancy">
			<h2>Наши вакансии</h2>
			<img src="img/hr.png" class="center-block">		
		</div>
		<div class="row text-left">
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span>
			</div>
			<div class="col-md-4 padding-vacancy">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy1.htm"><h4>Менеджер строительных проектов</h4></a>		
			</div>
			<div class="col-md-2 padding-vacancy"></div>
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>			
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy2.htm"><h4>Технический писатель</h4></a>			
			</div>			
		</div>
		<div class="row text-left">
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy3.htm"><h4>Менеджер проектов автоматизации</h4></a>			
			</div>
			<div class="col-md-2 padding-vacancy"></div>
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>			
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy4.htm"><h4>Ведущий юрист</h4></a>
			</div>			
		</div>
		<div class="row text-left">
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy5.htm"><h4>Менеджер технических проектов</h4></a>						
			</div>
			<div class="col-md-2 padding-vacancy"></div>
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>			
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy6.htm"><h4>Архитектор</h4></a>
			</div>			
		</div>
		<div class="row text-left">
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy7.htm"><h4>Электромонтер/электромонтажник</h4></a>			
			</div>
			<div class="col-md-2 padding-vacancy"></div>
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>			
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy8.htm"><h4>Офис менеджер</h4></a>
				<h4><small></small></h4>
			</div>			
		</div>
		<div class="row text-left">
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy9.htm"><h4>Инженер проектировщик ОВ, ВК</h4></a>
			</div>
			<div class="col-md-2 padding-vacancy"></div>
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>			
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy10.htm"><h4>Главный инженер проекта</h4></a>
			</div>			
		</div>
		<div class="row text-left">
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy11.htm"><h4>Заведующий хозяйством</h4></a>			
			</div>
			<div class="col-md-2 padding-vacancy"></div>
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>			
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy12.htm"><h4>Инженер технического надзора</h4></a>
			</div>			
		</div>
		<div class="row text-left">
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy13.htm"><h4>HR-менеджер</h4></a>		
			</div>
			<div class="col-md-2 padding-vacancy"></div>
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>			
			<div class="col-md-4 padding-vacancy ">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy14.htm"><h4>Помощник управляющего проектами</h4></a>
			</div>			
		</div>
		<div class="row text-left">
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>
			<div class="col-md-4 padding-vacancy">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy15.htm"><h4>Конструктор КЖ, КМ</h4></a>			
			</div>
			<div class="col-md-2 padding-vacancy"></div>
			<div class="col-md-1 padding-vacancy text-center">
				<span class="fa-stack fa-lg arroy">
					<i class="fa fa-circle-o fa-stack-2x fa-2x"></i>			
					<i class="fa fa-arrow-right fa-stack-1x"></i>
				</span> 
			</div>			
			<div class="col-md-4 padding-vacancy">
				<a class="various" data-fancybox-type="iframe" href="vacancy/vacancy16.htm"><h4>Помощник руководителя проектов</h4></a>
			</div>			
		</div>		
	</div>
	<div class="container">
		<button type="submit" class="btn btn-primary">Заполнить анкету
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
			    195213, Санкт-Петербург <br>
				м. Ладожская, Проспект Косыгина, 21 лит. А
			</p>
			<p>			    
			    Телефон: (812) 577-24-99 <br>
			    Электронная почта: <a href="mailto:info@lostaspb.ru">info@lostaspb.ru</a>
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
    <script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.scrollUp.min.js" type="text/javascript"></script>	
	<script src="../..libs/stellar/jquery.stellar.js"></script>		
	<script type="text/javascript" src="../../libs/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
	<!-- <script src="js/myscripts.js" type="text/javascript"></script>			 -->
<script>
// всплывающие окна с текстом вакансий
jQuery(document).ready(function() { 
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});	
//при нажатию на любую кнопку, имеющую класс .btn открыть модальное окно с id="myModal"
jQuery(document).ready(function(){	  
	$(".btn").click(function() {
		$("#myModal").modal('show');
		});
	});
	$.stellar();
</script>
</body>
</html>