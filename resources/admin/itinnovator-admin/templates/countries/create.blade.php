@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="card">
    <div class="card-body">
          {!! $form->start('countries-create-form', 'myForm') !!}
          
        {!! $form->text([
          'name' => 'name',
          'required' => true,
          'label' => t('Name'),
          'value' => model($obj, 'name'),
          'class' => ''
          ]) !!}
                          
        {!! $form->text([
          'name' => 'iso_code',
          'required' => true,
          'label' => t('Iso Code'),
          'value' => model($obj, 'iso_code'),
          'class' => ''
          ]) !!}
                                                  <button type="submit" class="btn btn-primary btn-submit has-icon-right" name="button">
                    <i class="ion-ios-download-outline"></i>
                    {{ t('Save') }} Countries
                  </button>
                  {!! $form->end() !!}
                    </div>
  </div>
</div>
@endsection
