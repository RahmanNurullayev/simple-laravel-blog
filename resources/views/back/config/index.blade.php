@extends('back.layouts.master')
@section('title','Tənzimləmələr')
@section('content')

<div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6></div>
            <div class="card-body">
            
            <form method="post" action="{{route('admin.config.update')}}" enctype="multipart/from-data">
            @csrf
             <div class="row">
             <div class="col-md-6">
             <div class="form-group">
             <label>Sayt basligi</label>
             <input type="text" name="title" required class="form-control" value="{{$config->title}}" />
             </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
             <label for="">Sayt aktivlik</label>
             <select name="active" id="" class="form-control">
             <option @if($config->active==1) selected @endif value="1">Aktiv</option>
             <option @if($config->active==0) selected @endif value="0">Passiv</option>
             </select>
             </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
             <label for="">Sayt logo</label>
             <input type="file" name="logo" required class="form-control" value="{{$config->logo}}" />
             </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
             <label for="">Sayt favicon</label>
             <input type="file" name="favicon" required class="form-control" value="{{$config->favicon}}" />
             </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
             <label for="">Facebook</label>
             <input type="text" name="facebook" required class="form-control" value="{{$config->facebook}}" />
             </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
             <label for="">Instagram</label>
             <input type="text" name="instagram" required class="form-control" value="{{$config->instagram}}" />
             </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
             <label for="">linkedin</label>
             <input type="text" name="linkedin" required class="form-control" value="{{$config->linkedin}}" />
             </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
             <label for="">Github</label>
             <input type="text" name="github" required class="form-control" value="{{$config->github}}" />
             </div>
             </div>
           </div>
             <div>
             <button type="submit" class="btn btn-block btn-md btn-success">Deyisdir</button>
             </div>
            </form>
            </div>
          </div>

@endsection 
