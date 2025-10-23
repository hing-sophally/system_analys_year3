{{-- @extends('frontend.layout')
<style>
    .text-truncate-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active{
    background: black !important;
}
</style>
@section('content')
<div class="container my-5 min-vh-100">

    <!-- Category Tabs -->
    <div class="d-flex flex-wrap gap-2 justify-content-start mb-4">
        <a href="{{ route('product') }}" 
           class="btn btn-outline-dark rounded-pill px-4 {{ request()->category ? '' : 'active' }}">
            All
        </a>

        @foreach($categories as $category)
            <a href="{{ route('product', ['category' => $category->id]) }}"
               class="btn btn-outline-dark rounded-pill px-4 {{ request()->category == $category->id ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <!-- Product Grid -->
    <div class="container my-5">
        <div class="row g-4"> <!-- g-4 for gutter spacing -->
    
            @foreach($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                <div class="card shadow-sm" style="width: 250px;">
                    <img src="{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : '/storage/' . $product->image_url) : '/images/products/default.svg' }}" 
                         alt="{{ $product->name }}"
                         class="card-img-top"
                         style="height: 250px; object-fit: contain;">
    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted small mb-2 text-truncate-2">
                            {{ $product->description }}
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">${{ number_format($product->price, 2) }}</span>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-outline-danger" 
                                    onclick="addToWishlist({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url)) : asset('images/products/default.svg') }}')"
                                    title="Add to Wishlist">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <button class="btn btn-sm btn-success" 
                                    onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->image_url ? (str_starts_with($product->image_url, 'http') ? $product->image_url : asset('storage/' . $product->image_url)) : asset('images/products/default.svg') }}')">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    
        </div>
    </div>
    

</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart-btn').click(function(e) {
        e.preventDefault();

        let productId = $(this).data('id');

        $.ajax({
            url: "{{ route('cart.add') }}", // We'll create this route
            method: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId
            },
            success: function(response) {
                // Update the cart count in the header
                $('#cart-count').text(response.cartCount);
            },
            error: function(xhr) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to add to cart.',
                        timer: 3000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } else {
                    alert('Failed to add to cart.');
                }
            }
        });
    });
});
</script> --}}



@extends('frontend.layout')

<style>
  /* Reset some basics */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  /* Make app full height */
  #app {
    min-height: 100%;
    display: flex;
    flex-direction: column;
  }

  /* Make the inside row expand */
  .responsive-row {
    flex: 1;
    /* margin-left: 0; */
  }

  @media (min-width: 992px) {
    /* lg and up */
    .responsive-row {
      margin-left: 240px !important;
    }
  }
</style>
@section('content')
  <div id="app" class="container">


    <div class="row  " style="margin-top: 20px">
    <!--product card list-->
    <!-- Category Tabs -->
    <div class="d-flex flex-wrap gap-2 justify-content-start mb-4">
        <a href="{{ route('product') }}" 
           class="btn btn-outline-dark rounded-pill px-4 {{ request()->category ? '' : 'active' }}">
            All
        </a>

        @foreach($categories as $category)
            <button 
                @click="selectCategory({{ $category->id }})"
                class="btn btn-outline-dark rounded-pill px-4 
                {{ request()->category == $category->id ? 'active' : '' }}">
                {{ $category->name }}
            </button>
            @endforeach

    </div>
    <div class="col-lg-21 col-md-7 col-sm-12">
      <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-6 mb-2 mt-2" v-for="(item, index) in product_list" :key="'product_list_' + index">
        <div class="card d-flex flex-column" style="width: 100%; height: 250px; overflow: hidden;"
        @click="selectProductCard(item)">
        <img v-if="item.image_url" :src="item.image_url.startsWith('http') ? item.image_url : '/storage/' + item.image_url" style=" height: 140px;" alt="Service Image">
        <div class="card-body d-flex flex-column p-2 text-center">
          <h6 class="card-title"
          style="font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">@{{ item.name
          }}</h6>
          <p class="card-text font-weight-bold mt-auto"
          style="font-size: 16px; background-color: yellow; color: red; width: 100%; padding: 2px;">
          @{{ item.price }} $
          </p>
        </div>
        </div>
      </div>
      </div>
    </div>

    <!--selected  list-->
    <div class="col-lg-5 col-md-5 col-sm-12" >
      <!--Table selected list-->
      <div class="table-responsive">
      <table class="w-100 table table-sm table-borderless table-striped">
        <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in selected_product_list" :key="'selected_product_list_' + index">
          <td>@{{ index + 1 }}</td>
          <td>@{{ item.name }}</td>
          <td>
          <input type="number" v-model="item.qty" @input="qtyOnchange(index, item.qty)" style="width: 60px;
        text-align: center;
        font-weight: bold;
        color: red;">
          </td>
          <td>@{{ item.price }} $</td>
          <td>@{{ item.sub_total }} $</td>
          <td>
          <input @click="deleteItem(index)" type="button" value="❌">
          </td>
        </tr>
        </tbody>
      </table>
      </div>

      <!--Table total-->
      <table class="table thead-dark">
      <thead>
        <tr>
        <th>
          <h3>Total As USD: </h3>
        </th>
        <th class="float-right">
          <h2 class="text-danger">@{{ total.toLocaleString() }} $</h2>
        </th>
        </tr>
        <tr>
        <th>
          <h3>Total As KHR: </h3>
        </th>
        <th class="float-right">
          <h2 class="text-danger">@{{ (total * 4100).toLocaleString() }} ៛</h2>
        </th>
        </tr>
        <tr>
        <th colspan="2">
          <input type="number" class="form-control w-100" v-model="received_amount">
        </th>
        </tr>
        <tr>
        <th>
          <h3>Change: </h3>
        </th>
        <th v-if="received_amount-total > 0" class="float-right" style="background-color: yellow; color: red">
          <h2 class="text-danger">
          @{{ (received_amount-total).toLocaleString() }} $
          </h2>
          <h2 class="text-danger">
          @{{ ((received_amount-total) * 4100).toLocaleString() }} ៛
          </h2>
        </th>
        </tr>
      </thead>
      </table>

      <!--Button-->
      <input type="button" value="Cancel ❌" class="btn btn-outline-danger float-left" @click="clearSale()">
      <input type="button" value="Pay Now 💵" class="btn btn-outline-primary float-right" @click="payNow()">
    </div>
    </div>
  </div>
