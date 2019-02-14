@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="card _main_card">
    @if (count($page['action_links']))
      <div class="_ph">
        <div class="_pas">
          <div class="action-bar-panel">
            @foreach ($page['action_links'] as $link)
              <a data-toggle="tooltip" data-placement="top" data-original-title="{{ $link['text'] }}" class="rounded-s action-link {{ (isset($link['class']) ? $link['class'] : '') }}" href="{{ $link['slug'] }}">
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
            @if (isset($obj->id_equipment_type) && $obj->id_equipment_type)
              <li class="nav-item">
                <a class="nav-link" href="#filter" role="tab" data-toggle="tab">Filter</a>
              </li>
              @if ($obj->id_equipment_type != 2)
                <li class="nav-item">
                    <a class="nav-link" href="#options" role="tab" data-toggle="tab">Options</a>
                </li>
              @endif
              <li class="nav-item">
                  <a class="nav-link" href="#variants" role="tab" data-toggle="tab">Variants</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#resources" role="tab" data-toggle="tab">Resources</a>
              </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="#media" role="tab" data-toggle="tab">Media</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#seo" role="tab" data-toggle="tab">SEO</a>
            </li>
          </ul>
        {!! $form->start('equipment-create-form', 'myForm tab-pad') !!}
          <div class="tab-content">
            <div class="tab-pane container active" id="information">
                {!! $form->text([
                  'name' => 'title',
                  'required' => true,
                  'label' => t('Title'),
                  'value' => model($obj, 'title'),
                  'class' => ''
                  ]) !!}

                {!! $form->text([
                  'name' => 'url',
                  'required' => true,
                  'label' => t('Url'),
                  'value' => model($obj, 'url'),
                  'class' => ''
                  ]) !!}

                {!! $form->text([
                  'name' => 'short_description',
                  'required' => true,
                  'label' => t('Short Description'),
                  'value' => model($obj, 'short_description'),
                  'class' => 'html-editor',
                  'textarea' => true
                  ]) !!}

                {!! $form->text([
                  'name' => 'description',
                  'required' => false,
                  'label' => t('Description'),
                  'value' => model($obj, 'description'),
                  'class' => 'html-editor',
                  'textarea' => true
                  ]) !!}

                {!! $form->text([
                  'name' => 'lead_time',
                  'required' => true,
                  'label' => t('Lead Time'),
                  'value' => model($obj, 'lead_time'),
                  'class' => ''
                  ]) !!}
                <div class="twof">
                  {!! $form->text([
                    'name' => 'price',
                    'required' => true,
                    'label' => t('Price'),
                    'value' => model($obj, 'price'),
                    'class' => ''
                    ]) !!}

                  {!! $form->text([
                    'name' => 'msrp',
                    'required' => true,
                    'label' => t('MSRP'),
                    'value' => model($obj, 'msrp'),
                    'class' => ''
                    ]) !!}
                </div>

                {!! $form->choice([
                  'name' => 'id_manufacturer',
                  'required' => true,
                  'label' => t('Manufacturer'),
                  'value' => $obj->id_manufacturer,
                  'class' => '',
                  'options' => $context->manufacturers->get()->toArray(),
                  'reverse' => true,
                  'text_key' => 'name',
                  'value_key' => 'id',
                  'type' => 'select'
                  ]) !!}

                {!! $form->choice([
                  'name' => 'id_equipment_type',
                  'required' => false,
                  'label' => t('Equipment Type'),
                  'value' => $obj->id_equipment_type,
                  'class' => '',
                  'options' => $context->equipment_type->get()->toArray(),
                  'reverse' => true,
                  'text_key' => 'name',
                  'value_key' => 'id',
                  'type' => 'select',
                  ]) !!}
              </div>
              <div class="tab-pane fade {{ ($obj->id_equipment_type == 2 ? 'compectors' : 'balers') }}" id="filter">
                @if (isset($obj->id_equipment_type) && $obj->id_equipment_type)
                  @include('equipment._tabs.filter', ['obj' => $obj->type->filter, 'main_obj' => $obj])
                @endif
              </div>
              <div role="tabpanel" class="tab-pane fade {{ ($obj->id_equipment_type == 2 ? 'compectors' : 'balers') }}" id="options">
                  @if ($obj->id_equipment_type && count(model($obj->type, 'options')))
                    @include('equipment._tabs.options', ['obj' => $obj->type->options])
                  @endif
              </div>
              @if (isset($obj->id_equipment_type) && $obj->id_equipment_type)
                <div class="tab-pane fade" id="variants">
                  @include('equipment._tabs.variants')
                </div>
              @endif
              <div role="tabpanel" class="tab-pane fade" id="resources">
                  @if ($obj->id_equipment_type && count(model($obj->type, 'options')))
                    @include('equipment._tabs.resources', ['obj' => $obj->type->options, 'pdf' => $obj->pdf])
                  @endif
              </div>
              <div role="tabpanel" class="tab-pane fade" id="media">
                @include('equipment._tabs.media')
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
                {{ t('Save') }} Equipment              </button>
            </div>
          </div>
      {!! $form->end() !!}
        </div>
  </div>
</div>
<script type="text/javascript">
  var equipment_type = {!! json_encode($context->equipment_type->get()->toArray()) !!};
  var equipment_category = {!! json_encode($context->equipment_category->get()->toArray()) !!}
</script>
@endsection
