@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="card">
    <div class="card-body">
          {!! $form->start('test2-create-form', 'myForm') !!}
          
        {!! $form->text([
          'name' => 'name',
          'required' => true,
          'label' => t('Name'),
          'value' => model($obj, 'name'),
          'class' => ''
          ]) !!}
                          
        {!! $form->text([
          'name' => 'location',
          'required' => true,
          'label' => t('Location'),
          'value' => model($obj, 'location'),
          'class' => ''
          ]) !!}
                                                  <button type="submit" class="btn btn-primary btn-submit has-icon-right" name="button">
                    <i class="ion-ios-download-outline"></i>
                    {{ t('Save') }} test2
                  </button>
                  {!! $form->end() !!}
                    </div>
  </div>
</div>
@endsection
