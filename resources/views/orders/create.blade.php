@extends('layouts.base')

@section('inline-css')
<link rel="stylesheet" href="/components/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" media="screen">
<link rel="stylesheet" href="/components/bootstrap-select/css/bootstrap-select.min.css" media="screen">
<style>
span.check-mark {
    margin-top: 12px !important;
}
.sp-nd2 .btn {
    border-left: none !important;
    border-radius: 0 !important;
}

hr {
    margin-top: 5px;
}

.cropit-preview {
  /* You can specify preview size in CSS */
  width: 100%;
  height: 300px;
  border-radius: 5px;
  border: 2px solid #EEE;
  cursor: move;
}
</style>
@endsection

@section('content')
@include('partials.flashmessage')

<div class="row">
    <div class="col-md-12">
        @include('partials.topbusinessinfo')
    </div>
</div>
<div class="container-margin" role="main">
    <div class="col-md-3">
        @include('partials.businesssidebar')
    </div>
    <div class="col-md-9">
        <div class="panel panel-default from-menu">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left" style="padding-top: 7.5px; padding-bottom: 7.5px">Add Order</h4>
            </div>
            <form class="form" id="order" action="{{ action('OrderController@store', [ 'business' => $business->unique_id ]) }}" method="POST">
                {{ csrf_field() }}
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" id="confirm-order" class="checkbox-success">
                                <label for="confirm-order">
                                    Confirm Order
                                </label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox checkbox-success">
                                <input type="checkbox" id="paid-order">
                                <label for="paid-order">
                                    Paid
                                </label>
                          </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Billing Information</h4>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="billing_name" class="form-control input-sm" placeholder="Biling Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="text" name="billing_email_address" class="form-control input-sm" placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="billing_phone_no" class="form-control input-sm" placeholder="Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="billing_address_one" class="form-control input-sm" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="billing_address_two" class="form-control input-sm" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Post Code</label>
                                        <input type="text" name="billing_post_code" class="form-control input-sm" placeholder="Post Code">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" name="billing_city" class="form-control input-sm" placeholder="City">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" name="billing_state" class="form-control input-sm" placeholder="State">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" name="billing_country" class="form-control input-sm" placeholder="Country" value="Malaysia" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="border-left: 1px #EEE solid">
                                <div class="row">
                                    <div class="col-xs-7">
                                        <h4>
                                            Delivery information
                                        </h4>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="checkbox same-as-billing pull-right">
                                            <input type="checkbox" id="same-as-billing">
                                            <label for="same-as-billing">
                                                Same as billing
                                            </label>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="delivery_name" class="form-control input-sm" placeholder="Delivery Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="text" name="delivery_email_address" class="form-control input-sm" placeholder="Email Address">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" name="delivery_phone_no" class="form-control input-sm" placeholder="Phone Number">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="delivery_address_one" class="form-control input-sm" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="delivery_address_two" class="form-control input-sm" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Post Code</label>
                                            <input type="text" name="delivery_post_code" class="form-control input-sm" placeholder="Post Code">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="delivery_city" class="form-control input-sm" placeholder="City">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" name="delivery_state" class="form-control input-sm" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" name="delivery_country" class="form-control input-sm" placeholder="Country" value="Malaysia" readonly>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h4 style="padding-left: 8px;">Products</h4>
                <table id="products-table" class="table table-condensed">
                    <thead>
                        <tr>
                            <th>

                            </th>
                            <th>
                                Product Name
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Price
                            </th>
                            <th style="width: 70px;">

                            </th>
                        </tr>
                    </thead>
                </table>
                <hr>
                <div class="panel-body">
                    <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Assign to open sale</label>
                                    <div class="optional-marker pull-right">
                                        <i>Optional</i>
                                    </div>
                                    <select name="sale" class="form-control selectpicker" multiple data-max-options="1" title="Select Sale...">
                                        @foreach ($openSales as $sale)
                                            <option value="{{ $sale->sale_url }}">
                                                {{ str_limit($sale->title, 256) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Delivery options</label>
                                    <select name="delivery" class="form-control selectpicker" multiple data-max-options="1" title="Select Delivery Option...">
                                        <option value="courier">
                                            Courier / Delivery
                                        </option>
                                        <option value="self-pickup">
                                            Self Pickup
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Payment options</label>
                                    <select name="payment" class="form-control selectpicker" multiple data-max-options="1" title="Select Payment Option...">
                                        <option value="fpx">
                                            FPX
                                        </option>
                                        <option value="manual">
                                            Cash Deposit / Internet Banking (Manual)
                                        </option>
                                        <option value="cash">
                                            Cash
                                        </option>
                                    </select>
                                </div>
                                <div class="well">
                                    <div class="form-group">
                                        <label>Upload Reference</label>
                                        <div class="optional-marker pull-right">
                                            <i>Optional</i>
                                        </div>
                                        <input type="file" name="name" value="" class="form-control">
                                    </div>
                                </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label>Delivery Charge</label>
                                <div class="input-group">
                                    <div class="input-group-addon">RM</div>
                                    <input name="delivery_charge" step="0.01" type="number" class="form-control" id="exampleInputAmount" placeholder="Amount">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Subtotal</label>
                                <div class="input-group">
                                    <div class="input-group-addon">RM</div>
                                    <input name="subtotal" step="0.01" type="number" class="form-control" id="exampleInputAmount" placeholder="Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Discount (RM/%)</label>
                                <input name="discount" step="0.01" type="number" type="text" class="form-control" name="name" value="" placeholder="RM / %">
                                <span class="small-note">Eg. 12 (lump sum discount) / 12% (% discount)</span>
                            </div>
                            <div class="form-group">
                                <label>Grand Total</label>
                                <div class="input-group">
                                    <div class="input-group-addon">RM</div>
                                    <input name="grand_total" step="0.01" type="number" class="form-control" id="exampleInputAmount" placeholder="Amount">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer clearfix">
                    <button type="button" class="btn btn-info">View Invoice</button>
                    <button type="submit" class="btn btn-primary pull-right">Add Order</button>
                </div>
            </form>

        </div>

    </div>
</div> <!-- /container -->

<!-- modal -->
<div id="productDetail" class="modal fade add-product-modal-lg" tabindex="-1" role="dialog" aria-labelledby="addProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Product Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9 product-details-info">
                        <div class="row">
                            <div class="col-sm-4 input-label">
                                Product Name
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="name" value="" readonly>
                            </div>
                        </div>
                        <div class="row margin-top-fix">
                            <div class="col-sm-4 input-label">
                                Description
                            </div>
                            <div class="col-sm-8">
                                <textarea name="name" class="form-control" rows="8" cols="100%" readonly></textarea>
                            </div>
                        </div>
                        <div class="row margin-top-fix">
                            <div class="col-sm-4 input-label">
                                In Stock
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="name" value="" readonly>
                            </div>
                        </div>
                        <div class="row margin-top-fix">
                            <div class="col-sm-4 input-label">
                                Price
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="name" value="" readonly>
                            </div>
                        </div>
                        <div class="row margin-top-fix">
                            <div class="col-sm-4 input-label">
                                Selling Price
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="name" value="" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <img src="/images/no-picture.png" class="product-image-details" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/components/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="/components/datatables-checkbox/js/dataTables.checkboxes.js"></script>
<script>
var table = $('#products-table').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: "{{ url('/data/products/'.$business->unique_id) }}?showAll=1",
    columns: [
        { data: 'checkboxes', name: 'checkboxes', sortable: false, searchable: false },
        { data: 'product_name', name: 'product_name' },
        { data: 'quantity_in_stock', name: 'quantity_in_stock', sortable: true },
        { data: 'selling_price', name: 'selling_price' },
        { data: 'actionnodelete', name: 'actionnodelete', sortable: false, searchable: false }
    ],
    columnDefs: [
        {
            targets: 0,
            searchable: false,
            orderable: false,
            className: 'dt-body-center',
            render: function (data, type, full, meta){
                return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
            },
            checkboxes: { selectRow: true }
        }
    ],
    select: {
        style: 'multi',
        selector: 'td:first-child'
    },
    order: [[1, 'asc']],
    lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
    pageLength: 5
});

