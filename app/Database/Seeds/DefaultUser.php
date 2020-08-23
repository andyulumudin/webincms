<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultUser extends Seeder
{
	public function run()
	{
		//Create Default User
		$pass = 'admin';
		$data = [
			'user_name' => 'Administrator',
			'user_email'    => 'admin@webincms.com',
			'user_account'    => 'admin',
			'user_password'    => password_hash($pass, PASSWORD_BCRYPT),
		];

		// Using Query Builder
		$this->db->table('users')->insert($data);
	}
}
