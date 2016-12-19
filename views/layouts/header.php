<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Главная</title>
	<link href="/template/css/bootstrap.min.css" rel="stylesheet">
	<link href="/template/css/font-awesome.min.css" rel="stylesheet">
	<link href="/template/css/prettyPhoto.css" rel="stylesheet">
	<link href="/template/css/price-range.css" rel="stylesheet">
	<link href="/template/css/animate.css" rel="stylesheet">
	<link href="/template/css/main.css" rel="stylesheet">
	<link href="/template/css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="/template/css/simplePagination.css">

	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<link rel="shortcut icon" href="/template/images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144"
	      href="/template/images/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114"
	      href="/template/images/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72"
	      href="/template/images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/template/images/ico/apple-touch-icon-57-precomposed.png">
	<link type='text/css' href='/template/css/basic.css' rel='stylesheet' media='screen'/>
</head><!--/head-->


<body style="background-color:<?php echo $_COOKIE['colorBody']; ?> ">

<div style="display: none; padding: 10px; text-align: center" id="exit_content">
	<h1>Вы действительно хотите покинуть сайт?</h1><br>
	<h3>Благодарим Вас за визит!</h3>
</div>
<div class="page-wrapper" style="background-color:''>


            <header id=" header
"><!--header-->
<div class="header_top"><!--header_top-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="contactinfo">
					<ul class="nav nav-pills">
						<li><a href="/">Интернет-магазин Верес</a></li>
						<li><a href="#"><i class="fa fa-phone"></i> Телефон 555-55-55</a></li>
						<li><a href="#"><i class="fa fa-envelope"></i> veres@veres.com</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div><!--/header_top-->

<div class="header-middle" style="<?php echo $_COOKIE['colorBody']; ?>!important;"><!--header-middle-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="logo-veres pull-left">
					<a href="/"><img src="/template/images/home/logo.png" alt=""/></a>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="shop-menu pull-right">
					<ul class="nav navbar-nav">
						<li><a href="/cart">
								<i class="fa fa-shopping-cart"></i> Корзина
								(<span id="cart-count"><?php echo Cart::countItems(); ?></span>)
							</a>
						</li>
						<?php if ( User::isGuest() ): ?>
							<li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
							<li><a href="/user/register"><i class="fa fa-check-square" aria-hidden="true"></i>Регистрация</a>
							</li>
						<?php else: ?>
							<li><a href="/cabinet/"><i class="fa fa-user"></i> Аккаунт</a></li>
							<li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div><!--/header-middle-->

<div class="header-bottom"><!--header-bottom-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="mainmenu pull-left">
					<ul class="nav navbar-nav collapse navbar-collapse">
						<li><a href="/">Главная</a></li>
						<li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
							<ul role="menu" class="sub-menu">
								<li><a href="/cart/">Корзина</a></li>
								<li><a href="/catalog/">Каталог</a>
									<ul class="nav">
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
												Меню тест
												<a class="caret"></a>
											</a>
											<ul class="dropdown-menu" style="background-color: #5e5e5e">
												<li><a href="#">Тест 1</a></li>
												<li><a href="#">Тест 2</a></li>
												<li><a href="#">Тест 3</a></li>
												<li><a href="#">Тест 4</a></li>
												<li><a href="#">Тест 5</a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li><a href="/about/">О магазине</a></li>
						<li><a href="/contacts/">Контакты</a></li>
						<li><a href="/product/filter">Фильтр</a></li>
						<li>
							<form style="padding-top: 0px" action="" method="post" name="form"
							      onsubmit="return false;">
								<p style="color: grey">
									<label>Поиск:</label>
									<input name="search" type="text" id="search" style="color: #130924">
								</p>
							</form>
							<div id="resSearch" style="background-color: #f8f0f8"></div>

						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/header-bottom-->

</header><!--/header-->