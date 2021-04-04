<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RequestStageMapping
 * 
 * @property int $request_stage_mapping_id
 * @property int $request_id
 * @property int $stage_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Request $request
 * @property Stage $stage
 *
 * @package App\Models
 */
class RequestStageMapping extends Model
{
	use HasFactory;

	protected $table = 'request_stage_mapping';
	protected $primaryKey = 'request_stage_mapping_id';

	protected $casts = [
		'request_id' => 'int',
		'stage_id' => 'int'
	];

	protected $fillable = [
		'request_id',
		'stage_id'
	];

	public function request()
	{
		return $this->belongsTo(Request::class, 'request_id');
	}

	public function stage()
	{
		return $this->belongsTo(Stage::class, 'stage_id');
	}
}
