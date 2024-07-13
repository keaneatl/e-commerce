<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::get("id")->where("id", 1)->firstOrFail()->assignRole("Admin");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::get("id")->where("id", 1)->removeRole("Admin");
    }
};
