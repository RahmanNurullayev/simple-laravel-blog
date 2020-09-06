@extends('back.layouts.master')
@section('title','Bütün Kateqoriyalar')
@section('content')
<div class="row">

<div class="col-md-4">
<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Yeni Kateqoriya Yarat</h6>
                </div>
                <div class="card-body">
                 <form method="post" action="{{route('admin.category.create')}}">
                 @csrf
                 <div class="form-group">
                 <label>Kateqoriya adı</label>
                 <input type="text" class="form-control" name="category" required />
                 </div>
                 <div class="form-group">
                 <button type="submit" class="btn btn-block btn-primary">Əlavə Et</button>
                 </div>
                 </form>
                 </div>
              </div>

</div>
<div class="col-md-8">
<div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kateqoriya adı</th>
                      <th>Yazı sayı</th>
                      <th>Status</th>
                      <th>Əməliyyatlar</th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($categories as $category)
                    <tr>
                      <td>{{$category->name}}</td>
                      <td>{{$category->articleCount()}}</td>
                       <td>
                      <input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="Aktiv" data-off="Passiv" data-onstyle="success" data-offstyle="danger" @if($category->status==1) checked @endif data-toggle="toggle"  >
                      </td>
                       <td>
                       <a category-id="{{$category->id}}" class="btn btn-sm btn-primary edit-click"title="Kateqoriya dəyiş" ><i class="fa fa-edit text-white"></i></a>
                       <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->articleCount()}}" class="btn btn-sm btn-danger remove-click"title="Kateqoriya sil" ><i class="fa fa-times text-white"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
              </div>
                  </div>
              </div>

</div>
</div>
<div id="deleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
 <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kateqoriya sil</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
  <div id="body" class="modal-body">
  <div class="alert alert-danger" id="articleAlert"></div>
  </div>     
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Bağla</button>
        <form action="{{route('admin.category.delete')}}" method="post">
        @csrf
        <input type="hidden" name="id" id="deleteId">
       <button id="deleteButton" type="submit" class="btn btn-success">Sil</button>
        </form>
      </div>
      </form>
    </div>
</div>


<div id="editModal" class="modal">
  <div class="modal-dialog">
 <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kateqoriya dəyişiklik et</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
      <div class="modal-body">
        <form method="post" action="{{route('admin.category.update')}}">
        @csrf
        <div class="form-group">
             <label for="">Kateqoriya adı</label>
             <input id="category" type="text" name="category" class="form-control">
             <input type="hidden" name="id" id="category_id">
        </div>
        <div class="form-group">
             <label for="">Kateqoriya slug</label>
             <input id="slug" type="text" name="slug" class="form-control">
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Bağla</button>
        <button type="submit" class="btn btn-success">Yadda saxla</button>
      </div>
      </form>
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
    $('.remove-click').click(function(){
      id=$(this)[0].getAttribute('category-id');
      count=$(this)[0].getAttribute('category-count');
      name=$(this)[0].getAttribute('category-name');
      if(id==1){
        $('#articleAlert').html(name+' kateqoriyası silinə bilməz. Sabit kateqoriyadır');
        $('#body').show();
        $('#deleteButton').hide();
        $('#deleteModal').modal();
        return;
      }
      $('#deleteButton').show();
      $('#deleteId').val(id);
      $('#articleAlert').html('');
      $('#body').hide();
      if(count>0){
        $('#articleAlert').html('Bu kateqoriyaya adi '+count+' yazı var. Silmək istədiyinizə əminsiniz? ');
        $('#body').show();
      }
      $('#deleteModal').modal();
    });

    $('.edit-click').click(function(){
      id=$(this)[0].getAttribute('category-id');
      $.ajax({
        type:'GET',
        url:'{{route('admin.category.getData')}}',
        data:{id:id},
        success:function(data){
          console.log(data);
          $('#category').val(data.name);
          $('#slug').val(data.slug);
          $('#category_id').val(data.id);
          $('#editModal').modal();
        }
      });
    });

    $('.switch').change(function() {
      id=$(this)[0].getAttribute('category-id');
      statu=$(this).prop('checked');
       $.get("{{route('admin.category.switch')}}",{id:id,statu:statu}, function(data, status){
    console.log(data);
  });
    })
  })
</script>
@endsection
@endsection 
