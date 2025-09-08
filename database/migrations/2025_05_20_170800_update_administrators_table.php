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
        Schema::table('administrators', function (Blueprint $table) {
            $table->unsignedBigInteger('staff_role_id')->nullable()->after('parent_id');

            // Add foreign key constraint
            $table->foreign('staff_role_id')
                ->references('id')
                ->on('staff_roles')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('administrators', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['staff_role_id']);
            
            // Then drop the column
            $table->dropColumn('staff_role_id');
        });
    }
};