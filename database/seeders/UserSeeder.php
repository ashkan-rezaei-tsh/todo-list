<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'اشکان رضایی',
                'email' => 'ashkan.rezaei.tsh@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'مهسا مومن زاده',
                'email' => 'm.momenzadeh1999@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'محمد صادق محمدی فر',
                'email' => 's.mohamadifar1372@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'علیرضا طیبی نژاد',
                'email' => 'alirezatayebinejad@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'احمد شعاع حقیقی',
                'email' => 'a.shoaahaghighi@gmail.com',
                'password' => Hash::make('12345678')
            ],
            [
                'name' => 'نگین خادمیان',
                'email' => 'neginkhademian@gmail.com',
                'password' => Hash::make('12345678')
            ],
        ];

        foreach ($users as $user) {
            User::query()->create($user);
        }

        $this->command->info('Users added successfully!');
    }
}
