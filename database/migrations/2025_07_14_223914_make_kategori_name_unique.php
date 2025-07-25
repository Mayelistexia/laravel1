<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('categories', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->string('name')->unique()->change();
    });
}

public function down()
{
    Schema::table('categories', function (Illuminate\Database\Schema\Blueprint $table) {
        $table->dropUnique(['name']);
    });

}
};

