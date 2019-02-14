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
                        {!! $form->start('performance_dates-create-form', 'myForm tab-pad') !!}
          <div class="tab-content">
            <div class="tab-pane container active" id="information">
                                                                                                                                                                            {!! $form->choice([
                            'name' => 'id_performance',
                            'required' => true,
                            'label' => t('Performance'),
                            'value' => model($obj->performance, 'id'),
                            'class' => '',
                            'options' => $context->performance->get()->toArray(),
                            'reverse' => true,
                            'text_key' => 'name',
                            'value_key' => 'id',
                            'type' => 'select',
                            ]) !!}
                                                                                                                                
                      {!! $form->text([
                        'name' => 'date',
                        'required' => true,
                        'label' => t('Date'),
                        'value' => model($obj, 'date'),
                        'class' => '',
                        'textarea' => true
                        ]) !!}
                                                              </div>
                      <div class="page_footer flex space-between">
            <div class="_ls">
                                        </div>
            <div class="_rs">
              <button type="submit" class="btn btn-primary btn-submit has-icon-right" name="button">
                <i class="ion-ios-download-outline"></i>
                {{ t('Save') }} Performance Dates              </button>
            </div>
          </div>
      {!! $form->end() !!}
        </div>
  </div>
</div>
@endsection
