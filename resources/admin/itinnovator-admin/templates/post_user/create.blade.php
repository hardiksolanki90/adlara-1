@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="card">
    <div class="card-body">
          {!! $form->start('post_user-create-form', 'myForm') !!}
          
        {!! $form->text([
          'name' => 'full_name',
          'required' => true,
          'label' => t('Full Name'),
          'value' => model($obj, 'full_name'),
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
                    'name' => 'id_country',
                    'required' => true,
                    'label' => t('Country'),
                    'value' => model($obj->countries, 'id'),
                    'class' => '',
                    'options' => $context->countries->get()->toArray(),
                    'reverse' => true,
                    'text_key' => 'name',
                    'value_key' => 'id',
                    'type' => 'select',
                    ]) !!}
                                                                                  <button type="submit" class="btn btn-primary btn-submit has-icon-right" name="button">
                    <i class="ion-ios-download-outline"></i>
                    {{ t('Save') }} Post User
                  </button>
                  {!! $form->end() !!}
                    </div>
  </div>
</div>
@endsection
