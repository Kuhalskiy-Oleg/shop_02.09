
<div class="product_grid">
	
	<?php $__currentLoopData = $response['products_from_category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

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
				<div class="addCart" data-idproduct="<?php echo e($product->id); ?>"  onclick="addItemInCart('<?php echo e($product->id); ?>')">
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

</div>


<div id="pagination_link" style="display: flex;justify-content: center;width: 100%;">
	<?php echo e($response['pagination']); ?>

</div>



<?php /**PATH C:\OpenServer\domains\localhost\shop\resources\views/ajax/ajax_paginate_show_category.blade.php ENDPATH**/ ?>