@extends('front.layouts.master')
@section('title','elaqe')
@section('bg','https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTnXe49ZYnYP-Fiy1rxrKFlB0eqKO9Qe5R7sQ&usqp=CAU')
@section('content')

<div class="col-md-8">
@if(session('success'))
    <div class="alert alert-success">
     {{session('success')}}
    </div>
@endif 
  @if($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
      </ul>
  </div>
  @endif   
        <p>Bizimlə əlaqəyə keçə bilərsiniz !</p>
        <form method="post" action="{{route('contact.post')}}">
            @csrf
          <div class="control-group">
            <div class="form-group controls">
              <label>Ad Soyad</label>
              <input type="text" class="form-control" value="{{old('name')}}" placeholder="Ad Soyadınız" name="name" required> 
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group controls">
              <label>Email Adresi</label>
              <input type="email" value="{{old('email')}}" class="form-control" placeholder="Email Adresiniz" name="email" required>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group controls">
              <label>Mövzu</label>
              <select class="form-control" name="topic">
                  <option @if(old('topic')=='Məlumat') selected @endif>Məlumat</option>
                  <option @if(old('topic')=='Dəstək') selected @endif>Dəstək</option>
                  <option @if(old('topic')=='Ümumi') selected @endif>Ümumi</option>
              </select>
               </div>
          </div>
          <div class="control-group">
            <div class="form-group controls">
              <label>Mesajınız</label>
              <textarea rows="5" name="message" class="form-control" placeholder="Mesajınız" >{{old('message')}}</textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Göndər</button>
        </form>
      </div>
      <div class="col-md-4">
     <div class="card card-default">
         <div class="card-body">Panel Content</div>
         Adress;jkfdkldfkldfdk
         </div>
         </div>
      </div>
           
      
  
 @endsection 


  <!-- Main Content -->
 

 

