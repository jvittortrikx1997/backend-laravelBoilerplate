<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('TBUSUARIOS', function (Blueprint $table): void {
            $table->uuid('USUUID')->primary();
            $table->string('USUNOME', 200);
            $table->string('USUEMAIL', 200)->unique();
            $table->string('USUCPF', 14)->unique()->nullable();
            $table->string('USUDOC', 100)->nullable();
            $table->string('USUCEP', 9);
            $table->string('USUENDERECO', 200);
            $table->string('USUNUMERO', 20)->nullable();
            $table->string('USUCOMPLEMENTO', 200)->nullable();
            $table->string('USUBAIRRO', 100);
            $table->string('USUFONE', 20);
            $table->string('USUCIDADE', 200);
            $table->string('USUCODIBGE', 7);
            $table->string('USUUF', 2);
            $table->string('USUSENHA');
            $table->string('USUIMGPATH')->nullable();
            \App\Helpers\Utils::generateHistoryColumnsOnMigration('USU', $table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('TBUSUARIOS');
    }
};