$('#order').on('submit', function(e){
    e.preventDefault();
      var form = this;
      var rows_selected = table.column(0).checkboxes.selected();
      // Iterate over all selected checkboxes

      if (rows_selected.length === 0) {
          $('.validation-product').append('Please choose one product to be include in this order.');
          return false;
      }

      $.each(rows_selected, function(index, rowId){
         // Create a hidden element
         $(form).append(
             $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'products_list[]')
                .val(rowId)
            );
        });
        $('.button-submit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Add Order');
        setTimeout(function () {
            form.submit();
        }, 1000);

    });

    $('#same-as-billing').on('click', function () {
        if ($(this).is(':checked')) {
            var billing = $('[name^=billing_]');
            var delivery = $('[name^=delivery_]').not('[name=delivery_charge]');

            $.each( billing , function (i, val) {
                $(delivery[i]).val($(val).val()).prop('readonly', true);
            });

            $('[name^=billing_]').on('keyup', function () {

                var billing = $('[name^=billing_]');
                var delivery = $('[name^=delivery_]').not('[name=delivery_charge]');

                $.each( billing , function (i, val) {
                    $(delivery[i]).val($(val).val()).prop('readonly', true);
                });

            });

        } else {
            $('[name^=delivery_]').not('[name=delivery_charge]').not('[name=delivery_country]').prop('readonly', false)
            $('[name^=billing_]').unbind();
        }
    });
</script>
@endsection