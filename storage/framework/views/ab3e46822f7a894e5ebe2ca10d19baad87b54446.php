<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->


<!-- это название страницы будет подгружаться в тег title -->
<?php $__env->startSection('title','Sign in'); ?>

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
<?php $__env->startSection('nav_active_Sign_in','active'); ?>


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
	.container.boot{
		display: flex;
		justify-content: center;
		flex-direction: column;
		align-items: center;
		height: 100%;	
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

<div class="container boot">
	<div class="row main-form">

		<!-- action - адрес куда отправляются данные ( в контроллер ) -->
		<form class="" method="post" action="<?php echo e(Route('auth.login')); ?>">

			<?php echo csrf_field(); ?>

			<div class="form-group">
				<label for="email" class="cols-sm-2 control-label">Your Login</label>
				<div class="cols-sm-10">

					<div class="input-group" style="<?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>border: 2px solid red;border-radius: 7px;box-shadow: 0px 0px 10px 3px red!important;<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
						<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
						<input type="text" class="form-control" value="<?php echo e(old('login')); ?>" name="login" id="login" placeholder="Enter your Login"/>
					</div>

					<!-- эта ошибка будет вызываться если такого email не найдется в бд -->
					<?php $__errorArgs = ['error'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<div class="alert alert-danger" style="margin-top: 2px;border-radius: 0 0 22px 22px;"><?php echo e($message); ?></div>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

					<!-- эта ошибка будет вызываться если валидация поля не будет пройдена -->
					<?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<div class="alert alert-danger" style="margin-top: 2px;border-radius: 0 0 22px 22px;"><?php echo e($message); ?></div>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

				</div>
			</div>


			<div class="form-group">
				<label for="password" class="cols-sm-2 control-label">Password</label>
				<div class="cols-sm-10">

					<div class="input-group" style="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>border: 2px solid red;border-radius: 7px;box-shadow: 0px 0px 10px 3px red!important;<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
						<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
						<input type="password" class="form-control" value="<?php echo e(old('password')); ?>" name="password" id="password" placeholder="Enter your Password"/>
					</div>

					<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
						<div class="alert alert-danger" style="margin-top: 2px;border-radius: 0 0 22px 22px;"><?php echo e($message); ?></div>
					<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

				</div>
			</div>

			<div class="password" style="display: block;width: 100%;">
				<a href="<?php echo e(Route('auth.forgot')); ?>" style="color: white;font-size: 15px;text-decoration: underline;">Восстановление пароля</a>
			</div>
			


			<div class="form-group ">
				<button type="submit" id="button" class="btn btn-primary btn-lg btn-block login-button">Sign in</button>
			</div>

		</form>

	</div>

</div>



<?php $__env->stopSection(); ?>




<?php $__env->startSection('script_js'); ?>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\localhost\shop\resources\views/auth/login.blade.php ENDPATH**/ ?>