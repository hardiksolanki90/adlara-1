<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;

class FrontController extends Controller
{
    protected $component;

    protected $obj;

    protected $page;

    protected $css_files = [];

    protected $js_files = [];

    public function __construct()
    {
        parent::__construct();
        if (!config('adlara.load_configuration')) {
          $this->configurationView();
        }
        if (config('adlara.maintenance')) {
          $this->maintenance();
        }
    }

    public function template($view)
    {
        $this->initMeta();
        $this->default_assigned_variables();
        $data = array_merge($this->assign, $this->assign_default);
        return view($view, $data);
    }

    private function default_assigned_variables()
    {
        $this->getCSS();
        $this->getJS();
        $body_class = '';
        $this->assign_default = [
          'context' => $this->context,
          'form' => config('adlara.context')->form,
          'component' => $this->component,
          'page' => $this->page,
          'css_files' => $this->css_files,
          'js_files' => $this->js_files,
          'body_class' => $body_class
        ];
    }

    private function initMeta()
    {
        if (!isset($this->obj->meta_title)) {
          $url = url()->current();
          $new_url = str_replace(url('') . '/', '', $url);
          $this->obj = config('adlara.context')->page->findByUrl($new_url);

          if (!isset($this->obj->meta_title)) {
            return true;
          }
        }



        if ($this->obj->meta_title) {
          $this->page['meta_title'] = $this->obj->meta_title . (($this->page['title_prefix']) && $this->page['title_prefix'] ? ' | ' . $this->page['title_prefix'] : '');
        }
        $this->page['meta_keywords'] = $this->obj->meta_keywords;
        $this->page['meta_description'] = $this->obj->meta_description;
    }

    private function getCSS()
    {
        $this->addCSS(theme('css/custom.css'));
        $this->addCSS(theme('css/app.css'));
        // $this->addCSS('//fonts.googleapis.com/icon?family=Material+Icons');
        // $this->addCSS(theme('css/front.css', true));
        // $this->addCSS(theme('css/slider.css', true));
    }

    private function getJS()
    {
        $this->addJS(theme('js/jquery.min.js', true));
        $this->addJS(theme('js/vue.min.js', true));
        $this->addJS('//cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js');
        $this->addJS(theme('js/semantic.min.js', true));
        $this->addJS(theme('js/custom.js'));
    }

    private function addCSS($css)
    {
        $this->css_files[] = $css;
    }

    private function addJS($js)
    {
        $this->js_files[] = $js;
    }

    public function configurationView()
    {
        http_response_code('503');
        echo '<!DOCTYPE html>
        <html>
        <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <title>Adlara Configuration Error!</title>
        <style type="text/css">
              body { text-align: center; padding: 150px; }
              h1 { font-size: 40px; }
              body { font: 20px Helvetica, sans-serif; color: #333; }
              #article { display: block; text-align: left; width: 650px; margin: 0 auto; }
              a { color: #dc8100; text-decoration: none; }
              a:hover { color: #333; text-decoration: none; }
            </style>
        </head>
        <body>
        <div id="article">
        <h1>Enable load configuration option in config/adlara.php</h1>
        <div>
        <p>Please open config/adlara.php file and set load_configuration to "true"</p>
        </div>
        </div>
        <script data-cfasync="false" src="/cdn-cgi/scripts/d07b1474/cloudflare-static/email-decode.min.js"></script></body>
        </html>';
        exit();
    }

    public function maintenance()
    {
        http_response_code('503');
        echo view('maintenance');
        exit();
    }
}
