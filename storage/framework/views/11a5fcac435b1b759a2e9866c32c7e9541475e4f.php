<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->


<!-- это название страницы будет подгружаться в тег title -->
<?php $__env->startSection('title','Product'); ?>

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
<?php $__env->startSection('nav_active_home','active'); ?>


<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
<?php $__env->startSection('head_link'); ?>
<link rel="stylesheet" type="text/css" href="/styles/bootstrap4/bootstrap.min.css">
<link href="/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="/styles/product.css">
<link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
<!-- <link rel="stylesheet" href="https://bootstraptema.ru/plugins/2015/bootstrap3/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
<style>

.img-sm {
 width: 46px;
 height: 46px;
}
.panel {
 box-shadow: 0 2px 0 rgba(0,0,0,0.075);
 border-radius: 0;
 border: 0;
 margin-bottom: 15px;
}
.panel .panel-footer, .panel>:last-child {
 border-bottom-left-radius: 0;
 border-bottom-right-radius: 0;
}
.panel .panel-heading, .panel>:first-child {
 border-top-left-radius: 0;
 border-top-right-radius: 0;
}
.panel-body {
 padding: 25px 20px;
}
.media-block .media-left {
 display: block;
 float: left
}
.media-block .media-right {
 float: right
}
.media-block .media-body {
 display: block;
 overflow: hidden;
 width: auto
}
.middle .media-left,
.middle .media-right,
.middle .media-body {
 vertical-align: middle
}
.thumbnail {
 border-radius: 0;
 border-color: #e9e9e9
}
.tag.tag-sm, .btn-group-sm>.tag {
 padding: 5px 10px;
}
.tag:not(.label) {
 background-color: #fff;
 padding: 6px 12px;
 border-radius: 2px;
 border: 1px solid #cdd6e1;
 font-size: 12px;
 line-height: 1.42857;
 vertical-align: middle;
 -webkit-transition: all .15s;
 transition: all .15s;
}
.text-muted, a.text-muted:hover, a.text-muted:focus {
 color: #acacac;
}
.text-sm {
 font-size: 0.9em;
}
.text-5x, .text-4x, .text-5x, .text-2x, .text-lg, .text-sm, .text-xs {
 line-height: 1.25;
}
.btn-trans {
 background-color: transparent;
 border-color: transparent;
 color: #929292;
}
.btn-icon {
 padding-left: 9px;
 padding-right: 9px;
}
.btn-sm, .btn-group-sm>.btn, .btn-icon.btn-sm {
 padding: 5px 10px !important;
}
.mar-top {
 margin-top: 15px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
<!-- Home -->

<div class="home">
	<div class="home_container">
		<div class="home_background" style="background-image:url('<?php echo e($product->categories->img_label); ?>')"></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title"><?php echo e($product->categories->title); ?><span>.</span></div>
							<div class="home_text"><p><?php echo e($product->categories->announcement); ?></p></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Product Details -->

<div class="products" style="padding: 89px 0">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="products_title"><?php echo e($product->title); ?></div>
			</div>
		</div>
	</div>
</div>

<div class="product_details">
	<div class="container">
		<div class="row details_row" style="margin-top: 0;">

			<!-- если у продукта есть картинки то 
				1)  наполним переменную count_img числом сколько картинок есть у одного продукта и это число мы будем использовать далее для условия if что бы создать галерею картинок под основной картинкой и так же это число будем вставлять в стиль width
				2)  наполним переменную name_img названием картинки а если count будет равен 0 то наполним эту переменную путем к заглушке  
			-->
			<!-- если у прдукта поле in_stock = 1 то наполним переменную stock значением 'In Stock'-->

			<?php
			$count_img = 0;
			if(count($product->images) > 0){
				$count_img = count($product->images);
				$name_img = $product->images[0]->img;
			}else{
				$name_img = '/images/not_file.png';
			}
			if($product->in_stock){
				$stock = 'In Stock';
			}else{
				$stock = 'Not Stock';
			}
			?>


	

			<!-- Product Image -->
			<div class="col-lg-6">
				<div class="details_image">
					<div class="details_image_large"><img src="<?php echo e($name_img); ?>" alt=""></div>
					<div class="details_image_thumbnails d-flex flex-row align-items-start justify-content-between">
						
						<?php if($count_img != 0): ?>
						<?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<!-- если кол-во картинок будет = 1 то запишем что всетаки 2 чтобы картинка которая находится под главной была маленького размера а не как главная картинка -->
						<div class="details_image_thumbnail" style="width: calc((100% - 51px) / <?php echo e(($count_img == 1)?2:$count_img); ?>);" data-image="<?php echo e($images->img); ?>"><img src="<?php echo e($images->img); ?>" alt=""></div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>

					</div>
				</div>
			</div>

			<!-- Product Content -->
			<div class="col-lg-6">
				<div class="details_content">
					<div class="details_name"><?php echo e($product->categories->title); ?></div>
					<?php if(!isset($product->new_price)): ?>
						<div class="details_price">$<?php echo e($product->price); ?></div>
					<?php else: ?>
						<div class="details_discount">$<?php echo e($product->price); ?></div>
						<div class="details_price">$<?php echo e($product->new_price); ?></div>
					<?php endif; ?>
					

					<!-- In Stock -->
					<div class="in_stock_container">
						<div class="availability">Availability:</div>
						<span><?php echo e($stock); ?></span>
					</div>
					<div class="details_text">
						<p><?php echo e($product->announcement); ?></p>
					</div>

					<!-- Product Quantity -->
					<div class="product_quantity_container">
						<div class="product_quantity clearfix">
							<span>Qty</span>
							<input id="quantity_input" type="text" max="100" min="1" pattern="[0-9]*" value="1">
							<div class="quantity_buttons">
								<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
								<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
							</div>
						</div>
						<div class="button cart_button"><a href="#">Add to cart</a></div>
					</div>

					<!-- Share -->
					<div class="details_share">
						<span>Share:</span>
						<ul>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row description_row">
			<div class="col">
				<div class="description_title_container">
					<div class="description_title">Description</div>
				</div>
				<div class="description_text">
					<p><?php echo e($product->description); ?></p>
				</div>
			</div>
		</div>

		

	</div>
