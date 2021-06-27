<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestReportItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_report_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_id');
            // $table->integer('test_id');
            $table->string('title');
            $table->string('normalRange');
            // $table->integer('finalNormalValue');
            $table->integer('firstCriticalValue');
            $table->integer('finalCriticalValue');
            $table->string('unit');
            $table->string('status')->default("active");
            $table->timestamps();

            $table->foreign('test_id')->references('id')->on('available_tests')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_report_items');
    }
}
