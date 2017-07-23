<?php

/*
 * This file is part of Laravel Addressable.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('model');
            $table->unsignedInteger('country_id');
            $table->string('role')->default('main');
            $table->string('organization')->nullable();
            $table->string('name_prefix')->nullable();
            $table->string('name_suffix')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('street');
            $table->string('building_number')->nullable();
            $table->string('building_flat')->nullable();
            $table->string('city');
            $table->string('city_prefix')->nullable();
            $table->string('city_suffix')->nullable();
            $table->string('state')->nullable();
            $table->string('state_code')->nullable();
            $table->string('postcode');
            $table->string('phone')->nullable();
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            $table->timestamps();

            $table->unique(['model_id', 'model_type', 'role']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
