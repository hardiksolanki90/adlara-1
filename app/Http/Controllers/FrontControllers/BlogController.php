<?php
namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\FrontController;
use Input;
use Illuminate\Http\Request;

class BlogController extends FrontController
{
    public $categories;

    public $recent_posts;

    public $mostly_viewed;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->categories = $this->context->post_category
        ->where('status', 1)
        ->get();

        $this->recent_posts = $this->context->post->orderBy('created_at', 'asc')->get()->take(5);

        $this->mostly_viewed = $this->context->post_track->most_visited();
    }

    public function initListing()
    {
        $posts = $this->context->post->all();
        $latest_posts =  $this->context->post->orderBy('created_at', 'asc')->get()->take(5);
        $recent_view = $this->context->post_track
        ->recently_view(session()->getId());

        $this->page['meta_title'] = 'Blog | Recyclingbalers.com';
        $this->page['meta_description'] = 'Recyclingbalers blog.';
        $this->page['meta_keywords'] = 'blog, Recyclingbalers blog';
        $this->page['body_class'] = 'blogs';

        $this->assign = array(
          'posts' => $posts,
          'latest_posts' => $this->recent_posts,
          'recent_view' => $recent_view,
          'mostly_viewed' => $this->mostly_viewed
        );

        return $this->template('blog.list');
    }

    private function PostTracking($post_id)
    {
        $blog_post_track = $this->context->post_track
        ->where('session_id', session()->getId())
        ->where('id_post', $post_id)
        ->first();

        $id_user = 0;

        if (!isset($blog_post_track->id)) {
            $post_track = $this->context->post_track;
            $post_track->fill([
              'id_post' => $post_id,
              'id_user' => $id_user,
              'os' => config('adlara.request')->server('HTTP_USER_AGENT'),
              'session_id' => session()->getId(),
            ]);
            $post_track->save();
        }
    }

    public function initContentPost($url)
    {
        $post = $this->context->post->findByUrl($url);

        $this->PostTracking($post->id);

        $recent_view = $this->context->post_track
        ->recently_view(session()->getId());

        $all_posts = $this->context->post->all();

        $this->page['meta_title'] = $post->meta_title . '| Recyclingbalers.com';
        $this->page['meta_description'] = $post->meta_description;
        $this->page['meta_keywords'] = $post->meta_keywords;
        $this->page['body_class'] = 'blog_post';

        $this->assign = array(
          'post' => $post,
          'all_posts' => $all_posts,
          'latest_posts' => $this->recent_posts,
          'recent_view' => $recent_view,
          'mostly_viewed' => $this->mostly_viewed
        );

        return $this->template('blog.view');
    }

    public function initListingCategory($category)
    {
        $category = $this->context->post_category->findByUrl($category);
        $posts = $category->posts;

        // $this->post_track($post->id);

        $this->page['meta_title'] = $category->meta_title . '| Recyclingbalers.com';
        $this->page['meta_description'] = $category->meta_description;
        $this->page['meta_keywords'] = $category->meta_keywords;
        $this->page['body_class'] = 'blog_category';

        $recent_view = $this->context->post_track
        ->recently_view(session()->getId());

        $this->assign = array(
          'posts' => $posts,
          // 'latest_posts' => $latest_posts,
          'name' => $category->name,
          'latest_posts' => $this->recent_posts,
          'recent_view' => $recent_view,
          'mostly_viewed' => $this->mostly_viewed
        );

        return $this->template('blog.list');
    }

    public function initListingAuthor($id, $url)
    {
        $admin_user = $this->context->admin_user->find($id);
        $posts = $admin_user->posts;

        $recent_view = $this->context->post_track
        ->recently_view(session()->getId());

        $this->assign = array(
          'posts' => $posts,
          // 'latest_posts' => $latest_posts,
          'name' => $admin_user->name,
          'latest_posts' => $this->recent_posts,
          'recent_view' => $recent_view,
          'mostly_viewed' => $this->mostly_viewed
        );

        return $this->template('blog.list');
    }
}
