@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">List All Expired Booking</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Booking</a></li>
                        <li class="breadcrumb-item active">List All Expired Booking</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">List All Expired Booking</h5>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            <th>SR No.</th>
                            <th>Booking ID</th>
                            <th data-ordering="false">Name</th>
                            <th>Transaction ID</th>
                            <th data-ordering="false">Booking Date</th>
                            <th data-ordering="false">Total Amount</th>
                            <th data-ordering="false">Payment Method</th>
                            <th data-ordering="false">Payment Status</th>
                            <th data-ordering="false">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expiredBookings as $key => $expiredBooking)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                               value="option1">
                                    </div>
                                </th>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <a href="{{route('admin.booking.show', $expiredBooking->id)}}"
                                       style="color: #0ac7fb">{{$expiredBooking->id}}</a>
                                </td>
                                <td>{{$expiredBooking->user->name}}</td>
                                <td>{{$expiredBooking->transaction_id}}</td>
                                <td>{{Carbon\Carbon::parse($expiredBooking->booking_date)->format('d M Y')}}</td>
                                <td>Rp {{number_format($expiredBooking->total_amount, 0, ',', '.')}}</td>
                                <td>
                                    {{ ucwords(str_replace('_', ' ', substr($expiredBooking->payment->payment_method, 0, strrpos($expiredBooking->payment->payment_method, ' - ')))) }}
                                    -
                                    {{ strtoupper(substr($expiredBooking->payment->payment_method, strrpos($expiredBooking->payment->payment_method, ' - ') + 3)) }}
                                </td>
                                <td>
                                    @if($expiredBooking->payment->payment_status === 'settlement')
                                        <span class="badge bg-success-subtle text-success">Settlement</span>
                                    @elseif($expiredBooking->payment->payment_status === 'pending')
                                        <span class="badge bg-danger-subtle text-warning">Pending</span>
                                    @elseif($expiredBooking->payment->payment_status === 'cancel')
                                        <span class="badge bg-danger-subtle text-danger">Cancel</span>
                                    @elseif($expiredBooking->payment->payment_status === 'expire')
                                        <span class="badge bg-danger-subtle text-danger">Expire</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-danger">Failure</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-danger">Expired</span>
                                </td>
                                <td>
                                    <a href="{{route('admin.booking.show', $expiredBooking->id)}}"
                                       class="btn btn-info btn-sm">Show</a>
                                    <a href="{{route('admin.booking.destroy', $expiredBooking->id)}}"
                                       class="btn btn-danger btn-sm delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
