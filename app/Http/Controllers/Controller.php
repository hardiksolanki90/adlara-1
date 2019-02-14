<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $assign = array();

    protected $assign_default = array();

    protected $context;

    protected $css_files = [];

    protected $js_files = [];

    public function __construct()
    {
        $this->context = config('adlara.context');
    }

    protected function validateFields(array $datas = array())
    {
        $fields = [];
        if (!count($datas) && Input::get('required')) {
          if (!is_array(Input::get('required'))) {
            $required = explode(',', Input::get('required'));
            $required_label = explode(',', Input::get('required_label'));
          } else {
            $required = Input::get('required');
            $required_label = Input::get('required');
          }

          foreach ($required as $key => $req) {
            $datas[$req] = $required_label[$key];
          }
        }

        foreach ($datas as $d => $data) {
            if (!Input::get($d) && !isset($_FILES[$d])) {
                return json('error', 'Please supply ' . $data, true, Input::get('element'));
            } else {
                $da = str_replace('-', '_', $d);
                $fields[$da] = Input::get($d);
            }
        }

        return (object) $fields;
    }
}
