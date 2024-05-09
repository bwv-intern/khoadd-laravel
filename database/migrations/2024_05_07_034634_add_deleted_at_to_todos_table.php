<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\{DB, Schema};

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        DB::beginTransaction();
        try {
            Schema::table('todos', function (Blueprint $table) {
                $table->softDeletes();
            });
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            error_log($e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        DB::beginTransaction();
        try {
            Schema::table('todos', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            error_log($e->getMessage());
        }
    }
};
