<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RepairTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE articles MODIFY COLUMN created_at
    TIMESTAMP DEFAULT \'0000-00-00 00:00:00\'');
        DB::statement('ALTER TABLE articles MODIFY COLUMN updated_at
    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP');

        DB::statement('ALTER TABLE comments MODIFY COLUMN created_at
    TIMESTAMP DEFAULT \'0000-00-00 00:00:00\'');
        DB::statement('ALTER TABLE comments MODIFY COLUMN updated_at
    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP');

        DB::statement('ALTER TABLE tags MODIFY COLUMN created_at
    TIMESTAMP DEFAULT \'0000-00-00 00:00:00\'');
        DB::statement('ALTER TABLE tags MODIFY COLUMN updated_at
    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP');

        DB::statement('ALTER TABLE settings MODIFY COLUMN created_at
    TIMESTAMP DEFAULT \'0000-00-00 00:00:00\'');
        DB::statement('ALTER TABLE settings MODIFY COLUMN updated_at
    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP');

        DB::statement('ALTER TABLE users MODIFY COLUMN created_at
    TIMESTAMP DEFAULT \'0000-00-00 00:00:00\'');
        DB::statement('ALTER TABLE users MODIFY COLUMN updated_at
    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
