<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Select Date</h5>
                                    <form class="form">
                                        <select class="form-control" class="slctmonth" id="slctmonth">
                                            <option @if(date('m') == '01') selected @endif value="01">January</option>
                                            <option @if(date('m') == '02') selected @endif value="02">Febuary</option>
                                            <option @if(date('m') == '03') selected @endif value="03">March</option>
                                            <option @if(date('m') == '04') selected @endif value="04">April</option>
                                            <option @if(date('m') == '05') selected @endif value="05">May</option>
                                            <option @if(date('m') == '06') selected @endif value="06">June</option>
                                            <option @if(date('m') == '07') selected @endif value="07">July</option>
                                            <option @if(date('m') == '08') selected @endif value="08">August</option>
                                            <option @if(date('m') == '09') selected @endif value="09">September</option>
                                            <option @if(date('m') == '10') selected @endif value="10">October</option>
                                            <option @if(date('m') == '11') selected @endif value="11">November</option>
                                            <option @if(date('m') == '12') selected @endif value="12">December</option>
                                        </select>
                                        <br>
                                        <select class="form-control" class="slctyear" id="slctyear" onchange="yearchange()">
                                            @for($x=2010; $x<= 2050 ; $x++)
                                            <option @if(date('Y') == $x) selected @endif value = "{{$x}}">{{$x}}</option>
                                            @endfor
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Task</h5>
                                    <span class="h2 font-weight-bold mb-0">{{$taskCount}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i>{{$taskCount}}%</span>
                                    <span class="text-nowrap">Overall task data</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Add Task</h5>
                                    
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow" id="clipdiv">
                                        <i class="fas fa-clipboard" id="clipicon"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <label for="name">Name:</label>
                                            <input class="form-control" name="name" id="name" placeholder="Name" required />
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <label for="description">Description:</label>
                                            <input class="form-control" name="description" id="description" placeholder="Description" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <label for="name">From:</label>
                                            <input type="datetime-local" class="form-control" name="from" id="from" placeholder="Name" required />
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <label for="description">To:</label>
                                            <input type="datetime-local" class="form-control" name="to" id="to" placeholder="Description" required />
                                        </div>
                                        <input type="text" id="creator_id" value="{{Auth::user()->id}}" hidden/>
                                    </div>
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

