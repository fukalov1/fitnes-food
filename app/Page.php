<?php

namespace App;
use App\PageBlock;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    public function sub_pages()
    {
        return $this->hasMany(Page::class,'parent_id','id')->where('order', '>', 0)->orderBy('order');
    }

    public function page_blocks()
    {
        return $this->hasMany(PageBlock::class);
    }

    public function getMenu()
    {
        return Page::where('parent_id', 0)->where('order', '>', 0)->get()->sortBy('order');
    }



}
