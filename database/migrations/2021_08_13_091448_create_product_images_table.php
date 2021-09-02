<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //в этой таблице будут хранится картинки от конкретного продукта , картинки будут связываться н нужным продуктом по полю product_id которое будет внешним ключем
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('img')->nullable();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');//onDelete('cascade') - чтобы при удалении товара записи в таблице с картинками тоже удалялись (те у которых поле "product_id" совпадет с id удаленногго товара)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
