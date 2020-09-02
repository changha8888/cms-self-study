<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Posts
 * @package App\Models
 * @version September 2, 2020, 1:10 pm UTC
 *
 * @property integer $user_id
 * @property string $title
 * @property string $body
 * @property string $image
 */
class Posts extends Model
{
    use SoftDeletes;

    public $table = 'posts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'title',
        'body',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'title' => 'string',
        'body' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'title' => 'required|max:250',
        'body' => 'required'
    ];

    public static $rules_update = [
        'user_id' => 'required',
        'title' => 'required|max:250',
        'body' => 'required'
    ];

    

    
}
