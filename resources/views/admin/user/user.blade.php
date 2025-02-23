@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">
        <!-- Button trigger modal --
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h3 class="modal-title fs-5 font-weight-bold" id="exampleModalLabel">USER</h1>
                <button @click="resetForm()"  type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="" method="POST">
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                          </div>
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                          </div>
                          <div class="form-group">
                            <label for="pmail">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                          </div>
                          
                          <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                              <option value="Admin">Admin</option>
                              <option value="User">User</option>
                            </select>
                          </div>
                          {{-- <div class="form-group text-center d-flex justify-content-between">
                            <button type="submit" class="btn btn-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div> --}}
                        </form>
                      </div>
                </div>
                <div class="modal-footer">
                <button @click="resetForm()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel </button>
                <button 
                    v-if ="status == 'add' "
                    type="button" 
                    class="btn btn-success
                ">Save 
                </button>

                <button 
                    v-if ="status == 'edit' "
                    type="button" 
                    class="btn btn-success
                ">Edit 
                </button>
                </div>
            </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a @click="showModals()" href="#" class="btn btn-primary">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add User
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-border-less">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Nº</th>
                                            <th>UserName</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop through product_list to display user data -->
                                        <tr v-for="(user, index) in product_list" :key="user.id">
                                            <td>@{{ index + 1 }}</td>
                                            <td>@{{ user.name }}</td>
                                            <td>@{{ user.email }}</td>
                                            <td>@{{ user.gender }}</td>
                                            <td>@{{ user.role }}</td>
                                            <td>
                                                <a @click="getEdit(user)" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a @click="getDelete(user)" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ $users->links('vendor.pagination.bootstrap-5') }}
            {{-- @dd($users); --}}
        </div>
    </div>
@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!',
                status :'add',
                product_list:[],

            },
            created() {
                // this.showModals();
                this.fetchData();
            },
            methods: {
                fetchData() {
                    let vm = this;
                    $.LoadingOverlay("show");  // Corrected function name
                    axios.get('/admin/get-user')
                        .then(function (response) {
                            console.log(response.data);
                            vm.product_list = response.data; // Fix: response.data instead of response
                            $.LoadingOverlay("hide");
                        })
                        .catch(function (error) {
                            console.log(error);
                            $.LoadingOverlay("hide");
                        });
                },
                showModals() {
                    $('#exampleModal').modal('show');
                },
                closeModals() {
                    $('#exampleModal').modal('hide');
                },
                getEdit(){
                    //bind data to form 
                    this.showModals();
                    this.status = 'edit';
                },
                resetForm(){
                    //bind data to form 
                    this.status = 'add';
                    this.closeModals();
                },
                getDelete(){
                    //bnd data to form 
                        Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                        }).then((result) => {

                        if (result.isConfirmed) {
                            // process Deleted
                            Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                            });
                        }
                    });
                   
                },
                


                            },


        });
    </script>
    @endsection