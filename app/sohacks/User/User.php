<?php

namespace sohacks\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
	protected $table = 'users';

	protected $fillable = [
		'email', 
		'username',
		'password',
		'first_name',
		'last_name',
		'active',
		'active_hash',
		'recover_hash',
		'remember_identifier',
		'remember_token',
		'address',
		'city',
		'state',
		'zip',
		'school',
		'age',
		'gender',
		'grade',
		'tshirt',
		'sohacks',
		'hack',
		'prog',
		'lang1',
		'lang2',
		'lang3',
		'langs',
		'proj',
		'team',
		'travel',
		'phone',
		'is_submitted',
		'status',
		'role',
		'allergies',
		'race',
		'invited',
		'is_notified',
		'is_attending',
		'is_team',
		'profpic',
		'signature_id',
		'is_signed',
		'sent_signature',
		'laptop',
		'eventphone',
		'times',
		'is_here'
	];

	public function getFullName() {
		if (!$this->first_name || !$this->last_name) {
			return null;
		}
		return "{$this->first_name} {$this->last_name}";
	}
	public function getEmail() {
		return $this->email;
	}

	public function getFullNameOrUsername() {
		return $this->getFullName() ?: $this->username;
	}
	public function activateAccount() {
		$this->update([
			'active' => true,
			'active_hash' => null
		]);
	}
	public function getAvatarUrl($options = []) {
		if($this->profpic == NULL) {
			return '/styles/img/default.png';
		}
		else {
			return '/register/uploads/' . $this->profpic ;
		}
	}
	public function updateRememberCredentials($identifier, $token)
	{
		$this->update([
			'remember_identifier' =>$identifier,
			'remember_token' =>$token,
		]);
	}
	public function removeRememberCredentials() 
	{
		$this->updateRememberCredentials(null,null);
	}

	public function hasPermission($permission) 
	{
		return (bool) $this->permissions->{$permission};
	}
	public function isAdmin() 
	{
		return $this->hasPermission('is_admin');
	}
	public function isAccepted() 
	{
		return $this->hasPermission('is_accepted');
	}
	public function AcceptedID() 
	{
		return $this->hasOne('sohacks\User\UserPermission', 'user_id')->where('is_accepted',true)->get();
	}
	public function isDecided() 
	{
		return $this->hasPermission('is_decided');
	}
	public function isActive() 
	{
		return (bool) $this->active;
	}
	public function permissions() 
	{
		return $this->hasOne('sohacks\User\UserPermission', 'user_id');

	}

}