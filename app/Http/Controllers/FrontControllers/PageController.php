<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\FrontController;

class PageController extends FrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component->where('variable', 'page')->first();
    }

    public function initContentHome()
    {
        return $this->template('home');
    }

    public function initContent($p1 = null, $p2 = null, $p3 = null, $p4 = null, $p5 = null)
    {
        // if (url()->current() == url('')) {
        //   $page = $this->context->page->findByURL('/');
        //   return $this->initContentHome($page);
        // }

        $url = '';

        $url .= $p1;

        if ($p2) {
          $url .= $p2;
        }

        if ($p3) {
          $url .= '/' . $p3;
        }

        if ($p4) {
          $url .= '/' . $p4;
        }

        if ($p5) {
          $url .= '/' . $p5;
        }

        if (!$url) {
          $url = '/';
        }

        $pages = $this->context->page->findByUrl($url);
        $this->obj = $pages;

        if (!isset($pages->id)) {
          return redirect('404');
        }

        if (isset($pages->id) && !$pages->status) {
          return redirect('404');
        }

        $this->assign = [
          'current_page' => $pages
        ];

        if (isset($pages->content)) {
          return $this->template('page.view');
        }

        return $this->template('page.' . $url);
    }

    public function initProcessComponents()
    {
        $c = \App\Objects\Component::with('fields')->get();
        return $c;
    }

    public function initProcessPages()
    {
        return \App\Objects\Page::all();
    }
}
