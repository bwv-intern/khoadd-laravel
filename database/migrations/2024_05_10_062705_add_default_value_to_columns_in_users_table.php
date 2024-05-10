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
            Schema::table('users', function (Blueprint $table) {
                $table->text('image_path')->default('')->change();
                $table->text('randomly_generated_words')->default('')->change();
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
        // do nothing here, intentional
    }
};
