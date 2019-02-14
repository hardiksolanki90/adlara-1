@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="card _main_card">
    @if (count($page['action_links']))
      <div class="_ph">
        <div class="_pas">
          <div class="action-bar-panel">
            @foreach ($page['action_links'] as $link)
              <a data-toggle="tooltip" data-placement="top" data-original-title="{{ $link['text'] }}" target="_blank" class="rounded-s action-link {{ (isset($link['class']) ? $link['class'] : '') }}" href="{{ $link['slug'] }}">
                @if ($link['icon'])
                  {!! $link['icon'] !!}
                @endif
                <span>{{ $link['text'] }}</span>
              </a>
            @endforeach
          </div>
        </div>
        <div class="_h">
          {{ $page['title'] }}
        </div>
      </div>
    @endif
      <div class="card-body">
                  <ul class="nav nav-tabs main-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#information" role="tab" data-toggle="tab">Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#seo" role="tab" data-toggle="tab">SEO</a>
            </li>
          </ul>
                        {!! $form->start('performance-create-form', 'myForm tab-pad') !!}
          <div class="tab-content">
            <div class="tab-pane container active" id="information">
                                                  
                      {!! $form->text([
                        'name' => 'name',
                        'required' => true,
                        'label' => t('Name'),
                        'value' => model($obj, 'name'),
                        'class' => ''
                        ]) !!}
                                                                                      
                      {!! $form->text([
                        'name' => 'description',
                        'required' => false,
                        'label' => t('Description'),
                        'value' => model($obj, 'description'),
                        'class' => ''
                        ]) !!}
                                                                                                                                                                                                                {!! $form->choice([
                            'name' => 'categories[]',
                            'required' => true,
                            'label' => t('Categories'),
                            'value' => $obj->performance_category->pluck('id')->toArray(),
                            'class' => '',
                            'options' => $context->performance_category->get()->toArray(),
                            'reverse' => true,
                            'text_key' => 'name',
                            'value_key' => 'id',
                            'type' => 'select',
                            'multiple' => true,
                            ]) !!}
                                                                                                                                                                                                                                                            {!! $form->choice([
                            'name' => 'id_owner',
                            'required' => true,
                            'label' => t('Owner'),
                            'value' => model($obj->theatre_owner, 'id'),
                            'class' => '',
                            'options' => $context->theatre_owner->get()->toArray(),
                            'reverse' => true,
                            'text_key' => 'name',
                            'value_key' => 'id',
                            'type' => 'select',
                            ]) !!}
                                                                                                                                
                      {!! $form->text([
                        'name' => 'test',
                        'required' => false,
                        'label' => t('Test'),
                        'value' => model($obj, 'test'),
                        'class' => ''
                        ]) !!}
                                                                                                                                                                                                            {!! $form->text([
                          'name' => 'date',
                          'required' => true,
                          'label' => t('Dates'),
                          'value' => model($obj->dates, 'date', '', 'object', true),
                          'class' => ' tags-input',
                          'textarea' => true,
                          ]) !!}
                                                                                                                                                      {!! $form->media([
                        'name' => 'id_profile_image',
                        'required' => true,
                        'label' => t('Profile Image'),
                        'media' => model($obj, 'profile_image'),
                        'object_type' => 'image',
                        'multiple' => false                        ]) !!}
                                                              </div>
                          <div role="tabpanel" class="tab-pane fade" id="seo">
                {!! $form->text([
                  'name' => 'meta_title',
                  'value' => model($obj, 'meta_title'),
                  'label' => 'Meta Title',
                  ]) !!}
                {!! $form->text([
                  'name' => 'meta_description',
                  'value' => model($obj, 'meta_description'),
                  'label' => 'Meta Description',
                  'textarea' => true,
                  ]) !!}
                {!! $form->text([
                  'name' => 'meta_keywords',
                  'value' => model($obj, 'meta_keywords'),
                  'type' => 'text',
                  'label' => 'Meta Keywords',
                  ]) !!}
              </div>
          </div>
                  <div class="page_footer flex space-between">
            <div class="_ls">
                                        </div>
            <div class="_rs">
              <button type="submit" class="btn btn-primary btn-submit has-icon-right" name="button">
                <i class="ion-ios-download-outline"></i>
                {{ t('Save') }} performance              </button>
            </div>
          </div>
      {!! $form->end() !!}
        </div>
  </div>
</div>
@endsection
