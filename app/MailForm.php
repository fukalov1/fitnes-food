<?php

namespace App;
use App\Page;
use App\MailFormField;
use Illuminate\Database\Eloquent\Model;

class MailForm extends Model
{

    protected $table = 'mailforms';

    public function fields()
    {
        return $this->hasMany(MailFormField::class,'mailform_id');
    }

    public function page()
    {
        return$this->belongsTo(Page::class);
    }


}
