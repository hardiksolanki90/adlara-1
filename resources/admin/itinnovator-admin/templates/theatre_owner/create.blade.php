@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="card">
    <div class="card-body">
          {!! $form->start('theatre_owner-create-form', 'myForm') !!}
          
        {!! $form->text([
          'name' => 'name',
          'required' => true,
          'label' => t('Name'),
          'value' => model($obj, 'name'),
          'class' => ''
          ]) !!}
                          
        {!! $form->text([
          'name' => 'email',
          'required' => true,
          'label' => t('Email'),
          'value' => model($obj, 'email'),
          'class' => ''
          ]) !!}
                                                                                                          {!! $form->choice([
                    'name' => 'id_category',
                    'required' => true,
                    'label' => t('Category'),
                    'value' => model($obj->performance_category, 'id'),
                    'class' => '',
                    'options' => $context->performance_category->get()->toArray(),
                    'reverse' => true,
                    'text_key' => 'name',
                    'value_key' => 'id',
                    'type' => 'select',
                    ]) !!}
                                                                                  <button type="submit" class="btn btn-primary btn-submit has-icon-right" name="button">
                    <i class="ion-ios-download-outline"></i>
                    {{ t('Save') }} Theatre Owner
                  </button>
                  {!! $form->end() !!}
                    </div>
  </div>
</div>
@endsection