@endsection

@section('script')
   <!-- 1. jQuery FIRST -->
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

   <!-- 2. LoadingOverlay SECOND -->
   <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
 
   <!-- 3. Axios THIRD -->
   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 
   <!-- 4. Vue.js -->
   <script src="https://unpkg.com/vue@3.4.21/dist/vue.global.prod.js"></script>
 

  <script>
    const { createApp } = Vue

    createApp({
      created() {
        this.fetchData();
      },
      data() {
        return {
          product_list: [],
          selected_product_list: [],
          total: 0,
          received_amount: 0,
          currentCategoryId: null, // ← 👈 add this

        }
      },
      methods: {
        fetchData(categoryId = null) {
  let url = '/productApi';

  if (categoryId) {
    url += '?category=' + categoryId;
  }

  axios.get(url)
    .then((response) => {
      if (response.data && response.data.products) {
        this.product_list = response.data.products;
      } else {
        console.warn('Unexpected response structure:', response.data);
      }
    })
    .catch((error) => {
      console.error("Error fetching products:", error);
      if (typeof Swal !== 'undefined') {
          Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: 'Failed to fetch product data.',
              timer: 3000,
              showConfirmButton: false,
              toast: true,
              position: 'top-end'
          });
      } else {
          alert("Failed to fetch product data.");
      }
    });
},

        selectProductCard(item) {
          let is_dpl = this.selected_product_list.find(obj => obj.id == item.id);
          if (!is_dpl) {
            item.qty = 1;
            item.sub_total = item.price;
            this.selected_product_list.push(item);
          } else {
            is_dpl.qty++;
            is_dpl.sub_total = Math.round(is_dpl.qty * is_dpl.price);
          }
          this.calculateTotal();
        },

        calculateTotal() {
          this.total = 0;
          this.selected_product_list.forEach(item => {
            item.sub_total = item.qty * item.price;
            this.total += item.sub_total;
          });
          this.total = Math.round(this.total);
        },
        selectCategory(categoryId) {
            this.currentCategoryId = categoryId;
            this.fetchData(categoryId);
        }, 
        clearSale() {
          if (confirm("Do you want to clear this sale?")) {
            this.selected_product_list = [];
            this.total = 0;
            this.received_amount = 0;
          }
        },

        payNow() {
          if (parseFloat(this.received_amount) >= parseFloat(this.total)) {
            $("body").LoadingOverlay("show"); // show overlay

            axios.post('/create-paypal-order', {
              amount: this.total
            })
            .then((response) => {
              let paypalUrl = response.data.approval_url;

              let width = 600;
              let height = 600;
              let left = (window.screen.width - width) / 2;
              let top = (window.screen.height - height) / 2;

              window.open(paypalUrl, '_blank', `width=${width},height=${height},left=${left},top=${top}`);
            })
            .catch((error) => {
              if (typeof Swal !== 'undefined') {
              Swal.fire({
                  icon: 'error',
                  title: 'Payment Error!',
                  text: 'Failed to initiate PayPal payment.',
                  timer: 3000,
                  showConfirmButton: false,
                  toast: true,
                  position: 'top-end'
              });
          } else {
              alert("Failed to initiate PayPal payment.");
          }
              console.error(error);
            })
            .finally(() => {
              $("body").LoadingOverlay("hide"); // hide overlay
            });
          } else {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Amount Mismatch!',
                    text: 'Received amount is less than total!',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            } else {
                alert("Received amount is less than total!");
            }
          }
        },

        deleteItem(index) {
          if (confirm("Do you want to delete this item?")) {
            this.selected_product_list.splice(index, 1);
            this.calculateTotal();
          }
        },

        qtyOnchange(index, qty) {
          if (isNaN(parseInt(qty)) || parseInt(qty) < 1) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Quantity!',
                    text: 'Enter a valid quantity',
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            } else {
                alert("Enter a valid quantity");
            }
            this.selected_product_list[index].qty = 1;
            return;
          }
          this.calculateTotal();
        }
         
    
    }
    }).mount('#app')
  </script>
@endsection
