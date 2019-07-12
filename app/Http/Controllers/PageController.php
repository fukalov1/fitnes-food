<?php

namespace App\Http\Controllers;
use App\Template;
use Mail;
use App\MailForm;
use App\Page;
use App\PageBlock;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public $bread_crubs;

    public function __construct(Page $page, PageBlock $pageBlock, Template $template)
    {
        $this->page = $page;
        $this->pageBlock = $pageBlock;
        $this->template = $template;

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

        $user_template = $this->template->where('default',1)->get();
        $data['template'] = $user_template;

//        dd($data);
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

    public function sendFormData()
    {
        $request = request();
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $message = $request->input('message');
        $caption = $request->input('caption');
        if (!isset($caption))
            $caption = 'Отправка заявки.';
//        $email = request('email');

//        print "$name-$phone";
//        exit;

        if ($name !='' and $phone != '') {

//            $mailform = MailForm::find($id);

            $data = [
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'message' => $message,
                'caprion' => $caption,
                'to' => config('email')
            ];

            Mail::send('emails.sendform', ['data' => $data], function ($m) use ($data) {
                $m->from(env('MAIL_USERNAME'), config('caption'));

                $m->to($data['to'], 'admin')->subject('Заявка');
            });
            $data = ['success' => true, 'error' => '', 'result' => 'Спасибо за Ваше обращение. Сообщение успешно отправлено.'];
        }
        else {
            $data = ['success' => false, 'error' => 'Ошибка при отправлении. Данные не приняты '.$name.'-'.$phone, 'result' => ''];
        }
        return json_encode($data);
    }


}
