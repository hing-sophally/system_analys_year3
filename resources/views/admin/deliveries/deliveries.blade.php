@extends('admin.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="app">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold"> Delivery Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">deliveries</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Add/Edit Customer -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5 font-weight-bold" id="exampleModalLabel">Delivery</h3>
                        <button @click="resetForm()" type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form action="" method="POST">
                                <!-- Name -->
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input v-model="form.name" type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input v-model="form.phone" type="text" class="form-control" id="phone" name="phone" required>
                                </div>

                                <!-- Alt Phone -->
                                <div class="form-group">
                                    <label for="alt_phone">Alternate Phone</label>
                                    <input v-model="form.alt_phone" type="text" class="form-control" id="alt_phone" name="alt_phone">
                                </div>

                                <!-- Gender -->
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select v-model="form.gender" class="form-control" id="gender" name="gender" required>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input v-model="form.email" type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <!-- Current Location -->
                                <div class="form-group">
                                    <label for="current_location">Current Location</label>
                                    <input v-model="form.current_location" type="text" class="form-control" id="current_location" name="current_location" required>
                                </div>

                                
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="resetForm()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button @click="addCustomer()" v-if="status === 'add'" type="button" class="btn btn-success">Save</button>
                        <button @click="editCustomer()" v-if="status === 'edit'" type="button" class="btn btn-success">Edit</button>
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
                                <a @click="showModal('add')" href="#" class="btn btn-primary">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Delivery 
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>Nº</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(customer, index) in customerList" :key="customer.id">
                                            <td>@{{ index + 1 }}</td>
                                            <td>@{{ customer.name }}</td>
                                            <td>@{{ customer.phone }}</td>
                                            <td>@{{ customer.gender }}</td>
                                            <td>@{{ customer.email }}</td>
                                            <td>@{{ customer.current_location }}</td>
                                            <td>
                                                <a @click="getEdit(customer)" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a @click="getDelete(customer)" class="btn btn-sm btn-danger">
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

            {{ $deliveries->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection

@section('script')
<script>
    var app = new Vue({
        el: '#app',
        data: {
            status: 'add',
            customerList: [],
            form: {
                id: null,
                name: null,
                phone: null,
                gender: 'male',
                alt_phone: null,
                email: null,
                current_location: null,
                point: 0 // Default to 0
            }
        },
        created() {
            this.fetchdeliveries();
        },
        methods: {
            fetchdeliveries() {
                axios.get('/admin/get-deliveries')
                    .then(response => {
                        this.customerList = response.data;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            showModal(status) {
                this.status = status;
                if (status === 'add') {
                    this.resetForm();
                }
                $('#exampleModal').modal('show');
            },
            closeModal() {
                $('#exampleModal').modal('hide');
            },
            getEdit(customer) {
                this.form.id = customer.id;
                this.form.name = customer.name;
                this.form.phone = customer.phone;
                this.form.gender = customer.gender;
                this.form.alt_phone = customer.alt_phone;
                this.form.email = customer.email;
                this.form.current_location = customer.current_location;
                this.status = 'edit';
                this.showModal('edit');
            },
            resetForm() {
                this.form.id = null;
                this.form.name = '';
                this.form.phone = '';
                this.form.gender = 'male';
                this.form.alt_phone = '';
                this.form.email = '';
                this.form.current_location = '';
            },
            getDelete(customer) {
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
                        axios.post('/admin/delete-deliveries', { id: customer.id })
                            .then(response => {
                                if (response.status === 200) {
                                    vm.fetchdeliveries();
                                }
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                });
            },
            editCustomer() {
                let vm = this;
                axios.post('/admin/edit-deliveries', vm.form)
                    .then(response => {
                        if (response.status === 200) {
                            vm.resetForm();
                            vm.fetchdeliveries();
                            vm.closeModal(); Array
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            },
            addCustomer() {
                let vm = this;
                axios.post('/admin/add-deliveries', vm.form)
                    .then(response => {
                        if (response.status === 200) {
                            vm.resetForm();
                            vm.fetchdeliveries();
                            vm.closeModal();
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    });
</script>
@endsection
