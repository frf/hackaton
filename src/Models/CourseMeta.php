<?php
/**
 * Created by Thiago Alencar.
 * User: thiagoalencar
 * Date: 08/04/17
 * Time: 22:34
 */

namespace Thinkific\Models;
use \Illuminate\Database\Eloquent\Model;

class CourseMeta extends Model
{
    protected $table = 'course_meta';
    protected $fillable = [
        'course_id',
        'module_id',
        'value',
        'key'
    ];

}