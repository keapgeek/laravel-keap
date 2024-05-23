<?php

namespace KeapGeek\Keap\Tests\Classes;

use KeapGeek\Keap\Traits\KeapTrait;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use KeapTrait;

    protected $guarded = '';

    public $timestamps = false;

    protected $table = 'contacts';
}
