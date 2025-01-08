<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {

    public function up(): void
    {
        Schema::create('TBUSUARIOCODIGOS', function (Blueprint $table): void {
            $table->unsignedBigInteger('USUCODID', true);
            $table->uuid('USUUID');
            $table->string('USUCODCODIGO', 6);
            App\Helpers\Utils::generateHistoryColumnsOnMigration('USUCOD', $table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('TBUSUARIOCODIGOS');
    }
};
