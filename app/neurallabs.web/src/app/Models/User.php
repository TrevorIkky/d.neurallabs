<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * 
 * @property int $user_id
 * @property int $role_id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $telephone
 * @property bool $suspended
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Role $role
 * @property Collection|Request[] $requests
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens, Notifiable, HasFactory;

	protected $table = 'users';
	protected $primaryKey = 'user_id';

	protected $casts = [
		'role_id' => 'int',
		'suspended' => 'bool'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'role_id',
		'name',
		'email',
		'email_verified_at',
		'password',
		'telephone',
		'suspended',
		'remember_token'
	];


	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->toDayDateTimeString();
	}

	public function getUpdatedAtAttribute($value)
	{
		return Carbon::parse($value)->toDayDateTimeString();
	}

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function requests()
	{
		return $this->hasMany(Request::class, 'user_id');
	}

	public function isAdministrator()
	{
		return $this->role_id == 1;
	}

	public function isApiConsumer()
	{
		return $this->role_id == 2;
	}
}
