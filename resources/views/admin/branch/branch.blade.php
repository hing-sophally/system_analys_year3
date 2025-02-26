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
                        <h1 class="m-0 font-wiegth-bold ">Branch Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Branch</li>
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
                <h3 class="modal-title fs-5 font-weight-bold" id="exampleModalLabel">branch</h1>
                <button @click="resetForm()"  type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form @submit.prevent="addbranch">
                            <div class="form-group">
                                <label for="branchname">Branch Name</label>
                                <input v-model="form.name" type="text" class="form-control" id="branchname" name="branchname" required>
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo URL</label>
                                <input v-model="form.logo" type="text" class="form-control" id="logo" name="logo">
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input v-model="form.location" type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input v-model="form.phone" type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="alt_phone">Alternative Phone</label>
                                <input v-model="form.alt_phone" type="text" class="form-control" id="alt_phone" name="alt_phone">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input v-model="form.email" type="email" class="form-control" id="email" name="email" required>
                            </div>
                            {{-- <div class="modal-footer">
                                <button @click="resetForm()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button v-if="status == 'add'" @click="addbranch()" type="submit" class="btn btn-success">Save</button>
                                <button v-if="status == 'edit'" @click="editbranch()" type="submit" class="btn btn-primary">Edit</button>
                            </div> --}}
                        </form>
                        
                      </div>
                </div>
                <div class="modal-footer">
                <button @click="resetForm()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel </button>
                <button 
                    @click ="addbranch()"
                    v-if ="status == 'add' "
                    type="button" 
                    class="btn btn-success
                ">Save 
                </button>

                <button 
                @click ="editbranch"
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
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add branch
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-border-less">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Nº</th>
                                            <th>branchName</th>
                                            <th>Logo</th>
                                            <th>Location</th>
                                            <th>Phone</th>
                                            <th>Alt_phone</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop through product_list to display branch data -->
                                        <tr v-for="(branch, index) in product_list" :key="branch.id">
                                            <td>@{{ index + 1 }}</td>
                                            <td>@{{ branch.name }}</td>
                                            <td>@{{ branch.logo }}</td>
                                            <td>@{{ branch.location }}</td>
                                            <td>@{{ branch.phone }}</td>
                                            <td>@{{ branch.alt_phone }}</td>
                                            <td>@{{ branch.email }}</td>
                                            <td>
                                                <a @click="getEdit(branch)" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a @click="getDelete(branch)" class="btn btn-sm btn-danger">
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
            {{ $branches->links('vendor.pagination.bootstrap-5') }}
            {{-- @dd($branches); --}}
        </div>
    </div>
@endsection

@section('script')
@section('script')
<script>
    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!',
            status: 'add',
            product_list: [],
            form: {
                id: null,
                name: null,
                logo: null,
                location:null,
                phone: null,
                alt_phone: null,
                email: null
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                let vm = this;
                $.LoadingOverlay("show");
                axios.get('/admin/get-branch')
                    .then(response => {
                        console.log(response.data);
                        vm.product_list = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    })
                    .finally(() => {
                        $.LoadingOverlay("hide");
                    });
            },
            showModals() {
                $('#exampleModal').modal('show');
            },
            closeModals() {
                $('#exampleModal').modal('hide');
            },
            getEdit(item) {
                console.log(item);
                this.form.id = item.id;
                this.form.name = item.name;
                this.form.logo = item.logo;
                this.form.location = item.location;
                this.form.phone = item.phone;
                this.form.alt_phone = item.alt_phone;
                this.form.email = item.email;
                this.status = 'edit';
                this.showModals();
            },
            resetForm() {
                this.status = 'add';
                this.form.id = null;
                this.form.name = null;
                this.form.logo = null;
                this.form.location = null;
                this.form.phone = null;
                this.form.alt_phone = null;
                this.form.email = null;
                this.closeModals();
            },
            getDelete(item) {
                let vm = this;
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
                        $.LoadingOverlay("show");
                        axios.post('/admin/delete-branch', { id: item.id })
                            .then(response => {
                                if (response.status === 200) {
                                    vm.fetchData();
                                }
                                console.log(response.data);
                            })
                            .catch(error => {
                                console.error(error);
                            })
                            .finally(() => {
                                $.LoadingOverlay("hide");
                            });
                    }
                });
            },
            editbranch() {
                let vm = this;
                $.LoadingOverlay("show");
                axios.post('/admin/edit-branch', vm.form) // Fixed API endpoint
                    .then(response => {
                        if (response.status === 200) {
                            vm.resetForm();
                            vm.fetchData();
                            // vm.closeModals();
                        }
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.error(error);
                    })
                    .finally(() => {
                        $.LoadingOverlay("hide");
                    });
            },
            addbranch() {
                let vm = this;
                $.LoadingOverlay("show");
                axios.post('/admin/add-branch', vm.form) // Fixed API endpoint
                    .then(response => {
                        if (response.status === 200) {
                            vm.resetForm();
                            vm.fetchData();
                            // vm.closeModals();
                        }
                        console.log(response.data);
                    })
                    .catch(error => {
                        console.error(error);
                    })
                    .finally(() => {
                        $.LoadingOverlay("hide");
                    });
            }
        }
    });
</script>
@endsection

    @endsection