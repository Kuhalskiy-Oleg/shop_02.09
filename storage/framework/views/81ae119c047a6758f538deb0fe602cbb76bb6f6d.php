<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->


<!-- это название страницы будет подгружаться в тег title -->
<?php $__env->startSection('title','Categories'); ?>


<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
<?php $__env->startSection('nav_active_categories','active'); ?>

<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
<?php $__env->startSection('head_link'); ?>
<link rel="stylesheet" type="text/css" href="/styles/bootstrap4/bootstrap.min.css">
<link href="/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="/styles/categories.css">
<link rel="stylesheet" type="text/css" href="/styles/categories_responsive.css">
<link rel="stylesheet" type="text/css" href="/styles/product.css">
<link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Home -->

<div class="home">
	<div class="home_container">
		<div class="home_background" style="background-image:url('<?php echo e($category->img_label); ?>')"></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title"><?php echo e($category->title); ?><span>.</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="products" style="padding: 89px 0 0">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="products_title"><?php echo e($category->title); ?></div>
			</div>
		</div>
	</div>
</div>



<!-- Category -->
<div class="products" style="padding-top: 0;">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="product_grid" style="display: flex;width: 100%;justify-content: center;">


					<!-- если поле img имеет не пустое значение то мы в пременную name_img запишем картинку а если поле img пустое то запишем путь к картинке заглушке -->

					<?php if(!empty($category->img)): ?>
						<?php $name_img = $category->img; ?>						
					<?php else: ?>
						<?php $name_img = '/images/not_file.png'; ?>
					<?php endif; ?>
							
					<!-- Category -->
					<style>
						#product_id{
							position: static!important;
						}
					</style>
					<div id="product_id" class="product">
						<div class="product_image" style="height: 250px;overflow: hidden;display: flex;flex-direction: column;justify-content: center;">
							<img style="object-fit: fill;width: 100%;max-height: 100%;" src="<?php echo e($name_img); ?>" alt="">
						</div>						
					</div>
					<div class="product_content" style="padding-top: 0;text-indent: 30px;padding-left: 10px">
						<span><?php echo e($category->description); ?></span>
					</div>




				</div>
				
					
			</div>
		</div>
	</div>
</div>




<!-- Products -->

<div class="products">
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
					
					<!--$category->product->count() метод count подсчитает сколько всего элементов содержится в объекте  -->
					<div class="results">Showing <span><?php echo e($category->products->count()); ?></span> results</div>
					<div class="sorting_container ml-md-auto">
						<div class="sorting">
							<ul class="item_sorting">
								<li>
									<span class="sorting_text">Sort by</span>
									<i class="fa fa-chevron-down" aria-hidden="true"></i>
									<ul>
										<li class="product_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default</span></li>
										<li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
										<li class="product_sorting_btn" data-isotope-option='{ "sortBy": "stars" }'><span>Name</span></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				
				<div class="product_grid">


					<!-- вытаскиваем те продукты которые принадлежат выбранной категории -->
					<?php $__currentLoopData = $category->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<!-- наполняем переменную которую будем подставлять в тег img в атрибут src -->
					<?php  
						$name_img = '';
						if(count($product->images) > 0){
							//если в таблице product_images есть рядоы у которых поле product_id  соответсвует  продукту (т.е у продукта есть картинки) то в переменную name_img мы запишем значение поля img из таблицы product_images
							$name_img = $product->images[0]->img;
						}else{
							//если в таблице product_images нет рядов у которых поле product_id  соответсвовало бы продукту (т.е у продукта нет картинок) то в переменную name_img мы запишем путь к картинке заглушке
							$name_img = '/images/not_file.png';
						}
					?>


					<!-- Product -->
					<div class="product">
						<div class="product_image" style="height: 250px;overflow: hidden;display: flex;flex-direction: column;justify-content: center;">
							<img style="object-fit: fill;width: 100%;max-height: 100%;" src="<?php echo e($name_img); ?>" alt="">
						</div>
						<div class="product_extra product_new" style="width: 100px;">
							<a href="<?php echo e(Route('showCategory',['slug'=>$product->categories->slug])); ?>"><?php echo e($category->title); ?></a>
						</div>
						<div class="product_content">
							<div class="product_title">
								<a href="<?php echo e(Route('showProduct', ['slug' => $product->slug])); ?>"><?php echo e($product->title); ?></a>
							</div>

							<div class="product_price">$<?php echo e($product->price); ?></div>

						</div>
					</div>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
					<div class="icon_box_image"><img src="/images/icon_1.svg" alt=""></div>
					<div class="icon_box_title">Free Shipping Worldwide</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="/images/icon_2.svg" alt=""></div>
					<div class="icon_box_title">Free Returns</div>
					<div class="icon_box_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
					</div>
				</div>
			</div>

			<!-- Icon Box -->
			<div class="col-lg-4 icon_box_col">
				<div class="icon_box">
					<div class="icon_box_image"><img src="/images/icon_3.svg" alt=""></div>
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
<script src="/js/categories.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OpenServer\domains\Larawel-create-shop\shop\resources\views/categories/category_show.blade.php ENDPATH**/ ?>