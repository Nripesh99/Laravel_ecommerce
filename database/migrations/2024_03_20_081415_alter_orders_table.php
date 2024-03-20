<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('product_id', 'total');
        });
        //changing column name from product_id to total

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
