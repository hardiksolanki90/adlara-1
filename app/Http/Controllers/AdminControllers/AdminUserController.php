<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;

class AdminUserController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => 'admin_user'])
        ->first();
    }

    public function initListing(Request $request)
    {
        $this->page['title'] = 'Admin User';
        if ($this->component->is_admin_create) {
            $this->page['action_links'][] = [
            'text' => t('Add ' . $this->component->name),
            'slug' => route($this->component->variable . '.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->initProcessFilter();

        if ($this->filter) {
            $admin_user = $this->context->admin_user
          ->orderBy('id', 'desc')
          ->where($this->filter_search);
        } else {
            $admin_user = $this->context->admin_user
          ->orderBy('id', 'desc');
        }

        $this->page['badge'] = count($admin_user->get());
        $this->obj = $admin_user->paginate(25);

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable,
          'variable' => 'admin_user',
          'obj' => $this->obj,
        ];

        if ($request->ajax()) {
            $data = $this->assign;
            $html = view('admin_user/_partials/list-only-admin_user', $data);
            $html = prepareHTML($html);
            return json('success', $html, true, prepareHTML($admin_user->paginate(25)->links()));
        }

        return $this->template('admin_user.list');
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

        $this->obj = $this->context->admin_user;
        if ($id) {
            $this->obj = $this->obj->find($id);
        }

        if (!$id) {
            $this->page['title'] = 'Add Admin User';
        } else {
            $this->page['title'] = 'Admin User: ' . $this->obj->name;
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable
        ];

        return $this->template('admin_user.create');
    }

    public function initProcessCreate($id = null)
    {
        $data = $this->validateFields();
        $this->obj = $this->context->admin_user;

        if ($id) {
            $this->obj = $this->obj->find($id);
        }

        $password = Input::get('password');

        if (!$id && !Input::get('password')) {
          return json('error', t('Please provide password to create an admin user'));
        }

        if ($id && !Input::get('password')) {
          $password = $this->obj->password;
        }

        $data = $this->obj;
        $data->name = Input::get('name');
        $data->email = Input::get('email');
        $data->password = $password;
        $data->mobile = Input::get('mobile');
        $data->save();

        if (!$id) {
            return json('redirect', AdminURL($this->component->slug . '/edit/' . $data->id));
        }

        return json('success', t($this->component->name . ' updated'));
    }

    public function initProcessDelete($id = null)
    {
        $obj = $this->context->admin_user->find($id);
        if ($obj) {
            $obj->delete();
            $this->flash('success', 'Admin User with title <strong>' . $obj->name . '</strong> is deleted successufully');
        }
        return redirect(route('admin_user.list'));
    }
}
