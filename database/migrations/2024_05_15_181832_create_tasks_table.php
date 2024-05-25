<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('statu_id')->references('id')->on('statuses')->onDelete('cascade'); // Corrected table name to 'statuses'
            $table->string('title');
            $table->text('description');
            $table->date('startDate');
            $table->date('endDate')->nullable();
            $table->date('expectedEndDate');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
