<?php
/**
 * Created by Thiago Alencar.
 * User: thiagoalencar
 * Date: 08/04/17
 * Time: 11:56
 */

namespace Thinkific\Models;


class Module extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'title',
    ];
}