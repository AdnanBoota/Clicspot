@extends('app')
@push('styles')
<link href="{{ asset('/css/email-list.css') }}" rel='stylesheet' />
<link href="{{ asset('/css/payment.css') }}" rel='stylesheet' />
@endpush
@section('content')

<!-- Content Header (Page header) -->
<!--<section class="content-header">
    <h1>
        Users
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
    </ol>
</section>-->
<div class="row">
    <div class="col-xs-12">
        @include('errors.flash')
    </div>
</div>
<section class="statistics-box">
    <div class="row">
        <div class="statistics">
            <i class="fa fa-fw fa-pie-chart"></i><span>Payment</span>

        </div>
    </div>
</section>
<section class="content">
    <div class="paymentSection">
        <!-- Default box -->
        <div class="box box1">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="small-box">
                            <div class="inner">
                                <h3>Next Billing</h3>
                                <p>{{$nextBillingDate}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="small-box border-radius-none">
                            <div class="inner">
                                <h3>Amount</h3>
                                <p>199&euro;</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box2">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Payment Methods</h3>
                        <p>Please enter your preferred payment mehotd below </p>
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Debit Card</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <h3>Direct Debit</h3>
                                    <div class="col-md-8">
                                        <p>Bank account will be charged annually depending on the number of subscription.</p>
                                        <p>A minimum of one bank is necessary to make the platform working.</p>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="javascript:void(0)" class="btn btn-block btn-default btn-lg">Add Bank Account</a>
                                    </div>
                                    <div class="bankDetails">
                                        <table class="table-bordered">
                                            <tr>
                                                <td>
                                                    ClicSpot XXXXX7816
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm">X</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    ClicSpot XXXXX2671
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm">X</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- nav-tabs-custom -->
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
        <div class="box box3">
            <div class="box-body">
                <div class="row margin-bottom">
                     <div class="col-md-8">
                        <h1>Billing History</h1>
                     </div>
                    <div class="col-md-4">
                          <a href="javascript:void(0)" class="btn btn-block btn-default btn-lg">Edit Profile</a>
                    </div>
                </div>
                <div class="row margin-bottom">
                    <div class="col-md-12">
                       
                        <!-- Custom Tabs -->
                        <table class="table-bordered">
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                   January 5, 2016
                                </td>
                                <td>
                                   Payment (Clicspot)
                                </td>
                                <td>
                                    $13.00
                                </td>
                                <td>
                                     <a href="javascript:void(0)" class="viewInvoice">View Invoice</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    January 1, 2016
                                </td>
                                <td>
                                    Payment (Clicspot)
                                </td>
                                <td>
                                    $30.25
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="viewInvoice">View Invoice</a>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    January 1, 2016
                                </td>
                                <td>
                                    Payment (Clicspot)
                                </td>
                                <td>
                                    $30.25
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="viewInvoice">View Invoice</a>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    January 1, 2016
                                </td>
                                <td>
                                    Payment (Clicspot)
                                </td>
                                <td>
                                    $30.25
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="viewInvoice">View Invoice</a>
                                </td>
                            </tr>
                        </table>
                    </div><!-- /.col -->
                </div>
                <div class="row margin-bottom">
                    <div class="col-md-12">
                          <a href="javascript:void(0)" class="btn btn-block btn-default btn-lg">View Complete History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <!-- /.box -->

</section>
@endsection