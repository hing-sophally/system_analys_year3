@extends('admin.layout')

@section('content')
    <!-- Content Wrapper -->
    <div class="content-wrapper" id="app">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold">Invoice Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                            <li class="breadcrumb-item active">Invoices</li>
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
                        <h3 class="modal-title fs-5 font-weight-bold" id="exampleModalLabel">Invoice Form</h3>
                        <button @click="resetForm()" type="button" class="btn-close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form @submit.prevent="saveInvoice">
                                <div class="form-group">
                                    <label for="customer">Customer</label>
                                    <select v-model="form.customer_id" class="form-control" required>
                                        <option v-for="customer in customers" :value="customer.id">@{{ customer.name }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="user">User</label>
                                    <select v-model="form.user_id" class="form-control" required>
                                        <option v-for="user in users" :value="user.id">@{{ user.user_name }}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="grand_total">Grand Total</label>
                                    <input v-model="form.grand_total" type="number" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="delivery_id">Delivery ID</label>
                                    <input v-model="form.delivery_id" type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="pick_up_date_time">Pick-up Date & Time</label>
                                    <input v-model="form.pick_up_date_time" type="datetime-local" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select v-model="form.status" class="form-control" required>
                                        <option value="on_hold">On Hold</option>
                                        <option value="processing">Processing</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="resetForm()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button v-if="status == 'add'" @click="saveInvoice()" type="button" class="btn btn-success">Save</button>
                        <button v-if="status == 'edit'" @click="saveInvoice()" type="button" class="btn btn-warning">Update</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice List -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a @click="showModal()" href="#" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i> Add Invoice
                                </a>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th>ID</th>
                                            <th>Customer</th>
                                            <th>User</th>
                                            <th>Grand Total</th>
                                            <th>Pick-up Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="invoice in invoices" :key="invoice.id">
                                            <td>@{{ invoice.id }}</td>
                                            <td>@{{ invoice.customer_name }}</td>
                                            <td>@{{ invoice.user_name }}</td>
                                            <td>@{{ invoice.grand_total }}</td>
                                            <td>@{{ invoice.pick_up_date_time }}</td>
                                            <td>@{{ invoice.status }}</td>
                                            <td>
                                                <a @click="editInvoice(invoice)" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a @click="deleteInvoice(invoice.id)" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
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
            {{ $invoices->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection

@section('script')
<script>
    var app = new Vue({
        el: '#app',
        data: {
            status: 'add',
            invoices: [],
            customers: [],
            users: [],
            form: {
                id: null,
                customer_id: null,
                user_id: null,
                grand_total: null,
                delivery_id: null,
                pick_up_date_time: null,
                status: "on_hold"
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                axios.get('/admin/get-invoices').then(response => {
                    this.invoices = response.data.invoices;
                    this.customers = response.data.customers;
                    this.users = response.data.users.map(user => ({
                        id: user.id,
                        user_name: user.username, // Ensure Vue uses user_name instead of username
                    }));
                });
            },


            showModal() {
                this.resetForm();
                $('#exampleModal').modal('show');
            },
            closeModal() {
                $('#exampleModal').modal('hide');
            },
            editInvoice(invoice) {
                this.status = 'edit';
                this.form = { ...invoice };
                this.showModal();
            },
            resetForm() {
                this.status = 'add';
                this.form = {
                    id: null,
                    customer_id: null,
                    user_id: null,
                    grand_total: null,
                    delivery_id: null,
                    pick_up_date_time: null,
                    status: "on_hold"
                };
                this.closeModal();
            },
            saveInvoice() {
                let url = this.status === 'add' ? '/admin/add-invoices' : '/admin/edit-invoices';
                axios.post(url, this.form).then(response => {
                    this.fetchData();
                    this.resetForm();
                });
            },
            deleteInvoice(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                }).then(result => {
                    if (result.isConfirmed) {
                        axios.post('/admin/delete-invoices', { id }).then(response => {
                            this.fetchData();
                        });
                    }
                });
            }
        }
    });
</script>
@endsection
