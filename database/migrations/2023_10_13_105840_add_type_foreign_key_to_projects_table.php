<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('slug'); //perchè esiste già tabella projects
            $table->foreign('type_id') //rendo user_id una foreign key
            ->references('id')//fa riferimento alla colonna id
            ->on("types") //fa riferimento tabella types
            ->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_type_id_foreign'); //rimuovo foreign
            $table->dropColumn('type_id'); //rimuovo colonna
        });
    }
};
