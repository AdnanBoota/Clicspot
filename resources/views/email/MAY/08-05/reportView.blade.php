    <link href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/list.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css"/> 
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('/plugins/ionslider/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" type="text/css"/> 
<link href="{{ asset('/css/platform-mailing.css') }}" rel="stylesheet" type="text/css"/>

<style>
    /*    .deletebtn{
            display: none !important;
        }*/
    .automailingblock{
        overflow: visible;
    }
    .dropdown-menu span a{
        color: #69737f !important;
        background: none;
        border-radius: none;
        margin: 0px;
    }
    #templateName{
        display: block;
    }
    .titleblock h1{
        float: left;
    }
    .cross_link
    {
        float:right;
        font-size: 20px;
    }
</style>


<section class="creatpart automaticMailing">
    <div class="titleblock">
        <i class="mailingicon">
            <img src="{{ asset("img/mailingicon1.png") }}" />
        </i>
        <h1>Campaign Report</h1>
        <span class="cross_link" ><a href="{{url()}}/emails?manual=manual">X</a></span>
    </div> 
    <div class="manualmailblock">
        <div class="container-fluid">
<!--
        <div class="selectbox">
            <select>
                <option>Email Campaign</option>
                <option>Email Campaign</option>
                <option>Email Campaign</option>
            </select>
        </div>
-->
            <div class="row">
                <div class="col-md-6">
                    <div class="reportleftimgblock">
                        <?php
                        $full_containt = public_path().'/template_builder/html/'.$statictic['adminId'].'/'.$statictic['templateName'].'.html';
echo			$contentstemplate = file_get_contents($full_containt);

                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="manualmailingdata">
                        <div class="manualdatadesc">
                            <div class="manual_titleblock">
                                <h3>Targeted</h3>
                                <span>{{ $statictic['date'] }}</span>
                            </div>
                            <div class="manualdatadetail">
                                <span>{{ $statictic['total_count'] }}</span>
                            </div>
                        </div>
                        <div class="manualdatadesc">
                            <div class="manual_titleblock">
                                <h3>Delivered</h3>
                                <span>{{$statictic['total_deliver_per']}} %</span>
                            </div>
                            <div class="manualdatadetail manualdatadetail2">
                                <span>{{$statictic['deliver']}}</span>
                            </div>
                        </div>
                        <div class="manualdatadesc">
                            <div class="manual_titleblock">
                                <h3>OPENS</h3>
                                <span>{{$statictic['total_open_per']}} %</span>
                            </div>
                            <div class="manualdatadetail manualdatadetail3">
                                <span>{{$statictic['open']}}</span>
                            </div>
                        </div>
                        <div class="manualdatadesc">
                            <div class="manual_titleblock">
                                <h3>CLICKS</h3>
                                <span>{{$statictic['total_click_per']}} %</span>
                            </div>
                            <div class="manualdatadetail manualdatadetail4">
                                <span>{{$statictic['click']}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="manualdatadescblock active">
                                <span>{{ $statictic['total_count'] }}<i class="targeticon"></i></span>
                                <p>Targeted</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="manualdatadescblock">
                                <span>{{$statictic['deliver']}}<i class="accepticon"></i></span>
                                <p>Accepted</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="manualdatadescblock">
                                <span>{{$statictic['open']}}<i class="openicon"></i></span>
                                <p>Opens</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="manualdatadescblock">
                                <span>{{$statictic['click']}}<i class="clickicon"></i></span>
                                <p>Clicks</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="reporttableblock">
                        <table class="reporttable">
                            <thead>
                                <tr>
                                    <th>Rate</th>
                                    <th>Users</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <?php  
                        
                        foreach($rateuser as $users)
                        {
                         ?>
                                <tr>
                                    <td>
                                        <ul class="starblock">
                                        <?php for($i=1;$i<=$users['rate'];$i++){
                                        ?>
                                        <li><img src="{{ asset("img/starimg.png") }}" /></li>
                                        <?php   
                                        }   
                                        ?>
                                    </ul>
                                    </td>
                                    <td>{{$users['email']}}</td>
                                    <td>{{$users['date']}}</td>
                                    <td>
                                      <?php if($users['rate']=='1'){ ?>
                                        <img src="{{ asset("img/acceptimg.png") }}" />
                                      <?php }if($users['rate']=='2'){ ?>
                                        <img src="{{ asset("img/opensimg.png") }}" />
                                       <?php }if($users['rate']=='3'){ ?>
                                            <img src="{{ asset("img/clicksimg.png") }}" />
                                       <?php }if($users['rate']==''){ ?>
                                            <img src="{{ asset("img/targetimg.png") }}" />
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                        
                        <?php
                            
                        }
                        ?>
                            </tbody>  
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- DataTables -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>

<script src="{{ asset('/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('/plugins/ionslider/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('/plugins/chartjs/Chart.js') }}"></script>
<!--<script src="{{ asset('/plugins/chartjs/Chart.min.js') }}"></script>-->
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/dataTables.responsive.js') }}"></script>



 


