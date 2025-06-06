<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->uuid('user_id')->index()->nullable();
            $table->uuidMorphs('commentable');
            $table->longText('content');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
