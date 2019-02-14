<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;
use Route;

class AdminMenuController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => 'admin_menu'])
        ->first();
    }

    public function initListing(Request $request)
    {
        if ($this->component->is_admin_create) {
          $this->page['action_links'][] = [
            'text' => t('Add ' . $this->component->name),
            'slug' => route($this->component->variable . '.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->initProcessFilter();

        if ($this->filter) {
          $admin_menu = $this->context->admin_menu
          ->orderBy('id', 'desc')
          ->where($this->filter_search);
        } else {
          $admin_menu = $this->context->admin_menu
          ->orderBy('id', 'desc');
        }

        $this->page['badge'] = count($admin_menu->get());
        $this->obj = $admin_menu->paginate(25);

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable,
          'variable' => 'admin_menu'
        ];

        if ($request->ajax()) {
          $data = $this->assign;
          $html = getAdminTemplate('admin_menu/_partials/list-only-admin_menu', $data, true);
          return json('success', $html, true, prepareHTML($admin_menu->paginate(25)->links()));
        }

        return $this->template('admin_menu.list');
    }

    public function initContentCreate($id = null)
    {
        if ($this->component->is_admin_list) {
          $this->page['action_links'][] = [
            'text' => t($this->component->name),
            'slug' => route($this->component->variable . '.list'),
            'icon' => '<i class="material-icons">list</i>'
          ];
          $this->page['action_links'][] = [
            'text' => t('Add Child Menu'),
            'slug' => route('admin_menu_child.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        if ($this->component->is_admin_create && $id) {
          $this->page['action_links'][] = [
            'text' => t('Add'),
            'slug' => route($this->component->variable . '.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->obj = $this->context->admin_menu;
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $routeCollection = Route::getRoutes();
        $routeNames = array();
        foreach ($routeCollection as $route) {
          if ($route->getName()) {
            $routeNames[] = [
              'id' => $route->getName(),
              'text' => $route->getName()
            ];
          }
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable,
          'routeNames' => $routeNames
        ];

        return $this->template('admin_menu.create');
    }

    public function initProcessCreate($id = null)
    {
        $data = $this->validateFields();
        $this->obj = $this->context->admin_menu;

        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $data = $this->obj;
                    $data->name = Input::get('name');
              $data->slug = Input::get('slug');
                              $data->id_head = Input::get('id_head');
                  $data->save();


          if (!$id) {
          return json('redirect', AdminURL($this->component->slug . '/edit/' . $data->id));
        }

        return json('success', t($this->component->name . ' updated'));
    }

    public function initProcessDelete($id = null)
    {
        $obj = $this->context->admin_menu->find($id);

        if ($obj) {
          $obj->delete();
                              $this->flash('success', 'Admin Menu with title <strong>' . $obj->name . '</strong> is deleted successufully');
        }
        return redirect(route('admin_menu.list'));
    }
}
