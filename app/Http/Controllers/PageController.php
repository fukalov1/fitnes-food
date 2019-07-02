<?php

namespace App\Http\Controllers;
use Mail;
use App\Page;
use App\PageBlock;

class PageController extends Controller
{
    public $bread_crubs;

    public function __construct(Page $page, PageBlock $pageBlock)
    {
        $this->page = $page;
        $this->pageBlock = $pageBlock;

//        $this->mailForm = $mailForm;
    }

    public function show(Page $page)
    {
        $template = 'page';
        $data = ['data' => $page];
        // Если главная страница
        if ($page->id == 4) {
            $template = 'main';
            $data = [
                'data' => $page
            ];
        }

        $this->getBeadCrumbs($page->id);
        $data['pages'] = $this->page->getMenu();
        $data['page_blocks'] = $this->pageBlock->where('page_id', $page->id)->orderBy('orders')->get();

//        dd($page->getMenu());
//dd($template, $page->id,$data);
        return view($template, $data);
    }

    private function getBeadCrumbs($id)
    {
        $page = Page::find($id);
        $this->bread_crubs = " <a href='/{$page->url}'>".preg_replace('/\<br\/\>/','',$page->name)."</a> / ".$this->bread_crubs;

        if ($page->parent_id>0) {
            $this->getBeadCrumbs($page->parent_id);
        }
    }

//    public function sendFormData($id)
//    {
//        if ($id) {
//
//            $mailform = MailForm::find($id);
//
//            $data = [
//                'email' => request('email'),
//                'name' => request('name'),
//                'phone' => request('phone'),
//                'message' => request('message'.$id),
//                'to' => $mailform->sender
//            ];
//
//            Mail::send('emails.sendform', ['data' => $data], function ($m) use ($data) {
//                $m->from(env('MAIL_USERNAME'), 'Центр трудовых ресурсов Тольятти');
//
//                $m->to($data['to'], 'admin')->subject('Обратная связь');
//            });
//            $data = ['result' => 'Спасибо за Ваше обращение. <br/><br/>Сообщение успешно отправлено администратору.<br/><br/> В ближайшее время Вы получите ответ.'];
//        }
//        else {
//            $data = ['result' => 'Данные не приняты'];
//        }
//        return json_encode($data);
//    }


}
