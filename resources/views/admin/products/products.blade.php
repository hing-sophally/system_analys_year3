@extends('admin.layout')
@section('content')
<div class="content-wrapper" id="app">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold">Products Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                    <h3 class="modal-title fs-5 font-weight-bold" id="exampleModalLabel">Product</h3>
                    <button @click="resetForm()" type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent>
                        <div class="form-group">
                            <label>Category</label>
                            <select v-model="form.category_id" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                <option v-for="cat in categories" :value="cat.id">@{{ cat.name }}</option>
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input v-model="form.name" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input ref="image_url" type="file" class="form-control" accept="image/*">
                            <div v-if="form.image_url">
                                <img :src="form.image_url.startsWith('http') ? form.image_url : '/storage/' + form.image_url" alt="Product Image" width="100" class="mt-2">
                            </div>
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>
                        
                        <div class="form-group">
                            <label>Description</label>
                            <textarea v-model="form.description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input v-model="form.price" type="number" step="0.01" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Discount (%)</label>
                            <input v-model="form.discount" type="number" step="0.01" min="0" max="100" class="form-control" placeholder="0-100">
                            <small class="text-muted">Enter discount percentage (0-100). Leave 0 for no discount.</small>
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input v-model="form.stock" type="number" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select v-model="form.status" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button @click="resetForm()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button v-if="status == 'add'" @click="addproducts()" type="button" class="btn btn-success">Save</button>
                    <button v-if="status == 'edit'" @click="editproducts()" type="button" class="btn btn-success">Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a @click="showModals()" href="#" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i> Add Product
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Category</th> <!-- Updated header -->
                                <th>Price</th>
                                <th>Discount (%)</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(product, index) in product_list" :key="product.id">
                                <td>@{{ index + 1 }}</td>
                                <td>@{{ product.name }}</td>
                                <td>
                                    <img :src="product.image_url.startsWith('http') ? product.image_url : '/storage/' + product.image_url" alt="Product Image" width="50">
                                </td>
                                <td>@{{ product.description }}</td>
                                <td>@{{ product.category_name }}</td>
                                <td>$@{{ product.price }}</td>
                                <td>
                                    <span v-if="product.discount > 0" class="badge bg-danger">
                                        @{{ product.discount }}%
                                    </span>
                                    <span v-else class="text-muted">-</span>
                                </td>
                                <td>@{{ product.stock }}</td>
                                <td>@{{ product.status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a @click="getEdit(product)" class="btn btn-sm btn-success">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a @click="getDelete(product)" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
        {{ $products->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection

@section('script')
<script>
    new Vue({
        el: '#app',
        data: {
            status: 'add',
            product_list: [], // Store the products fetched from the server
            categories: [], // Store the categories for the dropdown
            form: {
                id: null,
                category_id: '',
                name: '',
                description: '',
                price: '',
                discount: 0, // Default to 0 (no discount)
                stock: '',
                status: 1, // Default to Active
                image_url: ''
            }
        },
        created() {
            this.fetchData(); // Fetch products with categories
            this.fetchCategories(); // Fetch categories for the dropdown
        },
        methods: {
            fetchData() {
                axios.get('/admin/get-products') // Make sure this endpoint returns products with categories
                    .then(res => this.product_list = res.data)
                    .catch(err => console.error(err));
            },
            fetchCategories() {
            axios.get('/admin/get-categories') // Fetch categories, not products
                .then(res => this.categories = res.data) // Store categories in the correct variable
                .catch(err => console.error(err));
        },

            showModals() {
                $('#exampleModal').modal('show');
            },
            closeModals() {
                $('#exampleModal').modal('hide');
            },
            resetForm() {
                this.status = 'add';
                this.form = { id: null, category_id: '', name: '', description: '', price: '', discount: 0, stock: '', status: 1, image_url: '' };
                if (this.$refs.image_url) {
                    this.$refs.image_url.value = '';
                }
                this.closeModals();
            },
            getEdit(item) {
                this.form.id = item.id;
                this.form.category_id = item.category_id; // This should correctly set the category_id
                this.form.name = item.name;
                this.form.description = item.description;
                this.form.price = item.price;
                this.form.discount = item.discount || 0; // Set discount, default to 0
                this.form.stock = item.stock;
                this.form.status = item.status;
                this.form.image_url = item.image_url;
                this.status = 'edit';
                if (this.$refs.image_url) {
                    this.$refs.image_url.value = ''; // Reset the file input (optional)
                }
                this.showModals();
            },

            getDelete(item) {
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
                        axios.post('/admin/delete-products', { id: item.id })
                            .then(() => this.fetchData())
                            .catch(err => console.error(err));
                    }
                });
            },
            addproducts() {
                const formData = new FormData();
                formData.append('category_id', this.form.category_id);
                formData.append('name', this.form.name);
                formData.append('description', this.form.description);
                formData.append('price', this.form.price);
                formData.append('discount', this.form.discount || 0);
                formData.append('stock', this.form.stock);
                formData.append('status', this.form.status);
                if (this.$refs.image_url.files.length > 0) {
                    formData.append('image_url', this.$refs.image_url.files[0]);
                    console.log('Image file added to FormData:', this.$refs.image_url.files[0].name);
                } else {
                    console.log('No image file selected');
                }
                axios.post('/admin/add-products', formData)
                    .then((response) => {
                        console.log('Product added successfully:', response.data);
                        this.resetForm();
                        this.fetchData();
                    })
                    .catch(err => {
                        console.error('Error adding product:', err);
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Error adding product: ' + (err.response?.data?.message || err.message),
                                timer: 3000,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end'
                            });
                        } else {
                            alert('Error adding product: ' + (err.response?.data?.message || err.message));
                        }
                    });
            },
            editproducts() {
                const formData = new FormData();
                formData.append('id', this.form.id);
                formData.append('category_id', this.form.category_id);
                formData.append('name', this.form.name);
                formData.append('description', this.form.description);
                formData.append('price', this.form.price);
                formData.append('discount', this.form.discount || 0);
                formData.append('stock', this.form.stock);
                formData.append('status', this.form.status);
                if (this.$refs.image_url.files.length > 0) {
                    formData.append('image_url', this.$refs.image_url.files[0]);
                    console.log('New image file added to FormData:', this.$refs.image_url.files[0].name);
                } else {
                    console.log('No new image file selected, keeping existing image');
                }
                axios.post('/admin/edit-products', formData)
                    .then((response) => {
                        console.log('Product updated successfully:', response.data);
                        this.resetForm();
                        this.fetchData();
                    })
                    .catch(err => {
                        console.error('Error updating product:', err);
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Error updating product: ' + (err.response?.data?.message || err.message),
                                timer: 3000,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end'
                            });
                        } else {
                            alert('Error updating product: ' + (err.response?.data?.message || err.message));
                        }
                    });
            }
        }
    });
</script>
@endsection
