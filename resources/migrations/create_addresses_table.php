<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAddressesTable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class CreateAddressesTable extends Migration
{
    /**
     *
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('addressable');
            $table->integer('country_id')->unsigned()->index();
            $table->string('organization')->nullable();
            $table->string('name_prefix');
            $table->string('name_suffix')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('street');
            $table->string('building_number');
            $table->string('building_flat')->nullable();
            $table->string('city');
            $table->string('city_prefix')->nullable();
            $table->string('city_suffix')->nullable();
            $table->string('state');
            $table->string('state_code')->nullable();
            $table->string('postcode');
            $table->string('phone')->nullable();
            $table->float('lat')->nullable();
            $table->float('lng')->nullable();
            foreach (config('addressable.flags', []) as $flag) {
                $table->boolean('is_'.$flag)->default(false)->index();
            }
            $table->timestamps();
        });
    }

    /**
     *
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
