<?php

namespace App\Http\Controllers;
use Mail;
use App\Good;
use App\Page;

class GoodController extends Controller
{
    public $bread_crubs;

    public function __construct(Good $good, Page $page)
    {
        $this->good = $good;
        $this->page = $page;
//        $this->mailForm = $mailForm;
    }

    public function show(Good $good)
    {

        $template = 'good';
        $data = ['data' => $good];
        $data['pages'] = $this->page->getMenu();

        return view($template, $data);
    }

//    private function getBeadCrumbs($id)
//    {
//        $good = Good::find($id);
//        $this->bread_crubs = " <a href='/{$good->url}'>".preg_replace('/\<br\/\>/','',$good->name)."</a> / ".$this->bread_crubs;
//
//        if ($good->parent_id>0) {
//            $this->getBeadCrumbs($good->parent_id);
//        }
//    }

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
