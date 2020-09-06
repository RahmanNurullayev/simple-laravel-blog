@extends('front.layouts.master')
@section('title',$category->name.' Kateqoriyası | '.count($articles). ' yazı tapıldı')
@section('content')
<div class="col-md-9 mx-auto">
@include('front.widgets.articleList')
</div>    
@include('front.widgets.categorywidget')
 @endsection 

  