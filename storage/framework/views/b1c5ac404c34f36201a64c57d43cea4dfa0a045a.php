
<div class="product_pagination" style="display: flex;justify-content: center;">
	<ul class="pagination">

		<style type="text/css">
			
			.product_pagination ul li:not(:last-child)
			{
				margin-right: 10px!important;
			}
			li span,li a{
				font-size: 20px!important;
			}
			li.active span{
				color: red!important;
			}


		</style>

		<!-- previus -->
		<?php if($paginator->onFirstPage()): ?>
			<li class="disabled"><span>&laquo;</span></li>
		<?php else: ?> 
			<li><a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">&laquo;</a></li>
		<?php endif; ?>


		<!-- pagination number page -->
		<?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<!-- three dots -->
			<?php if(is_string($element)): ?>
				<li class="disabled"><span><?php echo e($element); ?></span></li>
			<?php endif; ?>

			<!-- number page -->
			<?php if(is_array($element)): ?>
				<?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($page == $paginator->currentPage()): ?>
						<li class="active"><span><?php echo e($page); ?></span></li>
					<?php else: ?> 
						<li><a data-paginate href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


		<!-- next -->
		<?php if($paginator->hasMorePages()): ?>
			<li><a data-paginate href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">&raquo;</a></li>
		<?php else: ?> 
			<li class="disabled"><span>&raquo;</span></li>
		<?php endif; ?>

	</ul>
</div>

<?php /**PATH C:\OpenServer\domains\Larawel-create-shop\shop\resources\views/pagination/pagination.blade.php ENDPATH**/ ?>