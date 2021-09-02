<!-- название шаблона который будет подключаться в этот файл и в этот шаблон в yield будут подгружаться section -->
@extends('layout.main')

<!-- это название страницы будет подгружаться в тег title -->
@section('title','Categories')

<!-- active будет передаваться в стиль в название навигации чтобы его подсветить -->
@section('nav_active_categories','active')


<!-- этот блок напрвится в шаблон в тег head т.к у каждой страницы будут свои настройки -->
@section('head_link')
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/categories.css">
<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
<link rel="stylesheet" type="text/css" href="/styles/product.css">
<link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
@endsection

@section('content')

<!-- Home -->
<div class="home">
	<div class="home_container">
		<div class="home_background" style="background-image:url(images/contact.jpg)"></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="breadcrumbs">
								<ul>
									<li><a href="{{Route('index')}}">Home</a></li>
									<li>Categories</li>
								</ul>
							</div>
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
				<div class="products_title">Categories</div>
			</div>
		</div>
	</div>
</div>



<!-- Categories -->
<div class="products" style="padding-top: 0;">
	<div class="container">

		

		<div class="row">
			<div class="col">
				<div class="product_grid">

					<!--categories доступна из всех вьюшек т.к она прописана в провайдере  -->
					<!-- зписываем в переменную число 0 но если кол-во категорий не будет равно нулю то мы перезапишем эту переменную и положим в нее число категорий -->
					@php

					$count_categories = 0;
					if(count($categories) != 0){
						$count_categories = count($categories);
					}

					@endphp

					<!-- если переменная с числом категорий не равно 0 то запускаем цикл в котором будут выводится категории -->
					<!-- если поле img имеет не пустое значение то мы в пременную name_img запишем картинку а если поле img пустое то запишем путь к картинке заглушке -->
					@if($count_categories != 0)
					@foreach($categories as $category)
					@if(!empty($category->img))
						@php $name_img = $category->img; @endphp						
					@else
						@php $name_img = 'images/not_file.png'; @endphp
					@endif
							
					<!-- Category -->
					<div class="product">
						<div class="product_image" style="height: 250px;overflow: hidden;display: flex;flex-direction: column;justify-content: center;">
							<img style="object-fit: fill;width: 100%;max-height: 100%;" src="{{$name_img}}" alt="">
						</div>
						<div class="product_content">
							<div class="product_title"><a href="{{Route('showCategory',['slug'=>$category->slug])}}">{{$category->title}}</a></div>
						</div>
					</div>


					@endforeach
					@endif

				</div>
				
					
			</div>
		</div>
	</div>
</div>


@endsection

@section('script_js')
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
<script src="js/categories.js"></script>
<script src="js/contact.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
@endsection