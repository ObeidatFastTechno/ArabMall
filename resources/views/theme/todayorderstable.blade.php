<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>#</th>
            <th>User Name</th>
            <th>Order Number</th>
            <th>Payment Type</th>
            <th>Payment ID</th>
            <th>Order Status</th>
            <th>Order Assigned To</th>
            <th>Order Type</th>
            <th>Order date</th>
            <th>Change Order Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($todayorders as $orders) {
        ?>
        <tr id="dataid{{$orders->id}}">
            <td>{{$orders->id}}</td>
            <td>{{$orders['users']->name}}</td>
            <td>{{$orders->order_number}}</td>
            <td>
                @if($orders->payment_type =='0')
                    COD
                @elseif($orders->payment_type =='1')
                    RazorPay
                @elseif($orders->payment_type =='2')
                    Stripe
                @elseif($orders->payment_type =='3')
                    Wallet
                @endif
            </td>
            <td>
                @if($orders->razorpay_payment_id == '')
                    --
                @else
                    {{$orders->razorpay_payment_id}}
                @endif
            </td>
            <td>
                @if($orders->status == '1')
                    Order Received
                @elseif ($orders->status == '2')
                    On the way
                @elseif ($orders->status == '3')
                    Assigned to Driver
                @elseif ($orders->status == '4')
                    Delivered
                @elseif ($orders->status == '5')
                    Cancelled by User
                @elseif ($orders->status == '6')
                    Cancelled by Admin
                @endif
            </td>
            <td>
                @if ($orders->name == "")
                    --
                @else
                    {{$orders->name}}
                @endif
            </td>
            <td>
                @if($orders->order_type == 1)
                    Delivery
                @else
                    Pickup
                @endif
            </td>
            <td>
                @if($orders->ordered_date > $date)
                    {{$orders->ordered_date}} <br>
                    <span class="badge badge-info">Future Order</span>
                @else
                    {{$orders->ordered_date}}
                @endif
            </td>
            <td>
                @if($orders->status == '1')
                    <a ddata-toggle="tooltip" data-placement="top" onclick="StatusUpdate('{{$orders->id}}','2')" title="" data-original-title="Order Received">
                        <span class="badge badge-secondary px-2" style="color: #fff;">Order Received</span>
                    </a>
                @elseif ($orders->status == '2')
                    @if ($orders->order_type == '2')
                        <a class="badge badge-primary px-2" onclick="StatusUpdate('{{$orders->id}}','4')" style="color: #fff;">Pickup</a>
                    @else
                        <a class="open-AddBookDialog badge badge-primary px-2" data-toggle="modal" data-id="{{$orders->id}}" data-target="#myModal" style="color: #fff;">Assign To Driver</a>
                    @endif
                @elseif ($orders->status == '3')
                    <a ddata-toggle="tooltip" data-placement="top" title="" onclick="StatusUpdate('{{$orders->id}}','4')" data-original-title="Out for Delivery" data-id="{{$orders->id}}">
                        <span class="badge badge-success px-2" style="color: #fff;">Assigned to Driver</span>
                    </a>
                @elseif ($orders->status == '4')
                    <a ddata-toggle="tooltip" data-placement="top" title="" data-original-title="Out for Delivery">
                        <span class="badge badge-success px-2" style="color: #fff;">Delivered</span>
                    </a>
                @else
                    <span class="badge badge-danger px-2">Cancelled</span>
                @endif

                @if ($orders->status != '4' && $orders->status != '5' && $orders->status != '6')
                    <a data-toggle="tooltip" data-placement="top" onclick="StatusUpdate('{{$orders->id}}','6')" title="" data-original-title="Cancel">
                        <span class="badge badge-danger px-2" style="color: #fff;">Cancel</span>
                    </a>
                @endif
            </td>
            <td>
                <span>
                    <a data-toggle="tooltip" href="{{URL::to('admin/invoice/'.$orders->id)}}" data-original-title="View">
                        <span class="badge badge-warning">View</span>
                    </a>
                </span>
            </td>
        </tr>
        <?php
        $i++;
        }
        ?>
    </tbody>
</table>