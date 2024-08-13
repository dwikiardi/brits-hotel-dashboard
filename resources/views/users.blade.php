@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <button class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#modalAddUser">+&nbsp; New User</button>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="tableUser">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->id}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-row justify-content-center">
                                            <div >
                                                <button type="button" value="{{$user->id}}" id='btn-edit-user' class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalEditUser">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                </button>
                                            </div>
                                            <div class="mt-2">/</div>
                                            <div >
                                                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link"><i class="cursor-pointer fas fa-trash text-secondary"></i></button>
                                                  </form>
                                            </div>
                                          </div>
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
</div>

<div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUser" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalEditUser1">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-edit-user">
                <input type="hidden" id="id" name="id">
                <div class="mb-3">
                  <label for="exampleInputName1" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="btn-editBarang" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="modalAddUser" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modalAddUser1">Add User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-add-user">
                {{-- <input type="hidden" id="id" name="id"> --}}
                <div class="mb-3">
                  <label for="exampleInputName1" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="btn-addUser" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $(document).ready(function () {
            $('body').on('click', '#btn-edit-user', function (){
                let user_id = $(this).val();
                //fetch detail post with ajax
                $.ajax({
                    url: `/users/${user_id}/edit`,
                    type: "GET",
                    cache: false,
                    success:function(response){
                        console.log(response);
                        //fill data to form
                        $('#modalEditUser #form-edit-user #id').val(response.id);
                        $('#modalEditUser #form-edit-user #name').val(response.name);
                        $('#modalEditUser #form-edit-user #email').val(response.email);
                    }
                });
            });

            $('#btn-editBarang').on('click', function (){
                let user_id = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let form = $('#form-edit-user')[0]
                let data = new FormData(form)
                console.log(data)
                $.ajax({
                    type: "POST",
                    url: `/users/${user_id}`,
                    data: data ,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {
                        if(response == 'success'){
                            $('#modalEditUser').modal('hide');
                            // Swal.fire(
                            //     'Berhasil!',
                            //     'Barang sudah di update!',
                            //     'success'
                            // )
                            // $('#tableUser').reload();
                            $('#modalEditUser #form-edit-user').trigger("reset");

                            location.reload();
                        }
                    },
                    error: function(response){
                        console.log(response)
                    }
                });
            });

            $('#btn-addUser').on('click', function (){
                let user_id = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let form = $('#form-add-user')[0]
                let data = new FormData(form)
                console.log(data)
                $.ajax({
                    type: "POST",
                    url: `/users/tambah`,
                    data: data ,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {
                        if(response == 'success'){
                            $('#modalEditUser').modal('hide');
                            // Swal.fire(
                            //     'Berhasil!',
                            //     'Barang sudah di update!',
                            //     'success'
                            // )
                            // $('#tableUser').reload();
                            $('#modalEditUser #form-edit-user').trigger("reset");

                            location.reload();
                        }
                    },
                    error: function(response){
                        console.log(response)
                    }
                });
            });
        });
    });
</script>

@endsection



