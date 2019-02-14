@if (count($obj))
@if ($main_obj->id_equipment_type)
  <div class="_options">
    <div class="_block">
        {!! $form->choice([
          'name' => 'id_equipment_category',
          'required' => false,
          'label' => t($main_obj->type->name . ' Category'),
          'value' => model($main_obj, 'id_category'),
          'class' => '',
          'options' => $main_obj->type->categories()->get()->toArray(),
          'reverse' => true,
          'text_key' => 'name',
          'value_key' => 'id',
          'type' => 'select',
          ]) !!}
    </div>
  </div>
  @endif
  <div class="_options flex row-wrap">
    @foreach($obj as $o)
      @if ($o->input_type == 'text' || $o->input_type == 'textarea')
        <div class="_block">
          {!! $form->text([
            'name' => 'option['.$o->id.']',
            'required' => false,
            'label' => t($o->name),
            'value' => model(model($selected_options_values, $o->id, null, 'array'), 'value', null, 'array'),
            'class' => '',
            'textarea' => ($o->input_type == 'textarea' ? true : false)
            ]) !!}
        </div>
      @endif

      @if ($o->input_type == 'select' || $o->input_type == 'radio' || $o->input_type == 'checkbox')
        @if ($o->name != 'Manufacturer')
          <div class="_block">
            {!! $form->choice([
              'name' => 'option['.$o->id.']' ,
              'required' => false,
              'label' => t($o->name),
              'value' => model(model($selected_options_values, $o->id, null, 'array'), 'value', null, 'array'),
              'class' => '',
              'options' => $o->options->toArray(),
              'reverse' => true,
              'text_key' => 'value',
              'value_key' => 'id',
              'type' => $o->input_type,
              ]) !!}
          </div>
        @endif
      @endif
    @endforeach
  </div>
@endif
