<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;

class MenuHeadingController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => 'menu_heading'])
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
          $menu_heading = $this->context->menu_heading
          ->orderBy('id', 'desc')
          ->where($this->filter_search);
        } else {
          $menu_heading = $this->context->menu_heading
          ->orderBy('id', 'desc');
        }

        $this->page['badge'] = count($menu_heading->get());
        $this->obj = $menu_heading->paginate(25);

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable,
          'variable' => 'menu_heading'
        ];

        if ($request->ajax()) {
          $data = $this->assign;
          $html = getAdminTemplate('menu_heading/_partials/list-only-menu_heading', $data, true);
          return json('success', $html, true, prepareHTML($menu_heading->paginate(25)->links()));
        }

        return $this->template('menu_heading.list');
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
            'text' => t('Add Admin Menu'),
            'slug' => route('admin_menu.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        if ($this->component->is_admin_create && $id) {
          $this->page['action_links'][] = [
            'text' => t('Add ' . $this->component->name),
            'slug' => route($this->component->variable . '.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->obj = $this->context->menu_heading;
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable
        ];

        return $this->template('menu_heading.create');
    }

    public function initProcessCreate($id = null)
    {
        $data = $this->validateFields();
        $this->obj = $this->context->menu_heading;

        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $data = $this->obj;
                    $data->name = Input::get('name');
                        $data->save();


          if (!$id) {
          return json('redirect', AdminURL($this->component->slug . '/edit/' . $data->id));
        }

        return json('success', t($this->component->name . ' updated'));
    }

    public function initProcessDelete($id = null)
    {
        $obj = $this->context->menu_heading->find($id);
        if ($obj) {
          $obj->delete();
                              $this->flash('success', 'Admin Menu Headings with title <strong>' . $obj->name . '</strong> is deleted successufully');
        }
        return redirect(route('menu_heading.list'));
    }
}
