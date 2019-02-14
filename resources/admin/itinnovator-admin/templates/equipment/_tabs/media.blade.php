{!! $form->media([
  'name' => 'images',
  'media' => $obj->images,
  'multiple' => true,
  'label' => 'Images'
]) !!}
{!! $form->media([
  'name' => 'videos',
  'media' => $obj->videos,
  'multiple' => true,
  'label' => 'Videos',
  'object_type' => 'video'
]) !!}
