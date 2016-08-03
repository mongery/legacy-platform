@extends('layouts.base-sale')

@section('content')
<div class="container container-margin-open-order">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="row">
            <!-- this will be pending features -->
            <div class="login-button-username">
                <span>Hakim Razalan <a href="#">(Logout)</a></span>
            </div>
        </div>

        <h4>Tudung Fareeda Itik</h4>
        <div class="row">
            <div class="text-center open-order-title">
                Order Form
            </div>
        </div>
    </div>

    <div class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-body">
                Select Product
                <div class="row">
                    <div class="col-sm-12 product-list">

                        @include('sales.products')

                    </div>
                </div>
                <form class="form-horizontal">
                    <div class="row">
                        <hr />
                        <div class="col-sm-12">
                            <h5>Shopping Cart</h5>
                            <table class="table table-open-order">
                                <thead>
                                    <tr>
                                        <th class="checkbox-column" style="width: 30px;">

                                        </th>
                                        <th>
                                            Products
                                        </th>
                                        <th class="quantity-column">
                                            Quantity
                                        </th>
                                        <th style="width: 120px;">
                                            Unit Price
                                        </th>
                                        <th style="width: 120px;">
                                            Subtotal (net)
                                        </th>
                                        <th class="oo-del-head">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="cart">
                                    <td colspan="5" id="nothing-here">
                                        Nothing in your cart
                                    </td>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-7">
                            <h5>Got Coupon?</h5>
                            <div class="row">
                                <div class="col-xs-12 col-sm-10 col-md-7">
                                    <div class="input-group">
                                        <input type="text" name="coupon" class="form-control input-sm" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-sm" type="button">Apply Coupon</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5  table-oo-g-wrap">
                            <table class="table table-condensed table-oo-g">
                                <tbody>
                                    <tr>
                                        <td>
                                            Subtotal
                                        </td>
                                        <td>
                                            RM20
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Discount (%)
                                        </td>
                                        <td>
                                            RM1 (10%)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            VAT / GST (%)
                                        </td>
                                        <td>
                                            RM1.20 (6%)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Shipping / Handling
                                        </td>
                                        <td>
                                            RM20
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Grand Total
                                        </td>
                                        <td class="oo-gt">
                                            RM20
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row address-row">
                        <hr />
                        <div class="col-sm-6">
                            <h5>Billing Address</h5>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 oo-control-label control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputEmail3" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label"></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">Postcode</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="Postcode">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="City">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">State</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="State">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">Country</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="Country">
                                </div>
                            </div>

                        </div>
                        <hr class="hide-hr" />
                        <div class="col-sm-6 oo-da">
                            <div class="row">
                                <div class="col-xs-4">
                                    <h5>Delivery Address</h5>
                                </div>
                                <div class="col-xs-8 oo-saba">
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3">
                                            <label>
                                                <input type="checkbox" /> Same as Billing Address
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 oo-control-label control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputEmail3" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label"></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">Postcode</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="Postcode">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="City">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">State</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="State">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 oo-control-label control-label">Country</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control input-sm" id="inputPassword3" placeholder="Country">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <hr />
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-sm btn-primary pull-right">Submit Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script id="selectedProduct" type="text/x-custom-template">
<tr>
    <td>
        <input type="checkbox" />
    </td>
    <td class="individual-product-name">
    </td>
    <td class="select-quantity">
        <input type="number" class="form-control product-quantity" name="quantity" min="1" step="1" value="1">
    </td>
    <td class="individual-product-price">
    </td>
    <td class="individual-product-subtotal">
    </td>
    <td class="oo-del">
        <a class="delete-from-cart"><i class="fa fa-close"></i></a>
    </td>
</tr>
</script>
<script>
var cart = {};
function checkCart() {
    if (Object.keys(cart).length > 0) {
        $('#nothing-here').hide();
    } else {
        $('#nothing-here').show();
    }
}
function checkCatalog() {
    product_list = $('.fader').find('.add-to-cart')
                            .removeClass('added')
                            .removeClass('btn-success')
                            .addClass('btn-primary')
                            .addClass('btn-add')
                            .html('<i class="fa fa-plus"></i>');

    $.each(cart, function (index, value) {
        $('#'+index).find('.add-to-cart').removeClass('btn-primary').removeClass('btn-add').addClass('btn-success').addClass('added').html('<i class="fa fa-check"></i>');
    });
}
// add to cart
$('.product-list').on('click', '.btn-add', function () {
    product_id = $(this).attr('button-data');
    product_name = $('#' + $(this).attr('button-data')).find('.product-name').text().replace(/^\s+|\s+$/g, "");
    product_price = $('#' + $(this).attr('button-data')).find('.product-price').text().replace(/^\s+|\s+$/g, "");
    clone = $('#selectedProduct').clone().html();
    clone = $(clone);

    clone.find('td.individual-product-name').html(product_name);
    clone.find('.individual-product-price').html(product_price);
    clone.find('.individual-product-subtotal').html(product_price);
    clone.find('.delete-from-cart').attr('button-data', product_id);

    cart[product_id] = [product_name, product_price, 1, product_price];
    /*
    if (typeof(Storage) !== "undefined") {
        localStorage.setItem('unique_id', JSON.stringify(cart));
    } else {
        // Sorry! No Web Storage support..
    }*/

    $('#cart').append('<tr>'+clone.html()+'</tr>');
    checkCatalog();
    checkCart();
});
// delete from cart
$('#cart').on('click', '.delete-from-cart', function () {
    product_id = $(this).attr('button-data');
    delete cart[product_id];
    $(this).parent().parent('tr').remove();
    checkCatalog();
    checkCart();
});
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function (e) {
            getPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
    function getPosts(page) {
        $.ajax({
            url : '?page=' + page,
            dataType: 'json',
        }).done(function (data) {
            $('.fader').fadeOut(400, function () {
                $('.product-list').html(data);
                $('.fader').fadeIn(400);
                checkCatalog();
            })
        }).fail(function () {
            alert('Error loading product list');
        });
    }
    </script>
@endsection
