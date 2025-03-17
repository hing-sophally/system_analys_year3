@extends('admin.layout')

<style>
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .responsive-row {
    margin-left: 0;
  }

  @media (min-width: 992px) {

    /* lg and up */
    .responsive-row {
      margin-left: 240px !important;
    }
  }
</style>
@section('content')
  <div id="app" class="container-fluid">
    <div class="row responsive-row ">
    <!--product card list-->
    <div class="col-lg-7 col-md-7 col-sm-12" style="box-shadow: 0px 5px 13px 8px #CCCC">
      <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-6 mb-2 mt-2" v-for="(item, index) in product_list" :key="'product_list_' + index">
        <div class="card d-flex flex-column" style="width: 100%; height: 250px; overflow: hidden;"
        @click="selectProductCard(item)">
        <img :src="item . image" class="card-img-top" style="height: 140px; object-fit: cover;">
        <div class="card-body d-flex flex-column p-2 text-center">
          <h6 class="card-title"
          style="font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">@{{ item.title
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
    <div class="col-lg-5 col-md-5 col-sm-12" style="box-shadow: 10px 5px 13px 8px #CCCC;">
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
          <td>@{{ item.title }}</td>
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
  <!-- FIXED & COMPLETE SCRIPT SECTION -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
  <script src="https://unpkg.com/vue@3.4.21/dist/vue.global.prod.js"></script>

  <script>
    const { createApp } = Vue
    createApp({
    created() {
      this.fetchData()
    },
    data() {
      return {
      product_list: [],
      selected_product_list: [],
      total: 0,
      received_amount: 0
      }
    },
    methods: {
      fetchData() {
      $.LoadingOverlay("show");
      axios.get('https://fakestoreapi.com/products')
        .then((response) => {
        this.product_list = response.data
        $.LoadingOverlay("hide");
        })
        .catch((error) => {
        console.log(error);
        })
      },
      selectProductCard(item) {
      let is_dpl = this.selected_product_list.find(obj => obj.id == item.id)
      if (!is_dpl) {
        item.qty = 1
        item.sub_total = item.price
        this.selected_product_list.push(item)
      } else {
        is_dpl.qty++
        is_dpl.sub_total = Math.round(is_dpl.qty * is_dpl.price)
      }
      this.calculateTotal()
      },
      calculateTotal() {
      this.total = 0
      this.selected_product_list.forEach(item => {
        item.sub_total = item.qty * item.price
        this.total += item.sub_total
      })
      this.total = Math.round(this.total)
      },
      clearSale() {
      if (confirm("Do you want to clear this sale?")) {
        this.selected_product_list = []
        this.total = 0
        this.received_amount = 0
      }
      },
      payNow() {
  if (parseFloat(this.received_amount) >= parseFloat(this.total)) {
      // Show loading overlay
      $.LoadingOverlay("show");

      // Initiate PayPal order creation
      axios.post('/create-paypal-order', {
          amount: this.total
      })
      .then((response) => {
          // Retrieve PayPal approval URL from response
          let paypalUrl = response.data.approval_url;

          // Open PayPal approval URL in a new window with specific width and height
          let width = 600;
          let height = 600;
          let left = (window.screen.width - width) / 2;
          let top = (window.screen.height - height) / 2;
          
          // Open new window for PayPal
          window.open(paypalUrl, '_blank', `width=${width},height=${height},left=${left},top=${top}`);
      })
      .catch((error) => {
          // Handle error during PayPal order creation
          alert("Failed to initiate PayPal payment.");
          console.error(error);
      })
      .finally(() => {
          // Hide loading overlay
          $.LoadingOverlay("hide");
      });
  } else {
      // Alert if received amount is less than total
      alert("Received amount is less than total!");
  }
},


      deleteItem(index) {
      if (confirm("Do you want to delete this item?")) {
        this.selected_product_list.splice(index, 1)
        this.calculateTotal()

      }
      },
      qtyOnchange(index, qty) {
      if (isNaN(parseInt(qty)) || parseInt(qty) < 1) {
        alert("Enter a valid quantity")
        this.selected_product_list[index].qty = 1
        return
      }
      this.calculateTotal()
      }
    }
    }).mount('#app')
  </script>
@endsection