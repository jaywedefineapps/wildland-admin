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
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->string('zipcode')->nullable()->change();
            $table->string('relationship_type')->default('parent');
            $table->string('parent_id')->nullable();
            $table->string('relationship_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('relationship_type');
           $table->dropColumn('parent_id');
           $table->dropColumn('relationship_id');
        });
    }
};
