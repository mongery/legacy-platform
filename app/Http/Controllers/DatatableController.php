<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Traits\BusinessTraits;
use Yajra\Datatables\Facades\Datatables;

use App\Business;
use App\Product;
use App\OpenOrder;
use Carbon\Carbon;

class DatatableController extends Controller
{
    use BusinessTraits;

    // Orders

    public function getOrders(Request $request, $businessId) {
        $isOwner = $this->checkBusinessBelongsToUser($businessId);

        if ($isOwner) {
            $business = \App\Business::findByUniqueId($businessId)->first();
            $query = \App\Order::where('business_id', $business->id);

            /*if ($request->status == 'confirmed') {
                $query = $query->where('status', 'confirmed');
            } elseif ($request->status == 'pending') {
                $query = $query->where('status', 'pending');
            } elseif ($request->status == 'completed') {
                $query = $query->where('status', 'completed');
            }*/

            return Datatables::of($query)
                ->addColumn('checkboxes', function ($order) {
                    return '<input type="checkbox" value="'.$order->id.'">';
                })
                ->editColumn('buyer', function ($order) {
                    return '<a href="#" data-toggle="tooltip" data-placement="bottom" title="'.$order->buyer()->first()->billing_email_address.'">'.$order->buyer()->first()->billing_name.'</a>';
                })
                ->editColumn('paid', function ($order) {
                    return ($order->paid) ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-remove text-danger"></i>';
                })
                ->addColumn('action', function ($order) {
                    return 'test';
                })
                ->make(true);
        } else {
            return [];
        }
    }

    // Products

    public function getProducts(Request $request, $businessId) {
        $isOwner = $this->checkBusinessBelongsToUser($businessId);

        if ($isOwner) {
            $businessTrueId = Business::findByUniqueId($businessId)->id;
            $status = null;

            $query = Product::select(['product_name', 'product_description', 'quantity_in_stock', 'selling_price', 'unique_id', 'active'])->where('business_id', $businessTrueId);
            if (!isset($request->showAll)) {
                if (!isset($request->active)) {
                    $status = true;
                    $query->where('active', $status);
                } else {
                    $status = $request->active;
                    $query->where('active', $status);
                }
            }

            $open_order_products = [];
            if (isset($request->openorder)) {
                $open_order_products = OpenOrder::where('sale_url', $request->openorder)->first()->products_list;
                $open_order_products = json_decode($open_order_products);
            }
            $datatable = Datatables::of($query)
                ->addColumn('checkboxes', function ($product) {
                    //$checked = (in_array($product->unique_id, $open_order_products)) ? 'checked' : null;
                    return $product->unique_id;
                })
                ->addColumn('actions', function ($product) use ($businessId) {
                    $csrf = csrf_field();
                    $style = null;
                    $echo_text = null;
                    if ($product->active) {
                        $style = 'btn-warning';
                        $echo_text = 'Deactivate';
                    } else {
                        $style = 'btn-success';
                        $echo_text = 'Activate';
                    }
                    return '<form action="/business/'.$businessId.'/products/'.$product->unique_id.'" class="pull-right" method="POST">'.$csrf.'<input type="hidden" name="_method" value="DELETE" /><button type="button" class="btn btn-delete btn-xs btn-danger" style="margin-left: 5px;">Delete</button></form> <form action="/business/'.$businessId.'/products/'.$product->unique_id.'/toggle" class="pull-right" method="POST">'.$csrf.'<input type="hidden" name="status" value="'.$product->active.'" /><button type="button" class="btn toggle-product btn-xs '.$style.'" style="margin-left: 5px;">'.$echo_text.'</button></form> <a href="/business/'.$businessId.'/products/'.$product->unique_id.'" class="btn btn-xs btn-default pull-right">Details</a>';
                })
                ->addColumn('actionnodelete', function ($product) use ($businessId) {
                    return '<a href="#" data-product="'.$product->unique_id.'" data-toggle="modal" data-target="#productDetail" class="btn btn-xs btn-default pull-right view-details">Details</a>';
                })
                ->editColumn('selling_price', function ($product) {
                    return number_format($product->selling_price, 2);
                })
                ->addColumn('sale_price', function ($product) use ($businessId, $open_order_products) {
                    return $product->selling_price;
                })
                ->addColumn('quantity', function ($product) use ($businessId) {
                    return '<input type="text" class="form-control input-sm quantity_buy" data-id="'.$product->unique_id.'" data-price="'.$product->selling_price.'" value="1"/>';
                })
                ->setRowClass(function ($product) {
                    return ($product->quantity_in_stock <= 0) ? 'danger' : '';
                })
                ->setRowClass(function ($product) {
                    return ($product->active) ? '' : 'danger';
                });

                if ($view = $datatable->request->get('view')) {
                    if ($view == 'active') {
                        $datatable->where('active', true);
                    } elseif ($view == 'inactive') {
                        $datatable->where('active', false);
                    } elseif ($view == 'deleted') {
                        $datatable->onlyTrashed();
                    }
                }

                return $datatable->make(true);
        } else {
            return [];
        }
    }

