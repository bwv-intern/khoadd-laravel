<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::beginTransaction();
        try {
            Schema::create('todos', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->foreignId('userId');
                $table->text('todoText');
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
    public function down(): void
    {
        DB::beginTransaction();
        try {
            Schema::dropIfExists('todos');
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            error_log($e->getMessage());
        }
    }
};
