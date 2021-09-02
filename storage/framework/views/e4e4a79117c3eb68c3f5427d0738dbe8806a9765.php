<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->


<!-- это название страницы будет подгружаться в тег title -->
<?php $__env->startSection('title','Home'); ?>

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
<?php $__env->startSection('nav_active_home','active'); ?>

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
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script> -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if($products->count() > 0): ?>
<div class="home">
	<div class="home_slider_container">
		
		<!-- Home Slider -->
		<div class="owl-carousel owl-theme home_slider">
			
			<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<!-- Slider Item -->
			<div class="owl-item home_slider_item">
				<div class="home_slider_background" style="background-image:url('<?php echo e($product->img_label); ?>')"></div>
				<div class="home_slider_content_container">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
									<div class="home_slider_title"><?php echo e($product->title); ?></div>
									<div class="home_slider_subtitle"><?php echo e($product->announcement); ?></div>
									<div class="button button_light home_button"><a href="<?php echo e(Route('showProduct',['slug'=>$product->slug])); ?>">Show product</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
		</div>

		<!-- Home Slider Dots -->
		
		<div class="home_slider_dots_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_slider_dots">
							<ul id="home_slider_custom_dots" class="home_slider_custom_dots">
								<?php 
									$i = 1;
								?>
								<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="home_slider_custom_dot">0<?php echo e($i++); ?>.</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<script type="text/javascript">
									$(function(){
										//делаем первый элемент с номером слайдера с классом актив для подцветки
									    let number_slider = $('.home_slider_custom_dot'); 
									    $(number_slider[0]).attr('class','home_slider_custom_dot active');		
									})
								</script>
							</ul>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
<?php endif; ?>

<!-- Products -->

<div class="products">
	<div class="container">
		<div class="row">
			<div class="col">
				<style>
					li#lii{
						margin-left: 30px;
					}
				</style>

				<!-- выводим те картинки которые принадлежат определенному продукту -->
				<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
					<!-- если картинки есть то мы их выведем если нет то выведем сообщение -->
					<?php 
						if (count($value->images) > 0) {
							echo"<ul>".($value->images[0]->id).') '."<br>";					
						}else{
							echo "Нет картинок";	
						}						
					?>
					 
					<?php $__currentLoopData = $value->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php echo"<li id='lii'>".($value->img)."</li>" ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<?php echo "</ul><hr>"; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<br><br><br>

				<!-- так мы вывели первую картинку из всех для определенного товара -->
				<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
						//если картиноки есть то мы их выведем если нет то выведем сообщение
						if (count($value->images) > 0) {
							echo($value->images[0]->id).') '.($value->images[0]->img)."<br>";					
						}else{
							echo "Нет картинок"."<br>";		
						}						
					?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


				<br><br><br>

				
				<div class="product_grid">

					<!-- СКРИПТ ДЛЯ ДОБАВЛЕНИЕ ПРОДУКТА В КОРЗИНУ -->
					<script type="text/javascript">
						function addItemInCart(id) {
							

		            		let count_product = '1';
							let id_product = id;


							let data_order = {
								'count' : count_product ,
								'id'    : id_product ,
								
							};

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

										//_________добавляем кол-во товаров в header сайта где показывается общее кол-во товаров
										//забираем значение из span где показывает кол-во товара в корзине
										let count_products_in_cart = $('#count_products_in_cart').text();
										count_products_in_cart = parseInt(count_products_in_cart);

										//прибавляем плюс 1 к корзине т.к в таком случае возможно добавление товар в кол-ве 1 шт
										let quantity_input = 1;
										quantity_input = parseInt(quantity_input);

										//записываем сумму товаров в тег с отображением общего числа товаров в корзине
										$('#count_products_in_cart').html(count_products_in_cart + quantity_input);
									}

								}

							});
		
						}
					</script>

					<!-- проверяем является ли переменная products массивом или объектом если да то запускаем цикл -->
						<?php if(is_object($products)): ?>
						<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

						<!-- наполняем переменную которую будем подставлять в тег img в атрибут src -->
						<?php  
						$name_img = '';
						if(count($product->images) > 0){
							//если в таблице product_images есть рядоы у которых поле product_id  соответсвует  продукту (т.е у продукта есть картинки) то в переменную name_img мы запишем значение поля img из таблицы product_images
							$name_img = $product->images[0]->img;
						}else{
							//если в таблице product_images нет рядов у которых поле product_id  соответсвовало бы продукту (т.е у продукта нет картинок) то в переменную name_img мы запишем путь к картинке заглушке
							$name_img = 'images/not_file.png';
						}
					?>


					<!-- Product -->
					<div class="product" style="height: 394px;">
						<div class="product_image" style="height: 250px;overflow: hidden;display: flex;flex-direction: column;justify-content: center;">
							<img style="object-fit: fill;width: 100%;max-height: 100%;" src="<?php echo e($name_img); ?>" alt="">
						</div>
						<div class="product_extra product_new" style="width: 100px;">
							<a href="<?php echo e(Route('showCategory',['slug'=>$product->categories->slug])); ?>"><?php echo e($product->categories->title); ?></a>
						</div>
						<div class="product_content">
							<div class="product_title" 
								 style="display: flex;
								 		justify-content: space-between;
								 		width: 100%;">
								<a href="<?php echo e(Route('showProduct', ['slug' => $product->slug])); ?>"><?php echo e($product->title); ?></a>
								<!-- когда данные подгружаются ajaxom нужно в элементе который нужно отследить прописать атрибут onclick и поместить в него функцию которая будет добавлять нужный продукт в корзину -->
								<div class="addCart" onclick="addItemInCart('<?php echo e($product->id); ?>')">
									<i class="far fa-plus-square" 
									   style="display: block;
									   		  font-size: 20px;
									   		  color: green;
									   		  cursor: pointer; ">		  	
									</i>
								</div>
							</div>

							
							<?php if(!isset($product->new_price)): ?>
								<div class="product_price">$<?php echo e($product->price); ?></div>
							<?php else: ?>
								<style>
									.details_discount{
										display: inline-block;
									    font-size: 16px;
									    font-weight: 500;
									    color: #e95a5a;
									    margin-right: 20px;
									    text-decoration: line-through;
									}
								</style>	
								<div class="details_discount">$<?php echo e($product->price); ?></div>
								<div class="product_price">$<?php echo e($product->new_price); ?></div>
							<?php endif; ?>

						</div>
					</div>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>

				</div>
					
			</div>
		</div>
	</div>
</div>

<!-- Icon Boxes -->

<div class="icon_boxes">
	<div class="container">
		<div class="row icon_box_row">
			
			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
					<div class="icon_box_title">Free Shipping Worldwide</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
					<div class="icon_box_title">Free Returns</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
					<div class="icon_box_title">24h Fast Support</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Newsletter -->

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
					<div class="newsletter_title">Subscribe to our newsletter</div>
					<div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
					<div class="newsletter_form_container">
						<form action="#" id="newsletter_form" class="newsletter_form">
							<input type="email" class="newsletter_input" required="required">
							<button class="newsletter_button trans_200"><span>Subscribe</span></button>
						</form>
					</div>
				</div>
			</div>
		</div>
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
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\Larawel-create-shop\shop\resources\views/home/index.blade.php ENDPATH**/ ?>