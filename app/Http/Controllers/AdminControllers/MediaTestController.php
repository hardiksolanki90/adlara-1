<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;

class MediaTestController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => 'media_test'])
        ->first();
    }

    public function initListing(Request $request)
    {
        $this->page['title'] = 'Media Test';
        if ($this->component->is_admin_create) {
          $this->page['action_links'][] = [
            'text' => t('Add ' . $this->component->name),
            'slug' => route($this->component->variable . '.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->initProcessFilter();

        if ($this->filter) {
          $media_test = $this->context->media_test
          ->orderBy('id', 'desc')
          ->where($this->filter_search);
        } else {
          $media_test = $this->context->media_test
          ->orderBy('id', 'desc');
        }

        $this->page['badge'] = count($media_test->get());
        $this->obj = $media_test->paginate(25);

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable,
          'variable' => 'media_test'
        ];

        if ($request->ajax()) {
          $data = $this->assign;
          $html = getAdminTemplate('media_test/_partials/list-only-media_test', $data, true);
          return json('success', $html, true, prepareHTML($media_test->paginate(25)->links()));
        }

        return $this->template('media_test.list');
    }

    public function initContentCreate($id = null)
    {
        if ($this->component->is_admin_list) {
          $this->page['action_links'][] = [
            'text' => t($this->component->name),
            'slug' => route($this->component->variable . '.list'),
            'icon' => '<i class="material-icons">reply</i>'
          ];
        }

        if ($this->component->is_admin_create && $id) {
          $this->page['action_links'][] = [
            'text' => t('Add'),
            'slug' => route($this->component->variable . '.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->obj = $this->context->media_test;
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        if (!$id) {
          $this->page['title'] = 'Add Media Test';
        } else {
          $this->page['title'] = 'Media Test: ' . $this->obj->name;
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable
        ];

        return $this->template('media_test.create');
    }

    public function initProcessCreate($id = null)
    {
        $data = $this->validateFields();
        $this->obj = $this->context->media_test;

        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $data = $this->obj;
                    $data->name = Input::get('name');
              $data->description = Input::get('description');
              $data->meta_title = Input::get('meta_title');
              $data->meta_description = Input::get('meta_description');
              $data->meta_keywords = Input::get('meta_keywords');
              
              $data->save();


              if (count(Input::get('media'))) {
          if ($id) {
            \App\Objects\MediaTestImages::where('id_media_test', $data->id)->forceDelete();
          }
          foreach (Input::get('media') as $input) {
            $re = new \App\Objects\MediaTestImages;
            $re->id_media = $input;
            $re->id_media_test = $data->id;
            $re->save();
          }
        }
              if (!$id) {
          return json('redirect', AdminURL($this->component->slug . '/edit/' . $data->id));
        }

        return json('success', t($this->component->name . ' updated'));
    }

    public function initProcessDelete($id = null)
    {
        $obj = $this->context->media_test->find($id);
        if ($obj) {
          $obj->delete();
                                          \App\Objects\MediaTestImages::where('id_media_test', $obj->id)->delete();
                                $this->flash('success', 'Media Test with title <strong>' . $obj->name . '</strong> is deleted successufully');
        }
        return redirect(route('media_test.list'));
    }
}
