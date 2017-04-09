<?php
/**
 * Created by PhpStorm.
 * User: thiagoalencar
 * Date: 08/04/17
 * Time: 22:34
 */

namespace Thinkific\Models;
use \Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';
    protected $fillable = [
        'email',
        'name',
        'lastname'
    ];

}