@extends('back.layouts.master')
@section('title','Silinən yazılar')
@section('content')

<div class="card shadow mb-4">
            <div class="card-header py-3">
            <span class="m-0 font-weight-bold text-primary">@yield('title')</>
              <span class="m-0 font-weight-bold float-right text-primary">{{$articles->count() }} Məqalə</strong>
              <a href="{{route('admin.yazilar.index')}}" class="btn btn-primary btn-sm">Aktiv yazılar</a>
            
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
                      <th>Əməliyyatlar</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($articles as $article)
                    <tr>
                      <td>
                      <img src="{{$article->image}}"width="200" alt="">
                      </td>
                      <td>{{$article->title}}</td>
                      <td>{{$article->getCategory->name}}</td>
                      <td>{{$article->hit}}</td>
                      <td>{{$article->created_at->diffForHumans()}}</td>
                      <td>
                      <a href="{{route('admin.recover.article',$article->id)}}" title="Geri qaytar" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                      <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Birdəfəlik Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection 
