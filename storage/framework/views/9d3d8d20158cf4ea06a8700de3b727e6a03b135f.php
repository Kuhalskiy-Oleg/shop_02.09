<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->


<!-- это название страницы будет подгружаться в тег title -->
<?php $__env->startSection('title','Cart'); ?>

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
<?php $__env->startSection('nav_active_home','active'); ?>


<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
<?php $__env->startSection('head_link'); ?>
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/cart.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
<style type="text/css">
	
	@media(max-width: 992px){
		div[data-error]{
		    left: 101%!important;
		    top: -2%!important;
		}
	}

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Home -->
<div class="home">
	<div class="home_container">
		<div class="home_background" style="background-image:url(images/cart.jpg)"></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="breadcrumbs">
								<ul>
									<li><a href="<?php echo e(Route('index')); ?>">Home</a></li>
									<li>Shopping Cart</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Cart Info -->

<div class="cart_info">
	<div class="container">
		<div class="row">
			<div class="col">
				<!-- Column Titles -->
				<div class="cart_info_columns clearfix">
					<div class="cart_info_col cart_info_col_product">Product</div>
					<div class="cart_info_col cart_info_col_price">Price</div>
					<div class="cart_info_col cart_info_col_quantity">Quantity</div>
					<div class="cart_info_col cart_info_col_total">Total</div>
				</div>
			</div>
		</div>
		<div class="row cart_items_row">
			<div class="col">


				<!-- auth - для работы аутентифицированными пользователями -->
				<?php if(auth()->guard('web')->check()): ?>
				 
				<!-- записываем в переменную все выбранные клиентом товары -->
				<?php 
					$getContent = \Cart::session(@auth()->user()->id)->getContent();
				?>

				<?php if( isset($getContent) ): ?>
					<?php if( $getContent->count() > 0 ): ?>
						<?php $__currentLoopData = $getContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

						<!-- Cart Item -->
						<div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start" data-idproduct="<?php echo e($value->id); ?>">
							<!-- Name -->
							<div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
								<div class="cart_item_image" style="overflow: hidden;display: flex;flex-direction: column;justify-content: center;">
									<div><img style="object-fit: fill;width: 100%;max-height: 100%;" src="<?php echo e($value->attributes->img); ?>" alt=""></div>
								</div>
								<!--  -->
								<div class="cart_item_name_container">
									<div class="cart_item_name"><a href="<?php echo e(Route('showProduct', ['slug' => $value->attributes->slug])); ?>"><?php echo e($value->name); ?></a></div>
									<div class="cart_item_edit" data-edit="<?php echo e($value->id); ?>"><a href="#">Edit Product</a></div>
									<div class="cart_item_edit" data-delete="<?php echo e($value->id); ?>">
										<a href="">Delte</a>
									</div>
								</div>
							</div>
							<!-- Price -->
							<div class="cart_item_price" data-price_id="<?php echo e($value->id); ?>"></div>
							<!-- Quantity -->
							<div class="cart_item_quantity">
								<div class="product_quantity_container">
									<div class="product_quantity clearfix" data-response="<?php echo e($value->id); ?>" style="position:relative;overflow: inherit;">
										<span>Qty</span>
										<!-- pattern="[0-9]*" -->
										<input class="quantity_input" type="text"  value="<?php echo e($value->quantity); ?>" style="width: 50px;">
										<div data-error class="response_<?php echo e($value->id); ?>" style="position: absolute;width: 100%;left: 0;border-radius: 0;top: 102%;"></div>

									</div>

									
								</div>
								

							</div>
							<!-- Total -->
							<div class="cart_item_total" data-sum_price_id="<?php echo e($value->id); ?>"></div>
						</div>


						<script type="text/javascript">
							$(function(){
								//функция для денежного формата чисел
								function makeMoney(number) {
								    return '$ ' + parseFloat(number).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ");
								}

								//cкрипт для отображения полученной с сервера цены товара 
								$('.cart_item_price[data-price_id="<?php echo e($value->id); ?>"]').
								text(makeMoney( '<?php echo e($value->price); ?>' ));


								//cкрипт для отображения полученной с сервера цены товара умноженной на кол-во товара одногго типа 
								$('.cart_item_total[data-sum_price_id="<?php echo e($value->id); ?>"]').
								text(makeMoney( '<?php echo e($value->price * $value->quantity); ?>' ));
							})
						</script>

						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?> 
						<span style="display: block;
									 width: 100%;
									 text-align: center;
									 font-size: 25px;">
							Корзина пуста !
						</span>
					<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>
				


			</div>
		</div>
		<div class="row row_cart_buttons">
			<div class="col">
				<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
					<div class="button continue_shopping_button"><a href="<?php echo e(Route('products')); ?>">Continue shopping</a></div>
					<div class="cart_buttons_right ml-lg-auto">
						<div class="button clear_cart_button"><a href="">Clear cart</a></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row row_extra">
			<div class="col-lg-4">
			</div>
			<div class="col-lg-6 offset-lg-2">
				<div class="cart_total">
					<div class="section_title">Cart total</div>
					<div class="section_subtitle">Final info</div>
					<div class="cart_total_container">
						<ul>
							<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="cart_total_title">Total</div>
								<div class="cart_total_value ml-auto" data-total_price></div>	
							</li>
						</ul>
					</div>
					<div class="button checkout_button"><a href="<?php echo e(Route('checkout')); ?>">Proceed to checkout</a></div>
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
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/cart.js"></script>

