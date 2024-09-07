@extends('layouts.master')

@section('css')
<!-- Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<style>
    /* Ensure the content area takes at least full viewport height */
    .content {
        min-height: 100vh; /* Ensure the content area takes at least full viewport height */
        display: flex;
        flex-direction: column;
    }

    .content-body {
        flex: 1; /* Allow content to expand */
    }

    #projectsChart {
        max-width: 600px; /* Adjust width as needed */
        height: 300px;   /* Adjust height as needed */
    }
</style>
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
</div>
<!-- /breadcrumb -->
@endsection

@section('content')
<div class="content">
    <div class="content-body">
        <!-- row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card bg-primary-gradient">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon">
                                <i class="icon icon-briefcase"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13 tx-white-8 mb-3">عدد المشاريع</h5>
                                <h2 class="counter mb-0 text-white">30</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card bg-danger-gradient">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon">
                                <i class="icon icon-people"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13 tx-white-8 mb-3">عدد الفرق</h5>
                                <h2 class="counter mb-0 text-white">10</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card bg-success-gradient">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon">
                                <i class="icon icon-home"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13 tx-white-8 mb-3">عدد الشركات</h5>
                                <h2 class="counter mb-0 text-white">5</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card bg-warning-gradient">
                    <div class="card-body">
                        <div class="counter-status d-flex md-mb-0">
                            <div class="counter-icon">
                                <i class="icon icon-users"></i>
                            </div>
                            <div class="mr-auto">
                                <h5 class="tx-13 tx-white-8 mb-3">عدد المستخدمين</h5>
                                <h2 class="counter mb-0 text-white">200</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">عدد المشاريع لكل شركة</h4>
                        <!-- مخطط بياني باستخدام Chart.js -->
                        <canvas id="projectsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
 
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

<script>
    var ctx = document.getElementById('projectsChart').getContext('2d');
    var projectsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['شركة 1', 'شركة 2', 'شركة 3', 'شركة 4', 'شركة 5'],
            datasets: [{
                label: 'عدد المشاريع',
                data: [12, 19, 3, 5, 2],
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection