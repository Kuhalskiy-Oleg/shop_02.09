<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->


<!-- это название страницы будет подгружаться в тег title -->
<?php $__env->startSection('title','Products'); ?>

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
<?php $__env->startSection('nav_active_home','active'); ?>


<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
<?php $__env->startSection('head_link'); ?>
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/product.css">
<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/categories.css">
<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	<!-- Home -->
	<?php if($categories->count() > 0): ?>
	<div class="home" style="height: 655px;padding: 0;">
		<div class="home_slider_container">
		
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">

				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
				<!-- Slider Item -->
				<div class="owl-item home_slider_item">
					<div class="home_slider_background" style="background-image:url('<?php echo e($category->img_label); ?>')"></div>
					<div class="home_slider_content_container" style="top: 10%;">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content"  data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
										<div class="home_slider_title"><?php echo e($category->title); ?></div>
										<div class="home_slider_subtitle"><?php echo e($category->announcement); ?></div>
										<div class="button button_light home_button"><a href="<?php echo e(Route('showCategory',['slug'=>$category->slug])); ?>">Show category</a></div>
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
									<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	<div class="products" style="padding-top: 122px;">
		<div class="container">

			<div class="row">
				<div class="col text-center">
					<div class="products_title">Products</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					
					<!-- Product Sorting -->
					<div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">

						<div class="count_products" style="display: flex;flex-direction: column;">
							<div class="results">Total products <span><?php echo e($products_count_all); ?></span></div>
							<div class="results">Showing <span><?php echo e($products->count()); ?></span> results</div>
						</div>

						<div class="sorting_container ml-md-auto">
							<div class="sorting">
								<ul class="item_sorting">
									<li>
										<!-- хоть в поисковой строке и не показывается параметра sortBy и page но они там есть просто скрыты методом appends(request()->query()) -->
										<span class="sorting_text"><?php echo e($_GET['sortBy'] ?? 'Sort by'); ?></span>
										<i class="fa fa-chevron-down" aria-hidden="true"></i>
										<ul>
											<!-- в названии дата атрибута недолжно быть заглавных букв -->
											<li  class="product_sorting_btn" data-sort='Default'>
												<span class="product_sorting_span">Default</span>
											</li>
											<li  class="product_sorting_btn" data-sort='Price_min'>
												<span class="product_sorting_span">Price min</span>
											</li>
											<li  class="product_sorting_btn" data-sort='Price_max'>
												<span class="product_sorting_span">Price max</span>
											</li>
											<li  class="product_sorting_btn" data-sort='Name-A-z'>
												<span class="product_sorting_span">Name A-z</span>
											</li>
											<li class="product_sorting_btn" data-sort='Name-Z-a'>
												<span class="product_sorting_span">Name Z-a</span>
											</li>
										</ul>
										<!-- скрипт для выведения текста в фильтрующий блок при клике на сорт.элемент -->
										<script type="text/javascript">
											$(function(){
												$('.product_sorting_span').click(function(){
													//text - забирает текст из тега
													let value_span = $(this).text();
													$('.sorting_text').html(value_span);
												})
											})
										</script>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">

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
								id    : data_order.id    ,
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

				<div id="products_and_pagination" class="col">

					
					
					<div class="product_grid">

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
									<div class="details_discount">$<?php echo e($product->price); ?></div>
									<div class="product_price">$<?php echo e($product->new_price); ?></div>
								<?php endif; ?>

							</div>
						</div>

						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>

					</div>

					<!-- проверяем является ли переменная products массивом или объектом если да то показываем пагинацию -->
					<?php if($products->count() > 0): ?>
					
					<!-- 
					метод appends добавляет все параметры query из запроса request
					request - это запрос который приходит в контроллер в метод который отвечает за эту страницу
					query - это то что пришло в запросе а именно то что мы указали в параметрах ajax в data(передаваемые данные)
					-->
					<!-- 
					чтобы подгрузились стандартные стили в пагинацию нужно в links прописать "pagination::bootstrap-4" 
					$products->appends(request()->query())->links("pagination::bootstrap-4")
					-->
					<!--
					что загрузить собственные стили для пагинации нужно создать отдельный файл и в links прописать путь к нему
					$products->appends(request()->query())->links("pagination.pagination")
					-->
					<?php echo e($products->appends(request()->query())->links("pagination.pagination_products")); ?>

					<!-- при кастомной пагинации параметры в url строку подгружаются только после перезагрузки страницы и изза этого сортировка рушится . Решение: подгрузить в ссылки с пагинацией нужные параметры url адреса до перезагрузки страницы а именно тогда когда пользователь выбрал вариант сортировки . Делается это после успешного ответа сервера на ajax запрос в функции success.
					после клика на ссылку с пагинацией действие кода по генерации url адресов в атрибуте href у ссылки уже не действует (т.к пользователь не нажимал на элемент сортировки и запрос ajax не отпралялся) и все работает в штатном режиме -->
						

					<?php endif; ?>
					<script type="text/javascript">
						$(function(){
							$('a[data-paginate]').click(function(){
								//text - забирает текст из тега
								//console.log('dddd')
								// let vvalue_span = $(this).text();
								// $('.sorting_text').html(vvalue_span);
							})
						})
					</script>

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
<script src="js/product.js"></script>
<script src="js/custom.js"></script>
<!-- <script src="js/categories.js"></script> -->

