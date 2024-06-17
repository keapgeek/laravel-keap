<?php

namespace KeapGeek\Keap\Tests\Classes;

use Illuminate\Database\Eloquent\Model;
use KeapGeek\Keap\Traits\KeapTrait;

class Contact extends Model
{
    use KeapTrait;

    protected $guarded = '';

    public $timestamps = false;

    protected $table = 'contacts';
}
