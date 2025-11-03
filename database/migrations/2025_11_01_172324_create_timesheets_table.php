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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id(); // Auto increment ID
            $table->unsignedBigInteger('user_id'); // ID of the user who logged the timesheet
            $table->string('project_id'); // You can make this foreignId if it links to projects table
            $table->string('staff_id')->nullable(); // You can make this foreignId if it links to users table
            $table->date('entry_date'); // Date field
            $table->decimal('hours_spent', 5, 2)->default(0); // Allows decimals like 0.5 (30 mins)
            $table->text('notes')->nullable(); // Optional notes
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status
            $table->timestamps(); // created_at & updated_at
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timesheets');
    }
};
