<?php

namespace App\Classes;

class Context
{
    private static $instance;

    protected $form;

    protected $tools;

    protected $component;

    protected $component_fields;

		protected $page;

		protected $block;

		protected $countries;

		protected $menu_heading;

		protected $admin_menu;

		protected $admin_menu_child;

		protected $media;

		protected $configuration;

		protected $media_image_size;

		protected $media_test;

		protected $media_test_images;

		protected $post_category;

		protected $post;

		protected $post_tags;

		protected $post_category_assigned;

		protected $post_tags_assigned;

		protected $product;

		protected $admin_user;

    public static function getContext()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function __get($property)
    {
        $real_property = $property;
        $property = explode('_', $property);
        if (count($property)) {
          $new_property = '';
          foreach ($property as $prop) {
            $new_property .= ucfirst($prop);
          }
          $property = $new_property;
        }
        $method = 'get'.ucfirst($property); // getStatus
        if (method_exists($this, $method)) {
          return $this->$method();
        }

        if (file_exists(base_path('app/Objects/' . ucfirst($property) . '.php'))) {
          $class = '\App\Objects\\' . ucfirst($property);
          return $this->block = new $class;
        }

        if (file_exists(base_path('app/Classes/' . ucfirst($property) . '.php'))) {
          $class = '\App\Classes\\' . ucfirst($property);
          return $this->block = new $class;
        }
    }
}
