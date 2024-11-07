<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToWinsTable extends Migration
{
    public function up()
    {
        Schema::table('wins', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id'); // Add user_id column

            // If you want to add a foreign key constraint to ensure that the user_id matches a valid user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('wins', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Remove foreign key constraint
            $table->dropColumn('user_id'); // Remove the user_id column
        });
    }
}
