<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    protected $table                = 'users';
    protected $associated_tables    = ['activations','throttle'];
    protected $roles                = ['System Administrator'];

    public function run()
    {
        DB::table('role_users')->truncate();
        DB::table($this->table)->truncate();

        foreach ($this->associated_tables as $associated_table)
        {
            DB::table($associated_table)->truncate();
        }

        // create user
        $user = Sentinel::create(
        [
            'first_name'    => config('system.admin_first_name'),
            'last_name'     => config('system.admin_last_name'),
            'email'         => config('system.admin_username'),
            'password'      => config('system.admin_password'),
        ]);

        // activate user
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);

        // assign roles
        foreach ($this->roles as $assign_role)
        {
            $role = Sentinel::findRoleByName($assign_role);
            $role->users()->attach($user);
        }

        try
        {
            DB::statement('ALTER TABLE `role_users` ADD CONSTRAINT `role_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)');
            DB::statement('ALTER TABLE `role_users` ADD CONSTRAINT `role_users_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)');
        }
        catch (PDOException $e) {}
    }
}
