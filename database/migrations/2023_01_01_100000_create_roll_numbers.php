<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roll_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('parent_model', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('roll_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('roll_types');

            // Support string primary key (if any) of the parent model
            $table->string('parent_id', 100)->nullable();

            $table->unsignedBigInteger('next_number');
            $table->timestamps();

            $table->unique([
                'type_id',
                'parent_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roll_numbers');
        Schema::dropIfExists('roll_types');
    }
};
