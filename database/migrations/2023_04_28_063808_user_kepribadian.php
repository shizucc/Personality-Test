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
        Schema::create('user_kepribadian', function (Blueprint $table) {
            $table->primary(['user_id','diagnosa_id','kepribadian_id']);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('diagnosa_id')->unsigned();
            $table->bigInteger('kepribadian_id')->unsigned()->nullable();
            $table->float('persentase');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('kepribadian_id')->references('id')->on('kepribadians')->cascadeOnDelete();
            $table->timestamp('waktu_diagnosa', $precision=0);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_kepribadian');
    }
};
