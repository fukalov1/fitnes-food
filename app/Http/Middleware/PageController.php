<?php

namespace App\Http\Controllers;
use App\QuestBlock;
use Mail;
use App\CenterNew;
use App\Page;
use App\PageBlock;
use App\Slider;
use App\SliderItem;
use App\Photoset;
use App\MailForm;
use App\Map;
use App\Question;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public $bread_crubs;

    public function __construct(Page $page, PageBlock $pageBlock, CenterNew $centerNew, Map $map, QuestBlock $questBlock,
                                Slider $slider, SliderItem $sliderItem, Photoset $photoset, MailForm $mailForm)
    {
        $this->page = $page;
        $this->pageBlock = $pageBlock;
        $this->questBlock = $questBlock;
        $this->centerNew = $centerNew;
        $this->slider = $slider;
        $this->sliderItem = $sliderItem;
        $this->photoset = $photoset;
        $this->mailForm = $mailForm;
        $this->map = $map;
    }

    public function show(Page $page)
    {

//        dd($page);
        $template = 'page';
        $data = ['data' => $page];
        // Если главная страница
        if ($page->id == 1) {
            $template = 'main';
            $data = [
                'data' => $page
            ];
        }
        //  баннера для зоны новостей
        $banners = $this->sliderItem->where('slider_id',4)->get();
//        dd($banners);
        $limit_news = 4;
        $limit_news = $limit_news - count($banners);

        $this->getBeadCrumbs($page->id);
        $data['pages'] = $this->page->getMenu();
        $data['directs'] = $this->page->where('number_direct','>', '0')->orderBy('number_direct')->get();
        $data['page_blocks'] = $this->pageBlock->where('page_id', $page->id)->orderBy('orders')->get();
        $data['center_news'] = $this->centerNew->orderBy('date', 'desc')->inRandomOrder()->limit($limit_news)->get();
        $data['banners'] = $banners;
        $data['bread_crumbs'] = '<a href="/">Главная</a> /'.$this->bread_crubs;

//        dd($page->getMenu());
//dd($page->id,$data);
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

    public function sendFormData($id)
    {
        if ($id) {

            $mailform = MailForm::find($id);

            $data = [
                'email' => request('email'),
                'name' => request('name'),
                'phone' => request('phone'),
                'message' => request('message'.$id),
                'to' => $mailform->sender
            ];

            Mail::send('emails.sendform', ['data' => $data], function ($m) use ($data) {
                $m->from(env('MAIL_USERNAME'), 'Центр трудовых ресурсов Тольятти');

                $m->to($data['to'], 'admin')->subject('Обратная связь');
            });
            $data = ['result' => 'Спасибо за Ваше обращение. <br/><br/>Сообщение успешно отправлено администратору.<br/><br/> В ближайшее время Вы получите ответ.'];
        }
        else {
            $data = ['result' => 'Данные не приняты'];
        }
        return json_encode($data);
    }

    public function sendQuestData($id)
    {
        if ($id) {

            $quest_block = $this->questBlock->find($id);

            $question = new Question();
            $question->quest_block_id = $id;
            $question->sort = 1;
            $question->hide = 1;
            $question->quest = request('message'.$id);
            $question->response = '';
            $question->email = request('email');
            $question->name = request('fio');
            $question->save();
//            dd('id',$question->id);

            $data = [
                'email' => request('email'),
                'name' => request('name'),
                'message' => request('message'.$id),
                'to' => $quest_block->email,
                'page' => $quest_block->page->name,
                'id' => $question->id
            ];

            // Уведомление клиенту
            Mail::send('emails.sendform', ['data' => $data], function ($m) use ($data) {
                $m->from(env('MAIL_USERNAME'), 'Центр трудовых ресурсов Тольятти');

                $m->to($data['to'], 'admin')->subject('Вопрос № '.$data['id'].' для центра трудовых ресурсов. Страница '.$data['page']);
            });
            // работнику центра
            Mail::send('emails.sendform', ['data' => $data], function ($m) use ($data) {
                $m->from(env('MAIL_USERNAME'), 'Центр трудовых ресурсов Тольятти');

                $m->to($data['email'], 'admin')->subject('Вопрос № '.$data['id'].' c сайта. Страница '.$data['page']);
            });
            $data = ['result' => 'Спасибо за Ваше обращение. <br/><br/>Ваш вопрос № '.$question->id.' успешно отправлен.'];



        }
        else {
            $data = ['result' => 'Данные не приняты'];
        }
        return json_encode($data);
    }

}