    // Invoices

    public function getInvoices($businessId) {
        $isOwner = $this->checkBusinessBelongsToUser($businessId);
        if ($isOwner) {
            return Datatables::eloquent(Business::findByUniqueId($businessId)->invoices())
                ->addColumn('checkboxes', function ($product) {
                    return '<input type="checkbox" class="form-control" value="{{$order->id}}">';
                })
                ->editColumn('product_id', function ($product) {
                    return '#'.$product->id;
                })
                ->make(true);
        } else {
            return [];
        }
    }

    // Open orders

    public function getOpenOrders(Request $request, $businessId) {
        $isOwner = $this->checkBusinessBelongsToUser($businessId);
        if ($isOwner) {
            return Datatables::eloquent(Business::findByUniqueId($businessId)->openOrders())
                ->addColumn('checkboxes', function ($sale) {
                    return '<input type="checkbox" value="'.$sale->unique_id.'">';
                })
                ->addColumn('duration', function ($sale) {
                    $start_date = Carbon::createFromFormat("Y-m-d H:i:s", $sale->start_at);
                    $end_date = !is_null($sale->end_at) ? Carbon::createFromFormat("Y-m-d H:i:s", $sale->end_at) : '&infin;';

                    if (Carbon::now() > $start_date) {
                        if ($sale->end_at) {
                            if (Carbon::now() > $sale->end_at) {
                                return '<b class="text-danger">End '.$end_date->diffForHumans().'</b>';
                            }
                            return $end_date->diffForHumans()." to end";
                        } else {
                            return 'No ending';
                        }
                    } else {
                        return '<b class="text-success">Start '.$start_date->diffForHumans()."</b>";
                    }
                })
                ->editColumn('start_at', function ($sale) {
                    $date = Carbon::createFromFormat("Y-m-d H:i:s", $sale->start_at);
                    return $date->diffForHumans();
                })
                ->editColumn('end_at', function ($sale) {
                    return !is_null($sale->end_at) ? Carbon::createFromFormat("Y-m-d H:i:s", $sale->end_at)->diffForHumans() : '';
                })
                ->editColumn('products_list', function ($sale) {
                    $count = $sale->productStocks()->pluck('unique_id')->count();
                    return $count;
                })
                ->addColumn('status', function ($sale) {
                    if ($sale->active) {
                        $status = "fa-check-circle text-success";
                    } else {
                        $status = "fa-times-circle text-danger";
                    }

                    return '<i class="fa-status fa '.$status.'"></i>';
                })
                ->addColumn('action', function ($sale) use ($businessId) {
                    $csrf = csrf_field();
                    $btn = [];
                    if ($sale->active) {
                        $btn['html'] = 'Deactivate';
                    } else {
                        $btn['html'] = 'Activate';
                    }

                    return '<div class="btn-group product-btn">
                      <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-chevron-down"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-righter">
                      <li><a href="/business/'.$businessId.'/open-orders/'.$sale->sale_url.'"><i class="fa fa-eye fa-fw"></i> Details</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="/sale/'.$sale->sale_url.'" target="_blank"><i class="fa fa-home fa-fw"></i> View Sale Page</a></li>
                      <li role="separator" class="divider"></li>
                        <li><a href="#"><form action="/business/'.$businessId.'/open-orders/'.$sale->sale_url.'" method="POST">'.$csrf.'<input type="hidden" name="_method" value="DELETE" /><i class="fa fa-minus-circle fa-fw"></i> Delete</form></a></li>
                        <li><a href="#" class="btn-active-deactive" data-button="'.$sale->sale_url.'"><i class="fa fa-warning fa-fw"></i> <span class="text-in">'.$btn['html'].'</span></a></li>
                      </ul>
                    </div>';

                    //return '<form action="/business/'.$businessId.'/open-orders/'.$sale->sale_url.'" class="pull-right" method="POST">'.$csrf.'<input type="hidden" name="_method" value="DELETE" /><button type="button" class="btn btn-delete btn-xs btn-danger" style="margin-left: 5px;">Delete</button></form> <button style="margin-left: 5px;" data-button="'.$sale->sale_url.'" class="btn btn-xs btn-active-deactive '.$btn['class'].' pull-right">'.$btn['html'].'</button> <a href="/business/'.$businessId.'/open-orders/'.$sale->sale_url.'" class="btn btn-xs btn-default pull-right">Details</a>';
                })
                ->make(true);
        } else {
            return [];
        }
    }

}