<!-- cdn isotope -->
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<!-- cdn imageLoaded -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js" integrity="sha512-S5PZ9GxJZO16tT9r3WJp/Safn31eu8uWrzglMahDT4dsmgqWonRY9grk3j+3tfuPr9WJNsfooOR7Gi7HL5W2jw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>





<!-- СКРИПТ ДЛЯ ПАГИНАЦИИ AJAX -->
<script type="text/javascript">
	$(function(){
		//используем такой вид клика чтобы когда к нам подгрузится через ajax новый контент он был кликабельным
		$(document).on('click', '.pagination li a', function(e){
			e.preventDefault();

			//разбиваем ссылку (на котрую был произведен клик) с url адресом на две части по делителю (page=) и забираем вторую часть строки [1]
			let number_page = $(this).attr('href').split('page=')[1];
			//console.log(number_page)

			//забираем выбранную сортировку продуктов
			let sortBy = $('.sorting_text').text();
			//удаляем пробулы до и после
			sortBy = $.trim(sortBy);
			//при совпадении sortBy с текстом выбора сортировки , который веден пользователям мы будем заменять текст в sortBy на тот текст который отображается в url строке (без пробелов и т.п) 
			if (sortBy == 'Sort by') {
				sortBy = 'Default';
			}else if (sortBy == 'Price min'){
				sortBy = 'Price_min';
			}else if (sortBy == 'Price max'){
				sortBy = 'Price_max';
			}else if (sortBy == 'Name Z-a'){
				sortBy = 'Name-Z-a';
			}else if (sortBy == 'Name A-z'){
				sortBy = 'Name-A-z';
			}

			$.ajax({
				// в url будет название роута отвечающего за эту страницу
				url: "<?php echo e(Route('products')); ?>",

				//методом GET отправялем запрос на адрес url
				type: "GET",

				//data - какие данные будем передавать , в нашем случае у данных будет тип ОБЪЕКТ
				data: {
					//первое что мы должны передать это токен , чтобы обеспечить безопасность отправки данных метом гет пост и т.д . чтобы на каждой странице генерировался такой токен нужно в тег head вставить мето тег <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

					//далее будем отправлять данные на сервер а именно параметры нашей url строки

					sortBy: sortBy,//параметр sortBy будет равен значению выбранной сортирвки
					page: number_page,//параметр page будет равен номеру страницы на которую был произведен клик и на которую пользователь хочет сделать переход
				},

				dataType: "html",//dataType  какого ответа ожидать от сервера ?

				contentType: "text",//contentType- это HTTP- заголовок, отправляемый на сервер, определяющий конкретный формат отправляемых данных.

				//при отправке всех запросов мы должны отправлять X-CSRF-TOKEN заголовки для безопасности
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },

			    //success: (data) => {}  - cтрелочная функция
				success: function(data){
					
					//console.log(data) //в data содержится код страницы ajax_paginate_show_category.blade.php с отсортированными товарами с применением пагинации


					//________________ЕСЛИ МЫ ДОБАВЛЯЕМ ПРАВИЛЬНЫЕ ПАРАМЕТРЫ URL СТРОКИ В ПАРАМЕТР DATA:{} У AJAXA И ИСПОЛЬЗУЕМ appends(request()->query()) ТО ВЫСТРАИВАТЬ САМОМУ URL СТРОКУ НЕТ НЕОБХОДИМОСТИ 


	//_____________________________________________________________________________________________________				
					//добавляем в поисковую url строку параметры чтобы сортировка не сбивалась при перезагрузке страницы (не работет при кастомной пагинации)

					//определяем url строку до знака ?
					let positionParametersUrl = location.pathname.indexOf('?');
					console.log(positionParametersUrl) // = -1
					let url = location.pathname.substring(positionParametersUrl,location.pathname.length);
					console.log(url) // = /category/название категории
					let newUrl = url + '?' ;
					console.log(newUrl) // = /category/название категории?

									
					//!!!!__СОРТИРОВКА НАЧАЛА СОХРАНЯТСЯ (даже ПОСЛЕ ПЕРЕЗАГРУЗКИ СТРАНИЦЫ) КОГДА В ПАРАМЕТРЕ URL СТРОКИ Я УКАЗАЛ ПЕРЕМЕННУЮ sortBy КОТОРАЯ РАВНА ЗНАЧЕНИЮ ЭТОЙ ЖЕ ПЕРЕМЕННОЙ
					//для того чтобы у нас когда мы находимся на странице кроме 1 мы переключаем сортировку чтобы в url строке сохранялась та страница на которой мы находимся мы должны передать номер страницы в url строку
					newUrl += `sortBy=${sortBy}` + `&page=${number_page}`;

					//console.log(newUrl) 
					//записываем новый адрес в адресную строку
					history.pushState({}, '', newUrl);
	//_____________________________________________________________________________________________________					


					//вставляем сгенерированный код с пагинацией и рассортированными продуками из файла ajax_paginate_show_category.blade.php в тег у которого нужно заменить контент
					$('#products_and_pagination').html(data);

					//подключили плагин isotope чтобы правильно сделать рендеринг высоты таваров после того как мы загрузили на страницу код с отсортрованными товарами т.к исходная высота контейнера была одной высоты а вставленный код в тег имеет уже другое кол-во продуктов и высота у контейнера должна динамически поменяться
					$('.product_grid').isotope({
						itemSelector: '.product',
					});

					//подключили плагин imagesLoaded чтобы продукты выстроились как и были до пагинации
					$('.product_grid').imagesLoaded( function(){
						var grid = $('.product_grid').isotope({
							itemSelector: '.product',
							layoutMode: 'fitRows',
							fitRows:{
								gutter: 30
							}
						});
						
					});
				}
			});
		});
	});
