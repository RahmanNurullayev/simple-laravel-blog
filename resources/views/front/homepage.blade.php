@extends('front.layouts.master')
@section('title')
Rehmanin Bloqu
@endsection
@section('content')
<div class="col-md-9 mx-auto">
  @include('front.widgets.articleList')
</div>
      
@include('front.widgets.categorywidget') 
 @endsection 

  