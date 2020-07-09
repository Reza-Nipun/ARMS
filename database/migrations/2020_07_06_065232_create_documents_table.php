<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name')->nullable();
            $table->foreignId('service_type_id');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_no')->nullable();
            $table->foreignId('unit_id');
            $table->foreignId('department_id');
            $table->string('user')->nullable();
            $table->string('original_placement_location')->nullable();
            $table->string('original_document_location')->nullable();
            $table->date('last_renewal_date');
            $table->date('next_renewal_date');
            $table->text('vendor')->nullable();
            $table->float('amount', 8, 2);
            $table->mediumText('remarks')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
