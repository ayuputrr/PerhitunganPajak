<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController extends Controller
{
    public function image()
    {
        $builder = new CaptchaBuilder();
        $builder->build();

        // Simpan kode captcha ke session
        session()->set('captcha_word', $builder->getPhrase());

        // Set header gambar
        return $this->response
            ->setHeader('Content-Type', 'image/jpeg')
            ->setBody($builder->get());
    }
}
