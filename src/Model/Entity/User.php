<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;

class User extends Entity
{

	protected $_accessible = [
		'role_id' => true,
		'name' => true,
		'email' => true,
		'password' => true,
		'active' => true,
		'created' => true,
		'modified' => true,
		'role' => true,
	];

	protected $_hidden = [
		'password',
	];
}
