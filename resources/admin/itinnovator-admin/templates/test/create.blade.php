@extends('layouts.dashboard')
@section('content')
  {!! $form->start('test-create-form', 'myForm') !!}

      {!! $form->text([
        'name' => 'name_test',
        'required' => true,
        'label' => t('Name'),
        'value' => model($obj, 'name'),
        'class' => ''
      ]) !!}

  <button type="submit" class="btn btn-primary btn-submit has-icon-right" name="button">
    <i class="ion-ios-download-outline"></i>
    {{ t('Save') }} test
  </button>
{!! $form->end() !!}
@endsection
