@extends('Admin.layouts.app')
@section('title', 'Danh sách tài khoản')
@section('header')
@include('Admin.includes.header', ['function' => 'Danh sách Tài Khoản'])
@endsection

@section('content')
<div class="col-md-12">
                           
                            </div>
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">assignment</i>
                                </div>

                                <div class="card-content">
                                    <h4 class="card-title">List Users</h4>
                                    
                                                 @if (session('update'))
                                                    <div class="alert alert-success">
                                                        {{ session('update') }}
                                                    </div>
                                                 @endif

                                                 @if (session('delete'))
                                                    <div class="alert alert-success">
                                                        {{ session('update') }}
                                                    </div>
                                                 @endif
                                                 
                                                <div class='row'>
                                                    <label class="col-sm-2 label-on-left">Number of rows: </label>
                                                    <div class="col-sm-7">
                                                    <select
                                                    id = "selectNumber"
                                                     data-style="select-with-transition" title="Numbers result" data-size="7">
                                                        
                                                        <option value="1" selected="">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="0">All</option>
                                                       
                                                    </select>
                                                </div>
                                                </div>

                                                <div>
                                                    <select
                                                    id = "selectRole"
                                                     class="selectpicker" data-style="select-with-transition" title="Choose Role" data-size="7">
                                                        <option value="All" selected="">All Role</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Collab">Collab</option>
                                                        <option value="Member">Member</option>
                                                    </select>
                                                </div>

                                    <div id="tableUsers" class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>First name</th>
                                                    <th>Last name</th>
                                                    <th>Role</th>
                                                    <th>Email</th>
                                                    <th>Since</th>
                                                    <th>Last login</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td class="text-center">{{ $user->id }}</td>
                                                        <td>{{ $user->first_name }}</td>
                                                        <td>{{ $user->last_name }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td>{{ $user->last_login }}</td>

                                                        <td class="td-actions text-right">
              
                                                        <a type="button" rel="tooltip" 
                                                        href= {{ route('admin.user.edit', ['id'=> $user->id]) }} 
                                                        class="btn btn-success" data-original-title="" title="">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <button 
                                                            onclick = "changeDeleteUrl({{ $user['id'] }})"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            type="button" rel="tooltip" class="btn btn-danger">
                                                            <i class="material-icons">close</i>
                                                        </button>
                                                    </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                     {{ $users->links('Admin.layouts.pagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection

@section('js')

<script>
    $('#selectRole').on('change', function () {
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          var keyword = $('#searchName').val();
          var number = $('#selectNumber').val();
          var role = $('#selectRole').val();

          console.log('key = '+keyword+' number = '+number+ ' role = '+role);
          $.ajax({
                    url : '{{ route('admin.user.search') }}',
                    type : 'GET',
                    dataType : 'text',
                     data : {
                       name : keyword,
                       number : number,
                       role : role
                    },
                    success : function (result){
                        $('#tableUsers').html(result);
                    }
                });
});
</script>

<script>
     $('#selectNumber').on('change', function () {
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          var keyword = $('#searchName').val();
          var number = $('#selectNumber').val();
          var role = $('#selectRole').val();

          $.ajax({
                    url : '{{ route('admin.user.search') }}',
                    type : 'GET',
                    dataType : 'text',
                     data : {
                       name : keyword,
                       number : number,
                       role : role
                    },
                    success : function (result){
                        $('#tableUsers').html(result);
                    }
                });
});
</script>


<script>
$(document).ready(function(){
    
});
function search(str) { 
         
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          var keyword = $('#searchName').val();
          var number = $('#selectNumber').val();
          var role = $('#selectRole').val();
          $.ajax({
                    url : '{{ route('admin.user.search') }}',
                    type : 'GET',
                    dataType : 'text',
                     data : {
                       name : keyword,
                       number : number,
                       role : role
                    },
                    success : function (result){
                        $('#tableUsers').html(result);
                    }
                });
}
</script>

<script>

    $(document).on('click','.pagination a',function(event){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getUsers(page);
    
    });

    function getUsers(page)
    {   
         var number = $('#selectNumber').val();
         var role = $('#selectRole').val();
         var keyword = $('#searchName').val();

         if(keyword == '')
         {
             $.ajax({
                    url : '{{ route('admin.user.search').'?page=' }}'+ page,
                    type : 'GET',
                    dataType : 'text',
                     data : {
                       number : number,
                       role : role
                    },
                    success : function (result){
                        $('#tableUsers').html(result);
                    }
                });
         }
         else
        {
             $.ajax({
                    url : '{{ route('admin.user.search').'?page=' }}'+ page,
                    type : 'GET',
                    dataType : 'text',
                     data : {
                       name : keyword,
                       number : number,
                       role : role
                    },
                    success : function (result){
                        $('#tableUsers').html(result);
                    }
                });
        }
    }
</script>

<!-- Delete Modal -->
<script>
      function changeDeleteUrl(id) {
        $('#idUser').val(id);
        console.log($('#idUser').val());
      }
</script>

<script >
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })
</script>

@endsection

<!-- MODAL -->
@section('modal')
  <!--            Modal  -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Warining !!!</h5>
      </div>
      <div class="modal-body">
       Do u wanna delete that users
      </div>
      <div class="modal-footer">
      
        <form method ="post" action="{{ route('admin.user.delete') }}">
       @csrf
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger"><span class="oi oi-delete">Yes</span></button>
        <input type="hidden" id ="idUser" name ="idUser" value=0>
        </form>
        
      </div>
    </div>
  </div>
</div>
<!--  END MODAL -->
@endsection