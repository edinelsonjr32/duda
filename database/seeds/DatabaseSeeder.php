<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_user')->insert(
            [
                'nome' => 'Administrador',
                'status'  => true
                ]
            );

            DB::table('tipo_user')->insert(
                [
                    'nome' => 'Corretor',
                    'status'  => true
                ]
            );

            DB::table('tipo_user')->insert(
                [
                    'nome' => 'Financeiro',
                    'status'  => true
                ]
            );
        DB::table('tipo_user')->insert(
            [
                'nome' => 'Administrativo',
                'status'  => true
            ]
        );

            DB::table('users')->insert(
                [
                    'name' => 'Edinelson Luis de Sousa Junior',
                    'email' => 'edinelsonjr.ufopa@gmail.com',
                    'password' => bcrypt('123456'),
                    'tipo_user_id' => 1,
                    'apelido' => 'edinelson',
                    'image' => null,
                    'status' => true,
                ]
            );
        DB::table('users')->insert(
            [
                'name' => 'Kassia',
                'email' => 'kassia@duda.com',
                'password' => bcrypt('12345678'),
                'tipo_user_id' => 1,
                'apelido' => 'Kassia',
                'image' => null,
                'creci' => null,
                'status' => true,
            ]
        );
        DB::table('tipo_imovel')->insert(
            [
                'nome' => 'Apartamento'
            ]
        );

        DB::table('tipo_imovel')->insert(
            [
                'nome' => 'Casa'
            ]
        );

        DB::table('tipo_imovel')->insert(
            [
                'nome' => 'Terreno'
            ]
        );

        DB::table('tipo_imovel')->insert(
            [
                'nome' => 'Sala Comercial'
            ]
        );

        DB::table('tipo_imovel')->insert(
            [
                'nome' => 'Prédio'
            ]
        );

        DB::table('tipo_imovel')->insert(
            [
                'nome' => 'Galpão'
            ]
        );
        DB::table('tipo_imovel')->insert(
            [
                'nome' => 'Chácara'
            ]
        );
        DB::table('tipo_proprietario')->insert(
            [
                'nome' => 'Pessoa Física'
            ]
        );
        DB::table('tipo_proprietario')->insert(
            [
                'nome' => 'Pessoa Jurídica'
            ]
        );
    }
}
