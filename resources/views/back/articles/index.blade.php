@extends('back.layouts.master')
@section('title','Yazılar')
@section('content')

<div class="card shadow mb-4">
            <div class="card-header py-3">
            <span class="m-0 font-weight-bold text-primary">@yield('title')</>
              <span class="m-0 font-weight-bold float-right text-primary">{{$articles->count() }} Məqalə</strong>
              <a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i>Silinən yazılar</a>
            
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Şəkil</th>
                      <th>Başlıq</th>
                      <th>Kateqoriya</th>
                      <th>Görünmə</th>
                      <th>Tarixi</th>
                      <th>Status</th>
                      <th>Əməliyyatlar</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($articles as $article)
                    <tr>
                      <td>
                      <img src="{{$article->image}}" width="200">
                      </td>
                      <td>{{$article->title}}</td>
                      <td>{{$article->getCategory->name}}</td>
                      <td>{{$article->hit}}</td>
                      <td>{{$article->created_at->diffForHumans()}}</td>
                      <td>
                      <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktiv" data-off="Passiv" data-onstyle="success" data-offstyle="danger" @if($article->status==1) checked @endif data-toggle="toggle"  >
                      </td>
                       <td>
                      <a target="_blank" href="{{route('single',[$article->getCategory->slug,$article->slug])}}" title="Göstər" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                      <a href="{{route('admin.yazilar.edit',$article->id)}}" title="Dəyişdir" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                      <a href="{{route('admin.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function() {
    $('.switch').change(function() {
      id=$(this)[0].getAttribute('article-id');
      statu=$(this).prop('checked');
       $.get("{{route('admin.switch')}}",{id:id,statu:statu}, function(data, status){
    console.log(data);
  });
    })
  })
</script>
@endsection
@endsection 
