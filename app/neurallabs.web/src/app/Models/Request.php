<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Request
 * 
 * @property int $request_id
 * @property int $file_id
 * @property int $user_id
 * @property int $request_result
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property File $file
 * @property User $user
 * @property Collection|Stage[] $stages
 *
 * @package App\Models
 */
class Request extends Model
{
	use HasFactory;

	protected $table = 'requests';
	protected $primaryKey = 'request_id';

	protected $casts = [
		'file_id' => 'int',
		'user_id' => 'int',
		'request_result' => 'int'
	];

	protected $fillable = [
		'file_id',
		'user_id',
		'request_result'
	];

	public function getCreatedAtAttribute($value)
	{
		return Carbon::parse($value)->toDayDateTimeString();
	}

	public function file()
	{
		return $this->belongsTo(File::class, 'file_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function stages()
	{
		return $this->belongsToMany(Stage::class, 'request_stage_mapping', 'request_id', 'stage_id')
					->withTimestamps();
	}
}