<script type="text/javascript">
	$(function(){

		//функция для денежного формата чисел
		function makeMoney(number) {
		    return '$ ' + parseFloat(number).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ");
		}

		//при загрузки страницы записываем в тег (с отображением цены умноженной на кол-во товара одного типа) цену полученную от сервера
		$('div[data-total_price]').html(makeMoney(
			<?php if(auth()->guard('web')->check()): ?>
			<?= \Cart::session(@auth()->user()->id)->getTotal() ?>
			<?php endif; ?>
			<?php if(auth()->guard('web')->guest()): ?>
			0
			<?php endif; ?>
		))

		

		// СКРИПТ ДЛЯ РЕДАКТИРОВАНИЯ КОРЗИНЫ
		$('.cart_item_edit[data-edit]').click(function(e){
			e.preventDefault();

			//забираем номер товара в корзине
			let id_product = $(this).data('edit');
			//console.log(id_product) 

			//ищем родителя блока с товаром
			let parent = $(this).closest('.cart_item');
			//ищем у родителя нужный нам input
			let count = $(parent).find('.quantity_input').val();
			//console.log(count)

			//ищем блок с общей цценой товара
			let price_old = $(parent).find('.cart_item_total');
			let price_old_value = $(parent).find('.cart_item_total').text();
			price_old_value = price_old_value.split('$').pop();
			//console.log(price_old_value)

			let product_obj = { 
				"id"    : id_product ,
				"count" : count ,
			};

			$.ajax({
				url: "<?php echo e(Route('cart.editCart')); ?>",
				type: 'POST',
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				dataType: "json",
				contentType: "application/json",
				
				//будем передавать в параметрах запроса id выбранных товаров чтобы добавить их в корзину
			    //эти параметры будут доступны в контроллере который будет обрабатывать этот запрос
			    //stringify - принимает объект js (ассоциативный массив)
				data: JSON.stringify({ 
					id    : product_obj.id ,
					count : product_obj.count
				}),
								
				success:(data) => {
					console.log(data);

					if(data.result == 'success'){
						//console.log(data['request']['count'])
						//меняем конечную цену по полученному от сервера значению
						$('div[data-total_price]').html(makeMoney(data['cart']))

						//передаем общее число товаров в header 
						$('#count_products_in_cart').text(data['count']);
						//console.log(price_old_value)
						
						//меняем общую цену 1го товара
						price_old.text(makeMoney(data['price']));

						$(`.product_quantity.clearfix[data-response="${id_product}"]`).css('border','2px solid #d0d0d0');
						$(`.response_${id_product}`).removeClass( "alert alert-danger" ).text(''); 
	
					}
				},
				error: function (data) {
				    //console.log(data['responseJSON']['errors']['count']);
				    //console.log(data)
				   	if( data.status === 422 ) {
			            let errors = $.parseJSON(data.responseText);
			            console.log(errors)
			            let message_errors = data.responseJSON.errors.count;
			            $(`.product_quantity.clearfix[data-response="${id_product}"]`).css('border','1px solid red');
			            $(`.response_${id_product}`).addClass("alert alert-danger").text(message_errors);   
			        }
				},
			});	
		});	








		// СКРИПТ ДЛЯ УДАЛЕНИЯ ЭЛЕМЕНТА ИЗ КОРЗИНЫ
		$('.cart_item_edit[data-delete]').click(function(e){
			e.preventDefault();

			let id_product = $(this).data('delete');
			//console.log(id_product)

			let id_product_obj = { 
				"id" : parseInt(id_product) ,
			};

			$.ajax({
				url: "<?php echo e(Route('cart.delElemCart')); ?>",
				type: 'POST',
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				dataType: "json",
				contentType: "application/json",
				
				//будем передавать в параметрах запроса id выбранных товаров чтобы добавить их в корзину
			    //эти параметры будут доступны в контроллере который будет обрабатывать этот запрос
			    //stringify - принимает объект js (ассоциативный массив)
				data: JSON.stringify({ 
					id : id_product_obj.id
				}),
					
				
				success:(data) => {
					console.log(data)

					if(data.result == 'success'){

						//удаляем со страницы позицию в корзине по полученному от сервера id продукта
						$(`div[data-idproduct=${data['id']}]`).remove();

						//меняем конечную цену по полученному от сервера значению
						$('div[data-total_price]').html(makeMoney(data['cart']))

						//передаем общее число товаров в header 
						$('#count_products_in_cart').text(data['count']);
					}
				}
			});
		});








		// СКРИПТ ДЛЯ ОТЧИСТКИ КОРЗИНЫ
		$('.button.clear_cart_button').click(function(e){
			e.preventDefault();

			$.ajax({
				url: "<?php echo e(Route('cart.clearCart')); ?>",
				type: 'POST',
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
					
				success:(data) => {
					console.log(data);
					if(data.result == 'success'){

						//удаляем html элемент товара со страницы
						$('div[data-idproduct]').remove();

						//меняем конечную цену на ноль
						$('div[data-total_price]').text('$ 0');

						//меняем кол-во продуктов на ноль
						$('#count_products_in_cart').text('0');
					}
				}
			});
		});	
	});
	
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\localhost\shop\resources\views/cart/cart.blade.php ENDPATH**/ ?>