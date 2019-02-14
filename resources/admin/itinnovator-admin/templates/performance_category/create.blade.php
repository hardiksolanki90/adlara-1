@extends('layouts.dashboard')
@section('content')
<div class="con">
  <div class="card">
    <div class="card-body">
          {!! $form->start('performance_category-create-form', 'myForm') !!}
          
        {!! $form->text([
          'name' => 'name',
          'required' => true,
          'label' => t('Name'),
          'value' => model($obj, 'name'),
          'class' => ''
          ]) !!}
                          
        {!! $form->text([
          'name' => 'url',
          'required' => true,
          'label' => t('Url'),
          'value' => model($obj, 'url'),
          'class' => ''
          ]) !!}
                                                  <button type="submit" class="btn btn-primary btn-submit has-icon-right" name="button">
                    <i class="ion-ios-download-outline"></i>
                    {{ t('Save') }} Performance Category
                  </button>
                  {!! $form->end() !!}
                    </div>
  </div>
</div>
@endsection
