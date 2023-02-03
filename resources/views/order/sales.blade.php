@extends('layouts.app')

@section('browserTitle')
Sales Report
@endsection

@section('title')
Sales Report
@endsection


@section('mainContent')

    {{-- <div class="row text-center justify-content-center py-2">
        <div class="col-9 h2 my-0">Sales Report</div>
    </div>
    <div class="border-bottom border-danger"></div> 

    <div class="row mx-0 py-2 px-0 fw-semibold border-bottom border-3">
        <div class="col-6 h5  text-center">Date</div>
        <div class="col-6 h5   text-center">Total</div>
    </div> --}}


    <?php 
        $tempdate = "temp"; 
        $lastsum = 0;
        $i = 0;
    ?>


    <!-- if user logins -->
    @if(Auth::user()) 

        @foreach($orders as $order)

        @if(isset(Auth::user()->id) && Auth::user()->id == $order->rest_id && $order->payment_done == 'true' && $order->order_status == 'served')
            <?php
                $datetime = strtotime($order->date_time);
                $date = date("d/m/y", $datetime);
                $time = date("h:i A", $datetime);
                $day = date("D", $datetime);
                $bill = number_format(($order->order_total), 2);
                
            ?>

            @if($tempdate != $date)

                @if(isset($sum))
                <div class="row text-center justify-content-end pt-2">
                    <div class="col-6">
                        <p class="fw-bold my-0">Daily Total :</p>
                    </div>
                    <div class="col-4 ps-0"> 
                        <p class="fw-bold text-end my-0">RM {{number_format(($sum), 2)}}</p>
                    </div>
                    <div class="col-2"></div>
                </div>

                <div class="border-bottom border-danger pt-2"></div>
                @endif

                <div class="row text-center justify-content-center pt-2 pb-2">
                    <div class="col-6 ps-0"> 
                        <p class="fw-bold my-0"><u>{{$date}} ({{$day}})</u></p>
                    </div>
                </div>

                    <?php  
                        $sum = 0;
                    ?>

            @endif


            {{-- <div class="row text-center justify-content-start">
                <div class="col-6 ps-0 ">{{$time}}</div>
                <div class="col-4 ps-0 text-end">{{$bill}}</div>
            </div> --}}


            <div class="accordion accordion-flush" id="accordionFlushExample{{$i}}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne{{$i}}">
                        
                        <div class="row justify-content-start">
                            <div class="col-6">
                                <p class="h6 fw-normal text-center my-0">{{$time}}</p>
                            </div>
                            <div class="col-4">
                                <p class="h6 fw-normal text-end my-0">{{$bill}}</p>
                            </div>
                            <div class="col-2">
                                <button class="accordion-button collapsed py-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$i}}" aria-expanded="false" aria-controls="flush-collapseOne">
                                </button>
                            </div>
                        </div>
                        
                        

                    </h2>
                    <div id="flush-collapseOne{{$i}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">

                            <div class="row  mx-0 pb-2">
                                <div class="col-6 p border-bottom border-top">Item</div>
                                <div class="col-3 p border-bottom border-top px-0 text-center">Quantity</div>
                                <div class="col-3 p border-bottom border-top text-center">Price</div>
                            </div>
                        
                            @foreach ($orderlines as $orderline)
                                @if($order->order_id == $orderline->order_id)
                                <div class="row justify-content-start align-items-center mx-0 pb-2" >
                                    <div class="col-6 ">{{$orderline->items->item_name}}</div>
                                    <div class="col-3 px-0 text-center">{{$orderline->item_qty}}</div> 
                                    <div class="col-1 text-end px-0 ">RM</div>
                                    <div class="col-2 text-end ps-0">{{ number_format(($orderline->orderline_price), 2) }}</div>
                                </div>
                                @endif

                                @if($loop->last)
                                    <div class="row mx-0 pb-2 border-top"></div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
                
            </div>
            

            <?php
                $i++;
                $sum+=$bill;
                $tempdate = $date;
                $lastsum = $sum;
            ?>


        @endif

        @if($loop->last)
        <div class="row text-center justify-content-end pt-2">
            <div class="col-4 ps-0"> 
                <p class="fw-bold my-0 text-end">{{number_format(($lastsum), 2)}}</p>
            </div>
            <div class="col-2"></div>
        </div>
        @endif

        @endforeach

    @endif

@endsection