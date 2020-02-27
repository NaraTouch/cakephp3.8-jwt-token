<?php
namespace App\Model\Table;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{

	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->setTable('users');
		$this->setDisplayField('name');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('Roles', [
			'foreignKey' => 'role_id',
			'joinType' => 'INNER',
		]);
	}

	public function validationDefault(Validator $validator)
	{
		$validator
			->nonNegativeInteger('id')
			->allowEmptyString('id', null, 'create');

		$validator
			->scalar('name')
			->maxLength('name', 255)
			->allowEmptyString('name');

		$validator
			->email('email')
			->notEmptyString('email');

		$validator
			->scalar('password')
			->maxLength('password', 255)
			->notEmptyString('password');

		$validator
			->boolean('active')
			->allowEmptyString('active');

		return $validator;
	}

	public function buildRules(RulesChecker $rules)
	{
		$rules->add($rules->isUnique(['email']));
		$rules->add($rules->existsIn(['role_id'], 'Roles'));

		return $rules;
	}
}
