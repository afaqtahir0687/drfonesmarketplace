@extends('frontend.master')
@section('title')
<title>Search IMEI | | DrFones Market Place</title>
@endsection

@section('content')

<section class="mt-50 mb-50">
    <!--begin::Content-->
<div class="content pt-0 d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <!--begin::Hero-->
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url('assets/media/bg/bg-9.jpg')">
        <div class="container">

            <div class="d-flex align-items-stretch text-center flex-column py-10">
                <!--begin::Heading-->
                <h1 class="text-dark font-weight-bolder mb-30">IMEI Verification</h1>
                <!--end::Heading-->
                <!--begin::Form-->
                <div class="row mb-4">
                   <div class="col-md-2"></div>
                   <div class="col-md-8">
                    <div class="header-area header-style-3 header-height-2">
                        <div class="header-wrap">
                            <div class="header-right">
                                <div class="search-style-2">
                                    <form action="">
                                        <input type="text" name="q" placeholder="Search for items..." value="{{ request()->q ?? '' }}">
                                        <div class="col-md-6 ">
                                            <button class="btn btn-outline-success search--btn" type="submit">
                                                Search
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                   </div>
                   <div class="col-md-2"></div>
                </div>
               
                <!--end::Form-->
            </div>
        </div>
    </div>
    <!--end::Hero-->
    <!--begin::Section-->
    <div class="container py-8">
        <div class="">
            @if ($table == 0)
                <div class="row">
                    <div class="col-md-3 m-h-auto"></div>
                    <div class="col-md-6 m-h-auto">
                        <div class="text-center m-b-50">
                            <h5 class="font-weight-light font-size-30 m-b-20">Now you can Verify your IMEI/Serial </h5>
                            <p class="w-70 lh-1-8 m-h-auto font-size-17">DrFones is the most reliable enterprise solution for certifying used devices as well as diagnosing and unlocking mobile devices.It provide network unlocking, ESN verification, MDM removal/verification, and carrier verification.</p>
                            <p class="w-70 lh-1-8 m-h-auto font-size-17"></p>
                        </div>
                    </div>
                </div>
            @else
                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table" id="e-commerce-table">
                                    <thead>
                                        <tr>
                                            <th>Get Report</th>
                                            @if (!empty($keys))
                                                @for ($i = 0; $i < count($keys); $i++)
                                                    @if(!in_array($keys[$i],['Pass','Fail']))
                                                        <th>{{ $keys[$i] }}</th>
                                                    @endif
                                                @endfor
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($records))
                                        @foreach ($records as $row => $val )
                                            <tr>
                                                <td><a target="_blank" href="https://drfonescloud.com/cloud-lookup-qr?IMEI={{ $val['Serial'] ?? '' }}&USERID={{ $val['UserID'] }}" class="btn font-weight-bolder text-uppercase font-size-lg btn-primary">Report</a></td>
                                                <td>{{ $val['UserID'] }}</td>
                                                <td>{{ $val['ModelNo'] }}</td>
                                                <td>{{ $val['ModelName'] }}</td>
                                                <td>{{ $val['Color'] }}</td>
                                                <td>{{ $val['Memory'] }}</td>
                                                <td>{{ $val['Carrier'] }}</td>
                                                <td>{{ $val['Serial'] }}</td>
                                                <td>{{ $val['Imei'] }}</td>
                                                <td>{{ $val['Imei2'] }}</td>
                                                <td>{{ $val['Firmware'] }}</td>
                                                <td>{{ $val['Version'] }}</td>
                                                <td>{{ $val['Os'] }}</td>
                                                <td>{{ $val['Userid'] }}</td>
                                                <td>{{ $val['Wipe'] }}</td>
                                                <td>{{ $val['Fmi'] }}</td>
                                                <td>{{ $val['Jailbreak'] }}</td>
                                                <td>{{ $val['ESN'] }}</td>
                                                <td>{{ $val['ESNR'] }}</td>
                                                <td>{{ $val['ANumber'] }}</td>
                                                <td>{{ $val['Manufacturer'] }}</td>
                                                <td>{{ $val['Regioncode'] }}</td>
                                                <td>{{ $val['Batterymodel'] }}</td>
                                                <td>{{ $val['Batteryserial'] }}</td>
                                                <td>{{ $val['Batteryhealth'] }}</td>
                                                <td>{{ $val['Designcapacity'] }}</td>
                                                <td>{{ $val['Currentcapacity'] }}</td>
                                                <td>{{ $val['Cyclecount'] }}</td>
                                                <td>{{ $val['Temperature'] }}</td>
                                                <td>{{ $val['Comments'] }}</td>
                                                <td>{{ $val['Transactionno'] }}</td>
                                                <td>{{ $val['Grade'] }}</td>
                                                <td>{{ $val['CustomerName'] }}</td>
                                                <td>{{ $val['InvoiceNo'] }}</td>
                                                <td>{{ $val['TesterName'] }}</td>
                                                <td>{{ $val['Time'] }}</td>
                                                <td>{{ $val['Count'] }}</td>
                                                <td>{{ $val['SimLock'] }}</td>
                                                <td>{{ $val['IsLatest'] }}</td>
                                                <td>{{ $val['Price'] }}</td>
                                                <td>{{ $val['Status'] }}</td>
                                                <td>{{ $val['OEMData'] }}</td>
                                                <td>{{ $val['PCName'] }}</td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 m-auto entry-main-content mt-20">
                        <h3 class="section-title style-1 mb-10">Battery info</h3>
                        <div class="font-md mb-20">
                            <div class="row">
                                <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <strong>Battery Model</strong>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <p> <span class="in-stock text-success ml-5">{{ $val['Batterymodel'] ?? 'N/A' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <strong>Cycle Count</strong>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <p> <span class="in-stock text-success ml-5">{{ $val['Cyclecount'] ?? 'N/A' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <strong>Battery Healt</strong>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <p> <span class="in-stock text-success ml-5">{{ $val['Batteryhealth'] ?? 'N/A' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <strong>Design Capacity</strong>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <p> <span class="in-stock text-success ml-5">{{ $val['Designcapacity'] ?? 'N/A' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <strong>Current Capacity</strong>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <p> <span class="in-stock text-success ml-5">{{ $val['Currentcapacity'] ?? 'N/A' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <strong>Temperature</strong>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                    <div class="p-1 ps-3 borderd-pdp">
                                        <p> <span class="in-stock text-success ml-5">{{ $val['Temperature'] ?? 'N/A' }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="section-title style-1 mb-10">Pass Tests</h3>
                        @php
                            $pass = array();
                            if(!empty($val['Pass']))
                            {
                                $pass = explode(',',$val['Pass']);
                            }
                        @endphp
                        <div class="font-md mb-20">
                            <div class="row">
                                @if(count($pass) > 0)
                                    @for($i=0; $i < count($pass); $i++)
                                        <div class="col-md-3 col-sm-6 col-xs-8 pe-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <strong>{{ $pass[$i] ?? '' }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-6 col-xs-4 ps-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <p> <span class="in-stock text-success ml-5">Pass</span></p>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    <div class="col-md-12 col-sm-12 col-xs-12 ps-0 mt-1">
                                        <div class="p-1 ps-3 borderd-pdp">
                                            <p> <span class="in-stock text-Warning ml-5">No Result Found</span></p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <h3 class="section-title style-1 mb-10">Fail Tests</h3>
                        @php
                            $fail = array();
                            if(!empty($val['Fail']))
                            {
                                $fail = explode(',',$val['Fail']);
                            }
                        @endphp
                        <div class="font-md mb-20">
                            <div class="row">
                                @if(count($fail) > 0)
                                    @for($i=0; $i < count($fail); $i++)
                                        <div class="col-md-3 col-sm-8 col-xs-8 pe-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <strong>{{ $fail[$i] ?? '' }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-4 col-xs-4 ps-0 mt-1">
                                            <div class="p-1 ps-3 borderd-pdp">
                                                <p> <span class="in-stock text-danger ml-5">Fail</span></p>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    <div class="col-md-12 col-sm-12 col-xs-12 ps-0 mt-1">
                                        <div class="p-1 ps-3 borderd-pdp">
                                            <p> <span class="in-stock text-Warning ml-5">No Result Found</span></p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
    <!--end::Section-->

</div>
<!--end::Content-->

</section>
@endsection
@section('script-bottom')
@endsection
