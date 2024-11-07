<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinsTable extends Migration
{
    public function up()
    {
        Schema::create('wins', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->boolean('is_win');
            $table->decimal('risk', 8, 2);
            $table->decimal('risk_reward_ratio', 8, 2);
            $table->string('hour_session');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Add the user_id column as a foreign key
            $table->timestamps(); // This will add 'created_at' and 'updated_at' columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('wins');
    }
}
