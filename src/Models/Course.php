<?php
/**
 * Created by PhpStorm.
 * User: thiagoalencar
 * Date: 08/04/17
 * Time: 11:53
 */

namespace Thinkific\Models;

use \Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'user_id',
        'title',
        'module_id',
    ];
}