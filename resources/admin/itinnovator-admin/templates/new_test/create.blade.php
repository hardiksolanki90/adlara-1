@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="card">
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
                {!! $form->start('new_test-create-form', 'myForm tab-pad') !!}
          <div class="tab-content">
            <div class="tab-pane container active" id="information">
                              
                  {!! $form->text([
                    'name' => 'name',
                    'required' => true,
                    'label' => t('Name'),
                    'value' => model($obj, 'name'),
                    'class' => ''
                    ]) !!}
                                                                                                                                                                                                          {!! $form->choice([
                    'name' => 'multi_select',
                    'required' => true,
                    'label' => t('Multi Select'),
                    'value' => model($obj, 'multi_select'),
                    'class' => '',
                    'options' => ['No', 'Yes'],
                    'reverse' => true
                    ]) !!}
                                                                                                    {!! $form->file([
                    'name' => 'chose_file',
                    'required' => false,
                    'label' => t('Chose File'),
                    'value' => model($obj, 'chose_file'),
                    'class' => '',
                    'type' => 'file',
                    'multiple' => false
                    ]) !!}
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
                                            {!! $form->choice([
                  'name' => 'status',
                  'required' => false,
                  'label' => t('Status'),
                  'value' => model($obj, 'status'),
                  'class' => '',
                  'options' => ['No', 'Yes'],
                  'wrapper_class' => 'css_switch',
                  'type' => 'radio',
                  'reverse' => true
                ]) !!}
                          </div>
            <div class="_rs">
              <button type="submit" class="btn btn-primary btn-submit has-icon-right" name="button">
                <i class="ion-ios-download-outline"></i>
                {{ t('Save') }} new test              </button>
            </div>
          </div>
      {!! $form->end() !!}
        </div>
  </div>
</div>
@endsection
