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
            <i class="fa fa-fw fa-pie-chart"></i><span>{{ Lang::get('auth.payment') }} </span>

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
                                <h3>{{ Lang::get('auth.nextbill') }}</h3>
                                <p>{{$nextBillingDate}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="small-box border-radius-none">
                            <div class="inner">
                                <h3>{{ Lang::get('auth.amount') }}</h3>
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
                        <h3>{{ Lang::get('auth.paymentmethod') }}</h3>
                        <p>{{ Lang::get('auth.paymentbelow') }}</p>
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">{{ Lang::get('auth.debit') }}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <h3>{{ Lang::get('auth.debit') }}</h3>
                                    <div class="col-md-8">
                                        <p>{{ Lang::get('auth.bankcharg') }}</p>
                                        <p>{{ Lang::get('auth.onebank') }}</p>
                                    </div>
                                    <div class="col-md-4"><!-- btn-lg-->
                                        <a href="javascript:void(0)" target="_blank" class="btn btn-block btn-default " id="addAccount" style="">{{ Lang::get('auth.addbank') }} </a>
<!--                                        <a href="" style="visibility: hidden" id="payment" target="_blank"></a>-->
                                        </div>
                                    <div class="bankDetails">
                                        <table class="table-bordered">
                                            <tr>
                                                <td>
                                                    CLICSPOT {{$resourceID}}
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
                        <h1>{{ Lang::get('auth.billhistory') }}</h1>
                    </div>
                    <div class="col-md-4">
                        <a href="{{"/payment/4"}}" class="btn btn-block btn-default btn-lg">{{ Lang::get('auth.editprofile') }}</a>
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
                            @foreach($billingDetails as $bill)
                            <tr>
                                <td>
                                   {{date('M-d-Y', strtotime($bill->nextpaymentdate))}}
                                </td>
                                <td>
                                     {{$bill->description}}
                                </td>
                                <td>
                                   ${{$bill->amount}}
                                </td>
                                <td>
<!--                                    <a href="javascript:void(0)" class="viewInvoice">View Invoice</a>-->
                                </td>
                            </tr>
                            @endforeach
                     
                        </table>
                    </div><!-- /.col -->
                </div>
<!--                <div class="row margin-bottom">
                    <div class="col-md-12">
                        <a href="javascript:void(0)" class="btn btn-block btn-default btn-lg">View Complete History</a>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <!-- /.box -->

</section>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", "#addAccount", function() {
            jQuery.ajax({
                url: '/payment/goCardless',
                type: 'post',
                data: {
                 
                    "_token": '{{csrf_token()}}'

                },
                success: function(result) {
                    //$("#payment").attr("href",result);
                    //$("#payment").trigger("click");
                    //console.log(result);
                    window.open('','_blank').location.href=result;
                  // window.location.href=result;
                   //window.open(result);

                }
            });
        });
//        $("#payment").click(function(){
//             window.open($(this).attr("href"),"","");
//            
//        });
        
    });
</script>
@endpush