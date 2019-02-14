<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;

class PostCategoryController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => 'post_category'])
        ->first();
    }

    public function initListing(Request $request)
    {
        $this->page['title'] = 'Post Category';
        if ($this->component->is_admin_create) {
          $this->page['action_links'][] = [
            'text' => t('Add ' . $this->component->name),
            'slug' => route($this->component->variable . '.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->initProcessFilter();

        if ($this->filter) {
            $post_category = $this->context->post_category
          ->orderBy('id', 'desc')
          ->where($this->filter_search);
          } else {
          $post_category = $this->context->post_category
          ->orderBy('id', 'desc');
        }

        $this->page['badge'] = count($post_category->get());
        $this->obj = $post_category->paginate(25);

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable,
          'variable' => 'post_category',
          'obj' => $this->obj,
        ];

        if ($request->ajax()) {
          $data = $this->assign;
          $html = view('post_category/_partials/list-only-post_category', $data);
          $html = prepareHTML($html);
          return json('success', $html, true, prepareHTML($post_category->paginate(25)->links()));
        }

        return $this->template('post_category.list');
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

        $this->obj = $this->context->post_category;
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        if (!$id) {
          $this->page['title'] = 'Add Post Category';
        } else {
          $this->page['title'] = 'Post Category: ' . $this->obj->name;
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable
        ];

        return $this->template('post_category.create');
    }

    public function initProcessCreate($id = null)
    {
        $data = $this->validateFields();
        $this->obj = $this->context->post_category;

        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $data = $this->obj;
                    $data->name = Input::get('name');
              $data->url = Input::get('url');
              $data->status = Input::get('status');
              $data->media = Input::get('media');
              $data->meta_title = Input::get('meta_title');
              $data->meta_description = Input::get('meta_description');
              $data->meta_keywords = Input::get('meta_keywords');
              
              $data->save();


  
          if (!$id) {
          return json('redirect', AdminURL($this->component->slug . '/edit/' . $data->id));
        }

        return json('success', t($this->component->name . ' updated'));
    }

    public function initProcessDelete($id = null)
    {
        $obj = $this->context->post_category->find($id);
        if ($obj) {
          $obj->delete();
                              $this->flash('success', 'Post Category with title <strong>' . $obj->name . '</strong> is deleted successufully');
        }
        return redirect(route('post_category.list'));
    }
}
