<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->text('concept');

            $table->text('type_currency'); //tipo de moneda
            $table->decimal('amount', 8, 2);
            $table->decimal('penality', 8, 2)->nullable();
            $table->decimal('amount_payable', 8, 2);

            $table->text('observations');
            $table->string('month',30);
            $table->string('year',10);

            $table->enum('status', ['anulado','activo','modificado'])->default('activo');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('contract_type_id');
            $table->unsignedBigInteger('document_type_id');
            $table->unsignedBigInteger('provider_id');

            $table->foreign('user_id')
            ->references('id')
            ->on('users');

            $table->foreign('area_id')
            ->references('id')
            ->on('areas');


            $table->foreign('contract_type_id')
            ->references('id')
            ->on('contract_types');


            $table->foreign('provider_id')
            ->references('id')
            ->on('providers');

            $table->foreign('document_type_id')
            ->references('id')
            ->on('document_types');

            $table->timestamps();

            //PENDIENTE TERMINAR CON LA MIGRACION DE LOS HISTORIALES
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
