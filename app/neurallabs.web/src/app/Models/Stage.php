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
 * Class Stage
 * 
 * @property int $stage_id
 * @property string $stage
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Request[] $requests
 *
 * @package App\Models
 */
class Stage extends Model
{
	use HasFactory;
	
	protected $table = 'stages';
	protected $primaryKey = 'stage_id';

	protected $fillable = [
		'stage'
	];

	public function requests()
	{
		return $this->belongsToMany(Request::class, 'request_stage_mapping', 'stage_id', 'request_id')
					->withTimestamps();
	}
}