</script>




<!-- CКРИПТ ДЛЯ СОРТИРОВКИ AJAX -->
<script type="text/javascript">
	$(function(){

		//при клике на элемент с выбором сортировки
		$('.product_sorting_btn').click(function(){

			// data - забирет значение из дата атрибута а именно из того который указан в скобках('sort')
			let sortBy = $(this).data('sort');
			//console.log(sortBy)

			//забираем значение (номер страницы на которой мы находимся) активного элемента пагинации
			let number_page = $('.pagination li.active span').text();

			$.ajax({
				// в url будет название роута отвечающего за эту страницу
				url: "<?php echo e(Route('products')); ?>",

				//методом GET отправялем запрос на адрес url
				type: "GET",

				//data - какие данные будем передавать , в нашем случае у данных будет тип ОБЪЕКТ
				data: {
					//первое что мы должны передать это токен , чтобы обеспечить безопасность отправки данных метом гет пост и т.д . чтобы на каждой странице генерировался такой токен нужно в тег head вставить мето тег <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

					//далее мы будем отправлять параметры нашей url строки

					sortBy: sortBy,//параметр sortBy будет равен значению выбранной сортирвки
					page: number_page,//параметр page будет равен номеру страницы на которую был произведен клик и на которую пользователь хочет сделать переход
				},

				dataType: "html",//dataType  какого ответа ожидать?

				contentType: "text",//contentType- это HTTP- заголовок, отправляемый на сервер, определяющий конкретный формат отправляемых данных.

				//при отправке всех запросов мы должны отправлять такие заголовки для безопасности
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },

			    //success: (data) => {}  - cтрелочная функция
				success: function(data){
					//console.log(data);



					//________________ЕСЛИ МЫ ДОБАВЛЯЕМ ПРАВИЛЬНЫЕ ПАРАМЕТРЫ URL СТРОКИ В ПАРАМЕТР DATA:{} У AJAXA И ИСПОЛЬЗУЕМ appends(request()->query()) на странице и в контроллере ТО ВЫСТРАИВАТЬ САМОМУ URL СТРОКУ НЕТ НЕОБХОДИМОСТИ (ЕСЛИ ТОЛЬКО НЕОБХОДИМО ПО ЗАДАНИЮ ЗАКАЗЧИКА)

//_____________________________________________________________________________________________________	
					//добавляем в поисковую url строку параметры чтобы сортировка не сбивалась при перезагрузке страницы (не работет при кастомной пагинации)

					//определяем url строку до знака ?
					let positionParametersUrl = location.pathname.indexOf('?');
					//console.log(positionParametersUrl) // = -1
					let url = location.pathname.substring(positionParametersUrl,location.pathname.length);
					//console.log(url) // = /products
					let newUrl = url + '?' ;
					//console.log(newUrl) // = /products?

					//!!!!__СОРТИРОВКА НАЧАЛА СОХРАНЯТСЯ ПОСЛЕ ПЕРЕЗАГРУЗКИ СТРАНИЦЫ КОГДА В ПАРАМЕТРЕ URL СТРОКИ Я УКАЗАЛ ПЕРЕМЕННУЮ sortBy КОТОРАЯ РАВНА ЗНАЧЕНИЮ ЭТОЙ ЖЕ ПЕРЕМЕННОЙ
					//для того чтобы у нас когда мы находимся на странице кроме 1 мы переключаем сортировку чтобы в url строке сохранялась та страница на которой мы находимся мы должны передать номер страницы в url строку
					newUrl += `sortBy=${sortBy}` + `&page=${number_page}`;
					//console.log(newUrl) //products?sortBy=Price_min&page=1
					//записываем новый адрес в адресную строку
					history.pushState({}, '', newUrl);



					//при использовании кастомной пагинации сортировка сбивается когда мы переключаемся по пагинации , чтобы этого небыло мы должны в ссылку href с пагинацией забить нужный url адрес где будет указана сортировка и номер страницы

					//берем все ссылки с пагинацией (тег а)
					let link_paginate_custom = $('a[data-paginate]');
					//если колв-во элементов больше нуля то будем выполнять дальнейший код
				    if (link_paginate_custom.length > 0) {

				        //перебираем массив с сылками
				        for (let index = 0; link_paginate_custom.length > index; index++ ){

				        	
				            //записываем каждый элемент массива в переменную link_paginate_custom_element
				            let link_paginate_custom_element = link_paginate_custom[index];
				            //console.log(link_paginate_custom_element);

				            //записываем url каждой ссылки
				            let href_paginate_custom = $(link_paginate_custom_element).attr('href');
				            //console.log(href_paginate_custom);
				   			
				   			//$(link_paginate_custom_element).attr('href','');
	
				            //Метод split() разбивает объект String на массив строк путём разделения строки указанной подстрокой.
				            //разбиваем ссылку href в том месте где будет знак ? или & начиная от конца строки и забираем с помощью pop последний элемент где будет page=1...
							let last_href_paginate_custom = href_paginate_custom.split(/[$?&]/).pop();
							//console.log(last_href_paginate_custom);

							//console.log(url);      // = /products
							let url_plus = url + '?' ;
							//console.log(url_plus); // = /products?

							
							//console.log(sortBy);
							//создаем нужную ссылку чтобы работала сортировка при кастомной пагинации
							let new_href_link_paginate_custom = url_plus + 'sortBy=' + sortBy + '&' + last_href_paginate_custom;
							//console.log(new_href_link_paginate_custom);


							//разбиваем склеинную href ссылку на слова для отсеивания повторяющихся слов если пользователь много раз наживает на элемент в всплывающем списке сортировки товаров
							new_href_link_paginate_custom = Array.from(new Set(new_href_link_paginate_custom.split(/[&?=]/)));
							//console.log(new_href_link_paginate_custom);

							//добавляем к каждому слову тот символ который удалился когда мы разбивали строку href на слова
							let oneWord   = new_href_link_paginate_custom[0] + '?' ;
							let twoWord   = new_href_link_paginate_custom[1] + '=' ;
							let threeWord = new_href_link_paginate_custom[2] + '&' ;
							let fourWord  = new_href_link_paginate_custom[3] + '=' ;
							let fiveWord  = new_href_link_paginate_custom[4];
							// console.log(oneWord);
							// console.log(twoWord);
							// console.log(threeWord);
							// console.log(fourWord);
							// console.log(fiveWord);


							let list = [];
							//объединяем все слова в массив
							list.push(oneWord, twoWord, threeWord, fourWord, fiveWord );  
							//вытаскиваем все слова из массива и объединяем их без разделителя
							new_href_link_paginate_custom = list.join('');											
							//console.log(new_href_link_paginate_custom);


							//записываем эту ссылку в атрибут href каждой ссылки
							$(link_paginate_custom_element).attr('href',new_href_link_paginate_custom);
							
				        }
 
				    }
					
//_____________________________________________________________________________________________________							

					


					//вставляем сгенерированный код с пагинацией и рассортированными продуками из файла ajax_paginate_show_category.blade.php в тег у которого нужно заменить контент
					$('#products_and_pagination').html(data);

					//подключили плагин isotope чтобы правильно сделать рендеринг высоты таваров после того как мы загрузили на страницу код с отсортрованными товарами т.к исходная высота контейнера была одной высоты а вставленный код в тег имеет уже другое кол-во продуктов и высота у контейнера должна динамически поменяться
					$('.product_grid').isotope({
						itemSelector: '.product',
					});

					//подключили плагин imagesLoaded чтобы продукты выстроились как и были до пагинации
					$('.product_grid').imagesLoaded( function(){
						var grid = $('.product_grid').isotope({
							itemSelector: '.product',
							layoutMode: 'fitRows',
							fitRows:{
								gutter: 30
							}
						});						
					});
				}
			});			
		});	
	});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\Larawel-create-shop\shop\resources\views/product/products.blade.php ENDPATH**/ ?>