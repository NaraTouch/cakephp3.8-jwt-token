<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;

class Role extends Entity
{

	protected $_accessible = [
		'display_name' => true,
		'name' => true,
		'users' => true,
	];
}
