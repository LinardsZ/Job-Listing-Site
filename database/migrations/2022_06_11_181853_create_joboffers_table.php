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
        Schema::create('joboffers', function (Blueprint $table) {
            $table->id('offerid');
            $table->integer('companyid')->constrained('companies');
            $table->string('position', 40);
            $table->string('category', 30);
            $table->string('workload', 30);
            $table->integer('salary')->nullable();
            $table->date('posted_at');
            $table->string('location', 40);
            $table->string('extra_info', 50);
            $table->text('description');
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
        Schema::dropIfExists('joboffers');
    }
};
