<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Caffeinated\Shinobi\Models\Role::create(['name' => 'Administrador', 'slug' => 'admin', 'description' => 'rol usuario admin']);
        Caffeinated\Shinobi\Models\Role::create(['name' => 'Gobierno', 'slug' => 'gob', 'description' => 'rol usuario gobierno']);
        Caffeinated\Shinobi\Models\Role::create(['name' => 'Usuario', 'slug' => 'usuario', 'description' => 'rol usuario común']);

        $admin = App\User::create([
            'rut' => '12.345.678-9',
            'password' => '$2y$10$y8U22b/Cqb2zren2oCGNdO01k2SM9tW3YwmYePC/TW/XzXqoOHgIK',
            'nombre' => 'Administrador',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'fecha_nacimiento' => '01-01-2000',
            'correo' => 'admin@admin.cl',
            'telefono' => '99999999'
        ]);
        $admin->assignRole(1);
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_user');
    }
}
