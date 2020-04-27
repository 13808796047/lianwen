<?php


namespace App\Handlers;


use Intervention\Image\ImageManager;

class OrderimgHandler
{
    public function generate()
    {
        $manager = new ImageManager(['driver' => 'gd']);
        $img = $manager->make(public_path('orderimg/wp.jpg'));
        $i = 500;
        $fontTtf = public_path('orderimg/msyhl.ttc');
        $fontSize = 26;
        $title = '河南大学第一附属医院（徐亚晖、孟凯）医院后勤服务社会化风险及对策';

        $box = autowrap($fontSize, 0, $fontTtf, $title, $i);
        $img->text('论文题目:', 180, 350, function($font) use ($fontSize, $fontTtf) {
            $font->file($fontTtf);
            $font->size($fontSize);
            $font->color('#000');
            $font->align('center');
            $font->valign('top');
        });
        $img->text($box, 250, 350, function($font) use ($fontSize, $fontTtf) {
            $font->file($fontTtf);
            $font->size($fontSize);
            $font->color('#000');
            $font->valign('top');
        });
        $img->text('论文作者:', 180, 450, function($font) use ($fontSize, $fontTtf) {
            $font->file($fontTtf);
            $font->size($fontSize);
            $font->color('#000');
            $font->align('center');
            $font->valign('top');
        });
        $img->text('论文作者:', 305, 450, function($font) use ($fontSize, $fontTtf) {
            $font->file($fontTtf);
            $font->size($fontSize);
            $font->color('#000');
            $font->align('center');
            $font->valign('top');
        });
        $img->text('检测系统:', 180, 520, function($font) use ($fontSize, $fontTtf) {
            $font->file($fontTtf);
            $font->size($fontSize);
            $font->color('#000');
            $font->align('center');
            $font->valign('top');
        });
        $img->text('检测系统:', 305, 520, function($font) use ($fontSize, $fontTtf) {
            $font->file($fontTtf);
            $font->size($fontSize);
            $font->color('#000');
            $font->align('center');
            $font->valign('top');
        });
        $img->text('检测时间:', 180, 590, function($font) use ($fontSize, $fontTtf) {
            $font->file($fontTtf);
            $font->size($fontSize);
            $font->color('#000');
            $font->align('center');
            $font->valign('top');
        });
        $img->text('检测时间:', 305, 590, function($font) use ($fontSize, $fontTtf) {
            $font->file($fontTtf);
            $font->size($fontSize);
            $font->color('#000');
            $font->align('center');
            $font->valign('top');
        });
        $img->text('98.88', 509, 780, function($font) use ($fontSize, $fontTtf) {
            $font->file(public_path('orderimg/FZSHHJW.TTF'));
            $font->size(44);
            $font->color('#f00');
            $font->align('center');
            $font->valign('top');
            $font->angle(15);
        });
        return $img->response('jpg');
    }
}