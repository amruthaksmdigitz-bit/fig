<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::create('protection_product_map', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('product_id');
    $table->unsignedBigInteger('protection_plan_id');
    $table->string('vehicle_number')->nullable();
    $table->timestamps();

    // Use the correct table name, probably "products"
    $table->foreign('product_id')
          ->references('id')
          ->on('products') // <---- check your actual table name here
          ->onDelete('cascade');

    $table->foreign('protection_plan_id')
          ->references('id')
          ->on('protection_plans')
          ->onDelete('cascade');
});

}


/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
Schema::dropIfExists('protection_product_map');
}
};