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
                        <h1 class="m-0 font-wiegth-bold ">Service Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">services</li>
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
                <h3 class="modal-title fs-5 font-weight-bold" id="exampleModalLabel">services</h1>
                <button @click="resetForm()"  type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form @submit.prevent="addservices">
                            <div class="form-group">
                                <label for="servicesname">services Name</label>
                                <input v-model="form.name" type="text" class="form-control" id="servicesname" name="servicesname" required>
                            </div>
                    
                        </form>
                        
                      </div>
                </div>
                <div class="modal-footer">
                <button @click="resetForm()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel </button>
                <button 
                    @click ="addservices()"
                    v-if ="status == 'add' "
                    type="button" 
                    class="btn btn-success
                ">Save 
                </button>

                <button 
                @click ="editservices"
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
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add services
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-border-less">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Nº</th>
                                            <th>servicesName</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop through product_list to display services data -->
                                        <tr v-for="(services, index) in product_list" :key="services.id">
                                            <td>@{{ index + 1 }}</td>
                                            <td>@{{ services.name }}</td>
                                        
                                            <td>
                                                <a @click="getEdit(services)" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a @click="getDelete(services)" class="btn btn-sm btn-danger">
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
            {{ $services->links('vendor.pagination.bootstrap-5') }}
            {{-- @dd($services); --}}
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
            
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                let vm = this;
                // ;
                axios.get('/admin/get-services')
                    .then(response => {
                        console.log(response.data);
                        vm.product_list = response.data;
                    })
                    .catch(error => {
                                    
                    })
                    .finally(() => {

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
                this.status = 'edit';
                this.showModals();
            },
            resetForm() {
                this.status = 'add';
                this.form.id = null;
                this.form.name = null;
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
                        ;
                        axios.post('/admin/delete-services', { id: item.id })
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
        
                            });
                    }
                });
            },
            editservices() {
                let vm = this;
                axios.post('/admin/edit-services', vm.form) // Fixed API endpoint
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

                    });
            },
            addservices() {
                let vm = this;
                ;
                axios.post('/admin/add-services', vm.form) // Fixed API endpoint
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

                    });
            }
        }
    });
</script>
@endsection

    @endsection