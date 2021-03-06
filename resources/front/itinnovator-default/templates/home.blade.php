@extends('layouts.default')
@section('content')
<div class="ui vertical stripe segment">
  <div class="ui middle aligned stackable grid container">
    <div class="row">
      <div class="eight wide column">
        <h3 class="ui header">We Help Companies and Companions</h3>
        <p>We can give your company superpowers to do things that they never thought possible. Let us delight your customers and empower your needs...through pure data analytics.</p>
        <h3 class="ui header">We Make Bananas That Can Dance</h3>
        <p>Yes that's right, you thought it was the stuff of dreams, but even bananas can be bioengineered.</p>
      </div>
      <div class="six wide right floated column">
        <img src="%MEDIA_wireframe/white-image.png%" class="ui large bordered rounded image">
      </div>
    </div>
    <div class="row">
      <div class="center aligned column">
        <a class="ui huge button">Check Them Out</a>
      </div>
    </div>
  </div>
</div>


<div class="ui vertical stripe quote segment">
  <div class="ui equal width stackable internally celled grid">
    <div class="center aligned row">
      <div class="column">
        <h3>"What a Company"</h3>
        <p>That is what they all say about us</p>
      </div>
      <div class="column">
        <h3>"I shouldn't have gone with their competitor."</h3>
        <p>
          <img src="%MEDIA_avatar/nan.jpg%" class="ui avatar image"> <b>Nan</b> Chief Fun Officer Acme Toys
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