</div>

<!-- Products -->



<!-- Comments -->

<div class="newsletter">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="newsletter_border"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="newsletter_content text-center">
					<div class="newsletter_title">Coments</div>
					<div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
					<div class="panel">
						<div class="panel-body">

							<!-- form comments -->
							<form method="POST" action="<?php echo e(Route('comment', ['slug' => $product->slug])); ?>">
								<!-- csrf - чтобы небыло бесконечной отправки данных злоумышлиниками -->
								<!-- файл с настройками csrf лежит в папке middleware->VerifyCsrfToken -->
								<!-- без csrf будет 419 -->
								<?php echo csrf_field(); ?>
								<textarea name="text" class="form-control" rows="2" placeholder="Добавьте Ваш комментарий"><?php echo e(old('text')); ?></textarea>

								<?php $__errorArgs = ['text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<span style="display: block;font-size: 12px;color: red;text-align: center;width: 100%;"><?php echo e($message); ?></span>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								
								<div class="mar-top clearfix">
									<button class="btn btn-sm btn-primary pull-right" type="submit">
										<i class="fa fa-pencil fa-fw"></i> Добавить
									</button>
								</div>
							</form>

						</div>
					</div>

					<?php if(isset($comments)): ?>
						<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="panel">
								<div class="panel-body">
									<div class="media-block" style="background-color: aliceblue;">
										<div class="media-body">
											<div class="mar-btm">
												<span href="#" class="btn-link text-semibold media-heading box-inline">
													<?php echo e($comment->user->name); ?>

												</span>
												<p class="text-muted text-sm"><?php echo e($comment->created_at); ?></p>
											</div>
											<p><?php echo e($comment->text); ?></p>
											<hr style="margin-bottom: 0">
										 </div>
									</div>
								</div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>






<?php $__env->startSection('script_js'); ?>
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/styles/bootstrap4/popper.js"></script>
<script src="/styles/bootstrap4/bootstrap.min.js"></script>
<script src="/plugins/greensock/TweenMax.min.js"></script>
<script src="/plugins/greensock/TimelineMax.min.js"></script>
<script src="/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="/plugins/greensock/animation.gsap.min.js"></script>
<script src="/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="/plugins/easing/easing.js"></script>
<script src="/plugins/parallax-js-master/parallax.min.js"></script>
<script src="/js/product.js"></script>

<script type="text/javascript">
	$(function(){
		$('.button.cart_button').click(function(e){
			e.preventDefault();

			let count_product = $('#quantity_input').val();
			let id_product = "<?php echo e($product->id); ?>";

			/*
			Ассоциативные массивы в JavaScript делаются с помощью объектов.

			Объекты создаются с помощью фигурных скобок { }, внутри которых пишутся элементы этого объекта в формате ключ-значение. Синтаксис здесь такой: ключ, затем идет двоеточие :, а потом значение.
			*/

			let data_order = {
				'count' : count_product ,
				'id'    : id_product ,
				
			};
			//console.log(data_order)

			$.ajax({
				url: "<?php echo e(Route('cart.addInCart')); ?>",
				type: 'POST',

				//при отправке всех запросов мы должны отправлять такие заголовки для безопасности
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },

			    dataType: "json",//dataType  какого ответа ожидать?

				contentType: "application/json",//contentType- это HTTP- заголовок, отправляемый на сервер, определяющий конкретный формат отправляемых данных.


			    //будем передавать в параметрах запроса id выбранных товаров чтобы добавить их в корзину
			    //эти параметры будут доступны в контроллере который будет обрабатывать этот запрос
			    //stringify - принимает объект js (ассоциативный массив)
				data: JSON.stringify({ 
					count : data_order.count ,
					id : data_order.id ,
				}),

				success:(data) => {
					console.log(data)

					if (data['status'] == 'error'){

						if (confirm(data['messege'])){
							window.location.href = "<?php echo e(Route('auth.login')); ?>"; 
						}

					}else{
						//_________добавляем кол-во товаров в header где показывается общее кол-во товаров
					
						//забираем значение из span где показывает кол-во товара в корзине
						let count_products_in_cart = $('#count_products_in_cart').text();
						count_products_in_cart = parseInt(count_products_in_cart);

						//забираем введенное пользователем кол-во товара
						let quantity_input = $('#quantity_input').val();
						quantity_input = parseInt(quantity_input);

						$('#count_products_in_cart').html(count_products_in_cart + quantity_input);


					}


				}

			})
			
		})

	})
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\Larawel-create-shop\shop\resources\views/product/show_product.blade.php ENDPATH**/ ?>