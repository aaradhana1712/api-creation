@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<section class="no-padding-top no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-user-1"></i></div><strong>New Clients</strong>
                        </div>
                        <div class="number dashtext-1">27</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-contract"></i></div><strong>New Projects</strong>
                        </div>
                        <div class="number dashtext-2">375</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>New Invoices</strong>
                        </div>
                        <div class="number dashtext-3">140</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                    <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                            <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All Projects</strong>
                        </div>
                        <div class="number dashtext-4">41</div>
                    </div>
                    <div class="progress progress-template">
                        <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="checklist-block block">
                    <div class="title"><strong>To Do List</strong></div>
                    <div class="checklist">
                        <div class="item d-flex align-items-center">
                            <input type="checkbox" id="input-1" name="input-1" class="checkbox-template">
                            <label for="input-1">Complete project documentation</label>
                        </div>
                        <div class="item d-flex align-items-center">
                            <input type="checkbox" id="input-2" name="input-2" checked class="checkbox-template">
                            <label for="input-2">Review user feedback</label>
                        </div>
                        <div class="item d-flex align-items-center">
                            <input type="checkbox" id="input-3" name="input-3" class="checkbox-template">
                            <label for="input-3">Update system security</label>
                        </div>
                        <div class="item d-flex align-items-center">
                            <input type="checkbox" id="input-4" name="input-4" class="checkbox-template">
                            <label for="input-4">Prepare monthly reports</label>
                        </div>
                        <div class="item d-flex align-items-center">
                            <input type="checkbox" id="input-5" name="input-5" class="checkbox-template">
                            <label for="input-5">Schedule team meeting</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">                                           
                <div class="messages-block block">
                    <div class="title"><strong>Recent Activity</strong></div>
                    <div class="messages">
                        <a href="#" class="message d-flex align-items-center">
                            <div class="profile">
                                <img src="{{ asset('img/avatar-3.jpg') }}" alt="..." class="img-fluid">
                                <div class="status online"></div>
                            </div>
                            <div class="content">   
                                <strong class="d-block">New user registered</strong>
                                <span class="d-block">John Doe joined the platform</span>
                                <small class="date d-block">2 hours ago</small>
                            </div>
                        </a>
                        <a href="#" class="message d-flex align-items-center">
                            <div class="profile">
                                <img src="{{ asset('img/avatar-2.jpg') }}" alt="..." class="img-fluid">
                                <div class="status away"></div>
                            </div>
                            <div class="content">   
                                <strong class="d-block">Order completed</strong>
                                <span class="d-block">Order #12345 has been processed</span>
                                <small class="date d-block">5 hours ago</small>
                            </div>
                        </a>
                        <a href="#" class="message d-flex align-items-center">
                            <div class="profile">
                                <img src="{{ asset('img/avatar-1.jpg') }}" alt="..." class="img-fluid">
                                <div class="status busy"></div>
                            </div>
                            <div class="content">   
                                <strong class="d-block">System update</strong>
                                <span class="d-block">Database backup completed</span>
                                <small class="date d-block">1 day ago</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="stats-with-chart-2 block">
                    <div class="title">
                        <strong class="d-block">Monthly Sales</strong>
                        <span class="d-block">Revenue overview</span>
                    </div>
                    <div class="piechart chart">
                        <canvas id="pieChartHome1"></canvas>
                        <div class="text">
                            <strong class="d-block">$2,145</strong>
                            <span class="d-block">Sales</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stats-with-chart-2 block">
                    <div class="title">
                        <strong class="d-block">User Growth</strong>
                        <span class="d-block">Active users</span>
                    </div>
                    <div class="piechart chart">
                        <canvas id="pieChartHome2"></canvas>
                        <div class="text">
                            <strong class="d-block">1,284</strong>
                            <span class="d-block">Users</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stats-with-chart-2 block">
                    <div class="title">
                        <strong class="d-block">Performance</strong>
                        <span class="d-block">System metrics</span>
                    </div>
                    <div class="piechart chart">
                        <canvas id="pieChartHome3"></canvas>
                        <div class="text">
                            <strong class="d-block">94%</strong>
                            <span class="d-block">Uptime</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    console.log('Dashboard loaded successfully!');
</script>
@endpush