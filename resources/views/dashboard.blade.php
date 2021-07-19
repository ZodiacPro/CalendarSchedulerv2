@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-body">
                        <div class="month">      
                            <ul>
                              <li>
                                <input type="text" class="monthtext" value="" disabled/><br>
                                <span style="font-size:18px">
                                <input type="text" class="year" value="" disabled/>
                                </span>
                              </li>
                            </ul>
                          </div>             
                          <ul class="weekdays">
                            <li>Sunday</li>
                            <li>Monday</li>
                            <li>Tuesday</li>
                            <li>Wednesday</li>
                            <li>Thursday</li>
                            <li>Friday</li>
                            <li>Saturday</li>
                          </ul>
                          
                          <ul class="days">
                            @for($y = 1; $y <= $skip; $y++)
                            <li class="day_area"></textarea></li>
                            @endfor
                            @for($x = 1; $x <= $number_of_days ; $x++)
                            <li class="day_area">
                              <div class="card">
                                  <div class="card-header">
                                      {{$x}}
                                  </div>
                                <div class="card-body">
                                      @foreach ($taskdata as $item)
                                          @php
                                            $start_date = strtotime($item->start_date);
                                            $end_date = strtotime($item->end_date);
                                            $loop_date = strtotime(date('Y-m-').($x));
                                          @endphp

                                          @if($start_date <= $loop_date && $end_date >= $loop_date) 
                                              <h6 style="background-color: {{$item->color}}" data-toggle="tooltip" data-placement="top" title="{{$item->description}}">{{$item->name}}<br></h6>
                                          @endif
                                      @endforeach
                                </div>
                              </div>
                            </li>
                            @endfor
                          </ul>
                          
                    </div>
                </div>
            </div>
        </div>
    </div>

        @include('layouts.footers.auth')
    </div>
@endsection
