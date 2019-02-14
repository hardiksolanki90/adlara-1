<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;

class ProductController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => 'product'])
        ->first();
    }

    public function initListing(Request $request)
    {
        $this->page['title'] = 'Product';
        if ($this->component->is_admin_create) {
          $this->page['action_links'][] = [
            'text' => t('Add ' . $this->component->name),
            'slug' => route($this->component->variable . '.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->initProcessFilter();

        if ($this->filter) {
            $product = $this->context->product
          ->orderBy('id', 'desc')
          ->where($this->filter_search);
          } else {
          $product = $this->context->product
          ->orderBy('id', 'desc');
        }

        $this->page['badge'] = count($product->get());
        $this->obj = $product->paginate(25);

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable,
          'variable' => 'product',
          'obj' => $this->obj,
        ];

        if ($request->ajax()) {
          $data = $this->assign;
          $html = view('product/_partials/list-only-product', $data);
          $html = prepareHTML($html);
          return json('success', $html, true, prepareHTML($product->paginate(25)->links()));
        }

        return $this->template('product.list');
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

        $this->obj = $this->context->product;
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        if (!$id) {
          $this->page['title'] = 'Add Product';
        } else {
          $this->page['title'] = 'Product: ' . $this->obj->name;
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable
        ];

        return $this->template('product.create');
    }

    public function initProcessCreate($id = null)
    {
        $data = $this->validateFields();
        $this->obj = $this->context->product;

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


  
          if (!$id) {
          return json('redirect', AdminURL($this->component->slug . '/edit/' . $data->id));
        }

        return json('success', t($this->component->name . ' updated'));
    }

    public function initProcessDelete($id = null)
    {
        $obj = $this->context->product->find($id);
        if ($obj) {
          $obj->delete();
                              $this->flash('success', 'Product with title <strong>' . $obj->name . '</strong> is deleted successufully');
        }
        return redirect(route('product.list'));
    }
}
