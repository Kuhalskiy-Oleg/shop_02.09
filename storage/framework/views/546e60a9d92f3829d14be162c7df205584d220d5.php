<!DOCTYPE html>
<html lang="en">
<head>
<!-- в title у нас будет подгружаться значение section котрая будет называться title а второй параметр и будет значение т.е название страницы section('title','Home') -->
<title><?php echo $__env->yieldContent('title'); ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Sublime project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php echo $__env->yieldContent('head_link'); ?>



 <!-- подключаем jquery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

</head>
<body>

<div class="super_container">

	<!-- Header -->
	<!-- include - встроенная функция в larawel с помощью нее можно подгрузить в файл другие файлы -->
	<?php echo $__env->make('layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
	<!-- Menu -->
	<?php echo $__env->make('layout.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
	<!-- Content -->
	<!-- yield - когда мы вбиваем url адрес в поисковую строку то его считывают Routs и сравнивают со своими значениями и если значение совпадает то контроллер показывает нам определенную страницу и если на той странице будет подключен через extends() наш layout-main и будет section() которая будет совпадать с yield() в шаблоне то тогда подгрузится тот файл в шаблон в yield() -->
	<?php echo $__env->yieldContent('content'); ?>

	<!-- Footer -->
	<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
</div>

<!-- cюда будут подключатся теги со скриптами js -->
<?php echo $__env->yieldContent('script_js'); ?>

<!-- подключаем иконски с сайта font awesom -->
<script type="text/javascript" src="https://kit.fontawesome.com/441e03a245.js" crossorigin="anonymous"></script>



</body>
</html><?php /**PATH C:\OpenServer\domains\Larawel-create-shop\shop\resources\views/layout/main.blade.php ENDPATH**/ ?>