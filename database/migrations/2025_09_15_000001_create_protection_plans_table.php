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
Schema::create('protection_plans', function (Blueprint $table) {
$table->id();
$table->string('name')->nullable(); // optional plan name/label
$table->date('purchase_date')->nullable();
$table->date('expiry_date')->nullable();
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
Schema::dropIfExists('protection_plans');
}
};