<?php
namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminController;
use Input;
use Illuminate\Http\Request;

class PostController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->component = $this->context->component
        ->where(['variable' => 'post'])
        ->first();
    }

    public function initListing(Request $request)
    {
        $this->page['title'] = 'Post';
        if ($this->component->is_admin_create) {
          $this->page['action_links'][] = [
            'text' => t('Add ' . $this->component->name),
            'slug' => route($this->component->variable . '.add'),
            'icon' => '<i class="material-icons">add_circle_outline</i>'
          ];
        }

        $this->initProcessFilter();

        if ($this->filter) {
            $post = $this->context->post
                    ->leftJoin('post_category_assigned', 'post_category_assigned.id_category', '=', 'post.id')
          ->leftJoin('post_category', 'post_category.id', '=', 'post_category_assigned.id_post')
                                            ->leftJoin('media', 'media.id', '=', 'post.id_media')
                                ->leftJoin('post_tags_assigned', 'post_tags_assigned.id_tag', '=', 'post.id')
          ->leftJoin('post_tags', 'post_tags.id', '=', 'post_tags_assigned.id_post')
                                ->select('post.*')
          ->orderBy('id', 'desc')
          ->where($this->filter_search);
          } else {
          $post = $this->context->post
          ->orderBy('id', 'desc');
        }

        $this->page['badge'] = count($post->get());
        $this->obj = $post->paginate(25);

        $listable = $this->component->fields
        ->where('use_in_listing', 1);

        $this->assign = [
          'listable' => $listable,
          'variable' => 'post',
          'obj' => $this->obj,
        ];

        if ($request->ajax()) {
          $data = $this->assign;
          $html = view('post/_partials/list-only-post', $data);
          $html = prepareHTML($html);
          return json('success', $html, true, prepareHTML($post->paginate(25)->links()));
        }

        return $this->template('post.list');
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

        $this->obj = $this->context->post;
        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        if (!$id) {
          $this->page['title'] = 'Add Post';
        } else {
          $this->page['title'] = 'Post: ' . $this->obj->name;
        }

        $fillable = $this->component->fields
        ->where('is_fillable', 1);

        $this->assign = [
          'fillable' => $fillable
        ];

        return $this->template('post.create');
    }

    public function initProcessCreate($id = null)
    {
        $data = $this->validateFields();
        $this->obj = $this->context->post;

        if ($id) {
          $this->obj = $this->obj->find($id);
        }

        $data = $this->obj;
                    $data->title = Input::get('title');
              $data->url = Input::get('url');
              $data->content = Input::get('content');
              $data->meta_title = Input::get('meta_title');
              $data->meta_description = Input::get('meta_description');
              $data->meta_keywords = Input::get('meta_keywords');
              
                    $data->id_media = Input::get('id_media');
                  $data->save();


              if (count(Input::get('category'))) {
          if ($id) {
            \App\Objects\PostCategoryAssigned::where('id_category', $data->id)->forceDelete();
          }
          foreach (Input::get('category') as $input) {
            $re = new \App\Objects\PostCategoryAssigned;
            $re->id_post = $input;
            $re->id_category = $data->id;
            $re->save();
          }
        }
            if (count(Input::get('tag'))) {
          if ($id) {
            \App\Objects\PostTagsAssigned::where('id_tag', $data->id)->forceDelete();
          }
          foreach (Input::get('tag') as $input) {
            $re = new \App\Objects\PostTagsAssigned;
            $re->id_post = $input;
            $re->id_tag = $data->id;
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
        $obj = $this->context->post->find($id);
        if ($obj) {
          $obj->delete();
                                          \App\Objects\PostCategoryAssigned::where('id_category', $obj->id)->delete();
                      \App\Objects\PostTagsAssigned::where('id_tag', $obj->id)->delete();
                                $this->flash('success', 'Post with title <strong>' . $obj->name . '</strong> is deleted successufully');
        }
        return redirect(route('post.list'));
    }
}
