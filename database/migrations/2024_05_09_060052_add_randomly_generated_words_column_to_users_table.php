<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::beginTransaction();
        try {
            Schema::table('users', function (Blueprint $table) {
                $table->text('randomly_generated_words');
            });
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            error_log($e->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::beginTransaction();
        try {
            Schema::table('todos', function (Blueprint $table) {
                $table->dropColumn('randomly_generated_words');
            });
            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            error_log($e->getMessage());
        }
    }
};
