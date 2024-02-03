<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('wallet_id')->nullable();
            // $table->foreign('wallet_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('set null');     
            $table->string('address');

            $table->string('blockNumber');
            $table->string('timeStamp');
            $table->string('hash');
            $table->string('nonce');
            $table->string('blockHash');
            $table->string('transactionIndex');
            $table->string('from');
            $table->string('to');
            $table->string('value');
            $table->string('gas')->nullable();
            $table->string('gasPrice')->nullable();
            $table->string('isError')->nullable();
            $table->string('txreceipt_status')->nullable();
            $table->text('input')->nullable();
            $table->string('contractAddress')->nullable();
            $table->string('cumulativeGasUsed')->nullable();
            $table->string('gasUsed')->nullable();
            $table->string('confirmations')->nullable();
            $table->string('methodId')->nullable();
            $table->string('functionName')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
