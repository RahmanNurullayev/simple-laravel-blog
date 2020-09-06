@extends('back.layouts.master')
@section('title','Yeni yazı yaz')
@section('content')

<div class="card shadow mb-4">
            <div class="card-header py-3">
            <span class="m-0 font-weight-bold text-primary">@yield('title')</span>
             </div>
            <div class="card-body">
            @if($errors->any())
            <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </div>
            @endif
              <form method="post" action="{{route('admin.yazilar.store')}}" enctype="multipart/from-data">
              @csrf
              <div class="form-group">
              <label>Form Başlıq</label>
              <input type="text" name="title" class="form-control" required>
              </div>
              <div class="form-group">
              <label for="">Yazı Başlıq</label>
              <select class="form-control" name="category" required id="">
              <option value="">Seçim edin </option>
              @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
              </select>
              </div>
              <div class="form-group">
              <label>Form Şəkil</label>
              <input type="file" name="image" class="form-control" >
              </div>
              <div class="form-group">
              <label>Form Məzmun</label>
              <textarea type="text" id="editor" name="content" rows="4" class="form-control" required></textarea>
              </div>
              <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">Yazı yarat</button>
               </div>
              </form>
            </div>
          </div>
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection          
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
$(document).ready(function() {
  $('#editor').summernote(
      {
          'height':300
      }
  );
});
</script>
@endsection
@endsection