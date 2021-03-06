@extends('layouts.admin.admin')
@section('content')
    <div class="container-fluid mt-4" id="area">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group d-flex flex-row ">
                    <label for="name" class="col-md-3 mt-2 control-label"
                           style="display: inline-block;text-align: left">شماره همراه کاربر :</label>
                    <input id="name" type="text" class="col-md-5 form-control" @keyup.enter="formSubmit"
                           style="display: inline-block;direction: ltr;border-bottom-left-radius: 0;border-top-left-radius: 0;"
                           maxlength="11"
                           v-model="code" autofocus>
                    <button type="button" class="btn btn-dark" @click="formSubmit"
                            style="border: unset;border-bottom-right-radius: 0;border-top-right-radius: 0;background-color: #343a40">
                        <i class="nav-icon fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <tbody>
                    <tr v-for="(item , key ,index) in carts">
                        <td>
                            شماره سبد : @{{removeDecimal(key)}}
                        </td>
                        <td>
                            <table>
                                <tbody>
                                <template v-for="(cart, index) in item">
                                    <tr>
                                        <td>@{{ index+1 }}</td>
                                        <td>@{{ cart.product.name }}</td>
                                        <td>
                                            <span v-if="cart.color">
                                                رنگ : @{{ cart.color.name}}
                                            </span>
                                            <span v-else>---</span>
                                        </td>
                                        <td>
                                            <span v-if="cart.cart_values[0]">
                                                سایز : @{{ cart.cart_values[0].effect_value.key }}
                                            </span>
                                            <span v-else>---</span>
                                        </td>
                                        <td class="product-quantity">
                                            تعداد : @{{ cart.number }}
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
      
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-striped table-bordered">
                    <tbody>
                    <tr v-for="(item , key ,cindex) in carts">
                        <td>
                            شماره سبد : @{{removeDecimal(key)}}
                        </td>
                        <td>
                            <table>
                                <tbody>
                                <template v-for="(cart, index) in item">
                                    <tr>
                                        <td>@{{ cart.row_index }}</td>
                                        <td>@{{ cart.product.name }}</td>
                                        <td>
                                            <span v-if="cart.color">
                                                رنگ : @{{ cart.color.name}}
                                            </span>
                                            <span v-else>---</span>
                                        </td>
                                        <td>
                                            <span v-if="cart.cart_values[0]">
                                                سایز : @{{ cart.cart_values[0].effect_value.key }}
                                            </span>
                                            <span v-else>---</span>
                                        </td>
                                        <td class="product-quantity">
                                            تعداد : @{{ cart.number }}
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var app;
        app = new Vue({
            el: '#area',
            data: {
                carts: [],
                code: "",
                cookie: "",
             
            },
          
            methods: {
                
                formSubmit(e) {
                    e.preventDefault();
                    let _this = this;
                    let formData = new FormData();
                    formData.append('mobile', this.code);

                    axios.post('/admin/cart/search/mobile', formData)
                        .then(function (response) {
                            _this.carts = response.data;
                            console.log(_this.carts);
                        });
                },
                changeExist(e) {
                    e.preventDefault();
                    let _this = this;
                    let formData = new FormData();
                    formData.append('num', this.product.num);
                    formData.append('code', this.code);

                    axios.post('/admin/exist/product/code/change/num', formData)
                        .then(function (response) {
                            swal.fire(
                                {
                                    text: " با موفقیت ثبت شد !",
                                    type: "success",
                                    confirmButtonText: 'باشه',
                                }
                            );
                        })
                        .catch(function (error) {

                        });
                },
                numberFormat(price) {
                    price = Math.trunc(price);
                    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                },
                removeDecimal(num) {
                    return parseInt(num);
                }
            },
            mounted: function () {
               
            }
        });
    </script>
    <script>
        $("#side_cart").addClass("menu-open");
        $("#side_cart_index").addClass("active");
    </script>
@endsection

@section('style')

@endsection
