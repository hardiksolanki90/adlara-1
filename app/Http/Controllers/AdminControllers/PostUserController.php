<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;

class PostUserController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => 'post_user'])
        ->first();
    }

    public function initListing(Request $request)
    {
        if ($this->component->is_admin_create) {
          $this->page['action_links'][] = [
            'text' => t('Add ' . $this->component->name),
            'slug' => $this->component->slug . '/add',
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->initProcessFilter();

        if ($this->filter) {
          $post_user = $this->context->post_user
          ->orderBy('id', 'desc')
          ->where($this->filter_search);
        } else {
          $post_user = $this->context->post_user
          ->orderBy('id', 'desc');
        }

        $this->page['badge'] = count($post_user->get());
        $this->obj = $post_user->paginate(25);

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable,
          'variable' => 'post_user'
        ];

        if ($request->ajax()) {
          $data = $this->assign;
          $html = getAdminTemplate('post_user/_partials/list-only-post_user', $data, true);
          return json('success', $html, true, prepareHTML($post_user->paginate(25)->links()));
        }

        return $this->template('post_user.list');
    }

    public function initContentCreate($id = null)
    {
        if ($this->component->is_admin_list) {
          $this->page['action_links'][] = [
            'text' => t($this->component->name),
            'slug' => $this->component->slug,
            'icon' => '<i class="material-icons">list</i>'
          ];
        }

        if ($this->component->is_admin_create && $id) {
          $this->page['action_links'][] = [
            'text' => t('Add'),
            'slug' => AdminURL($this->component->slug . '/add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->obj = $this->context->post_user;
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable
        ];

        return $this->template('post_user.create');
    }

    public function initProcessCreate($id = null)
    {
        $data = $this->validateFields();
        $this->obj = $this->context->post_user;

        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $data = $this->obj;
                    $data->full_name = Input::get('full_name');
              $data->email = Input::get('email');
                              $data->id_country = Input::get('id_country');
                  $data->save();


          if (!$id) {
          return json('redirect', AdminURL($this->component->slug . '/edit/' . $data->id));
        }

        return json('success', t($this->component->name . ' updated'));
    }

    public function initProcessDelete($id = null)
    {
        $obj = $this->context->post_user->find($id);
        if ($obj) {
          $obj->delete();
                              $this->flash('success', 'Post User with title <strong>' . $obj->name . '</strong> is deleted successufully');
        }
        return redirect(route('post_user.list'));
    }
}
