<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveServiceIdAddEcnonomicSectorIdToCreditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('creditors', function (Blueprint $table) {
            $table->dropForeign('creditors_service_id_foreign');
            $table->dropColumn('service_id');
            $table->dropColumn('economic_sector_invest');
            $table->bigInteger('economic_sector_id')->unsigned()->after('user_id');
            $table->foreign('economic_sector_id')->references('id')->on('economic_sectors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creditors', function (Blueprint $table) {
            $table->dropForeign('creditors_economic_sector_id_foreign');
            $table->dropColumn('economic_sector_id');
            $table->bigInteger('service_id')->unsigned()->after('user_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->string('economic_setor_invest')->after('service_id');
        });
    }
}
