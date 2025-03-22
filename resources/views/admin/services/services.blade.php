@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold">Service Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Services</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Add/Edit Service -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5 font-weight-bold" id="exampleModalLabel">Services</h3>
                        <button @click="resetForm()" type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form @submit.prevent="addservices">
                                <div class="form-group">
                                    <label for="servicesname">Service Name</label>
                                    <input v-model="form.name" type="text" class="form-control" id="servicesname" name="servicesname" required>
                                </div>

                                <div class="form-group">
                                    <label for="serviceImage">Service Image</label>
                                    <input type="file" class="form-control" id="serviceImage" @change="handleImageUpload">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="resetForm()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button @click="addservices()" v-if="status == 'add'" type="button" class="btn btn-success">Save</button>
                        <button @click="editservices" v-if="status == 'edit'" type="button" class="btn btn-success">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a @click="showModals()" href="#" class="btn btn-primary">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Service
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-border-less">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Nº</th>
                                            <th>Service Name</th>
                                            <th>Service Image</th> <!-- Column for image -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(service, index) in product_list" :key="service.id">
                                            <td>@{{ index + 1 }}</td>
                                            <td>@{{ service.name }}</td>
                                            <td >
                                                <img  style="width: 50px ; height: 50px;" v-if="service.image_url" :src="'/storage/' + service.image_url" alt="Service Image" width="100" height="100">
                                            </td>
                                            <td>
                                                <a @click="getEdit(service)" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a @click="getDelete(service)" class="btn btn-sm btn-danger">
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
        </div>
    </div>
@endsection

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
                image_url: null,  // To store the uploaded image
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                let vm = this;
                axios.get('/admin/get-services')
                    .then(response => {
                        console.log(response.data);
                        vm.product_list = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            showModals() {
                $('#exampleModal').modal('show');
            },
            closeModals() {
                $('#exampleModal').modal('hide');
            },
            getEdit(service) {
                console.log(service);
                this.form.id = service.id;
                this.form.name = service.name;
                this.form.image_url = service.image_url; // Load the current image
                this.status = 'edit';
                this.showModals();
            },
            resetForm() {
                this.status = 'add';
                this.form.id = null;
                this.form.name = null;
                this.form.image_url = null;
                this.closeModals();
            },
            getDelete(service) {
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
                        axios.post('/admin/delete-services', { id: service.id })
                            .then(response => {
                                if (response.status === 200) {
                                    vm.fetchData();
                                }
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                });
            },
            editservices() {
                let vm = this;
                let formData = new FormData();
                formData.append('id', this.form.id);
                formData.append('name', this.form.name);
                if (this.form.image_url) {
                    formData.append('image', this.form.image_url);
                }

                axios.post('/admin/edit-services', formData)
                    .then(response => {
                        if (response.status === 200) {
                            vm.resetForm();
                            vm.fetchData();
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            addservices() {
                let vm = this;
                let formData = new FormData();
                formData.append('name', this.form.name);
                if (this.form.image_url) {
                    formData.append('image', this.form.image_url);
                }

                axios.post('/admin/add-services', formData)
                    .then(response => {
                        if (response.status === 200) {
                            vm.resetForm();
                            vm.fetchData();
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            handleImageUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.form.image_url = file;
                }
            }
        }
    });
</script>
@endsection
