<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->text('image')->nullable()->change();
            $table->text('attachment')->nullable()->change();
            $table->text('video')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->text('description')->change();
            $table->text('image')->change();
            $table->text('attachment')->change();
            $table->text('video')->change();
        });
    }
}
