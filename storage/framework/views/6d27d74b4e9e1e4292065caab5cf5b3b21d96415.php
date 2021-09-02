<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->


<!-- это название страницы будет подгружаться в тег title -->
<?php $__env->startSection('title','Private'); ?>

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
<?php $__env->startSection('nav_active_Private','active'); ?>




<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
<?php $__env->startSection('head_link'); ?>
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">


 <!-- подключаем jquery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

<!-- bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<style>
	html,body,.super_container{
		height: 100%;	
	}

	.row.main-form{
		display: flex;
		height: 630px;
		overflow-y: auto;
	}
	.container.boot{
		display: flex;
		justify-content: space-between;
		align-items: center;
		height: 100%;	
		/*margin-top: 100px;*/
		z-index: 2;
	}


	.form-group{
	 	margin-bottom: 15px;
	}
	label{
	 	margin-bottom: 15px;
	}
	input,
	input::-webkit-input-placeholder {
	 	font-size: 11px;
	 	padding-top: 3px;
	}
	.form-control {
	 	height: auto!important;
		padding: 8px 12px !important;
	}
	.input-group {
	 	box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.21)!important;
	}
	#button {
		 border: 1px solid #ccc;
		 margin-top: 28px;
		 padding: 6px 12px;
		 color: #666;
		 text-shadow: 0 1px #fff;
		 cursor: pointer;
		 border-radius: 3px 3px;
		 box-shadow: 0 1px #fff inset, 0 1px #ddd;
		 background: #f5f5f5;
		 background: -moz-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #f5f5f5), color-stop(100%, #eeeeee));
		 background: -webkit-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 background: -o-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 background: -ms-linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 background: linear-gradient(top, #f5f5f5 0%, #eeeeee 100%);
		 filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f5f5f5', endColorstr='#eeeeee', GradientType=0);
	}
	.main-form{
		margin-top: 30px;
		margin: 0 auto;
		max-width: 400px;
		padding: 10px 40px;
		background:#009edf;
		color: #FFF;
		text-shadow: none;
		box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.31);
	}
	span.input-group-addon i {
	 	color: #009edf;
	 	font-size: 17px;
	}
	.login-button{
	 	margin-top: 5px;
	}
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">
<h1 style="color: black; margin-top: 150px;">Сюда попадают только те пользователи, которые прошли аунтефикацию !!!</h1>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\Larawel-create-shop\shop\resources\views/auth/private.blade.php ENDPATH**/ ?>