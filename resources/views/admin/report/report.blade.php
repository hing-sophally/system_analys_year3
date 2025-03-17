@extends('admin.layout')
@section('content')
<div class="content-wrapper" id="app">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold">User Payment Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
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
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Payment Report</h5>
                    <button @click="resetForm()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitForm">
                        <div class="form-group mb-2">
                            <label for="user_id">User ID</label>
                            <input v-model="form.user_id" type="number" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="amount">Amount</label>
                            <input v-model="form.amount" type="number" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="payment_method">Payment Method</label>
                            <input v-model="form.payment_method" type="text" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status">Status</label>
                            <select v-model="form.status" class="form-control" required>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="paid_at">Paid At</label>
                            <input v-model="form.paid_at" type="datetime-local" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button @click="resetForm()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button v-if="status === 'add'" @click="submitForm" type="button" class="btn btn-success">Save</button>
                    <button v-if="status === 'edit'" @click="submitForm" type="button" class="btn btn-primary">Update</button>
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
                                <i class="fa fa-plus-circle"></i> Add Payment
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Paid At</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(report, index) in reportList" :key="report.id">
                                        <td>@{{ report.id }}</td>
                                        <td>@{{ report.user_id }}</td>
                                        <td>@{{ report.amount }}</td>
                                        <td>@{{ report.payment_method }}</td>
                                        <td>@{{ report.status }}</td>
                                        <td>@{{ report.paid_at }}</td>
                                        <td>@{{ report.created_at }}</td>
                                        <td>@{{ report.updated_at }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" @click="getEdit(report)">Edit</button>
                                            <button class="btn btn-sm btn-danger" @click="getDelete(report)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- Pagination (optional) --}}
                        {{-- {{ $reports->links('vendor.pagination.bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const app = new Vue({
        el: '#app',
        data: {
            status: 'add',
            reportList: [],
            form: {
                id: null,
                user_id: null,
                amount: null,
                payment_method: '',
                status: 'pending',
                paid_at: ''
            }
        },
        created() {
            this.fetchReports();
        },
        methods: {
            fetchReports() {
                axios.get('/get-reports')
                    .then(response => {
                        this.reportList = response.data.data ?? response.data;
                    })
                    .catch(error => console.error(error));
            },
            showModal(mode) {
                this.status = mode;
                if (mode === 'add') this.resetForm(false);
                $('#exampleModal').modal('show');
            },
            closeModal() {
                $('#exampleModal').modal('hide');
            },
            resetForm(close = true) {
                this.form = {
                    id: null,
                    user_id: null,
                    amount: null,
                    payment_method: '',
                    status: 'pending',
                    paid_at: ''
                };
                if (close) this.closeModal();
            },
            getEdit(report) {
                this.form = Object.assign({}, report);
                this.showModal('edit');
            },
            getDelete(report) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won’t be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('/delete-reports', { id: report.id })
                            .then(() => {
                                this.fetchReports();
                                Swal.fire("Deleted!", "The report has been deleted.", "success");
                            })
                            .catch(error => console.error(error));
                    }
                });
            },
            submitForm() {
                const url = this.status === 'add' ? '/add-reports' : '/edit-reports';
                axios.post(url, this.form)
                    .then(() => {
                        this.fetchReports();
                        this.resetForm();
                    })
                    .catch(error => console.error(error));
            }
        }
    });
</script>
@endsection
