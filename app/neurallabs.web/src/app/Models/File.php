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
 * Class File
 * 
 * @property int $file_id
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Request[] $requests
 *
 * @package App\Models
 */
class File extends Model
{
	use HasFactory;

	protected $table = 'files';
	protected $primaryKey = 'file_id';

	protected $fillable = [
		'path'
	];

	public function requests()
	{
		return $this->hasMany(Request::class, 'file_id');
	}
}
