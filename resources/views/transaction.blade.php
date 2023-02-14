
@include('header')
 <!------------------ TRANSACTIONS ------------------->

 <div class="container-fluid">
                            <div class="main-title">
                                <h1>Transaction</h1>
                            </div>
                            <div class="card table-responsive">
                                <table class="table table-striped table-hover" id="tableTransaction" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">User Info</th>
                                            <th scope="col">Transaction NO</th>
                                           <!-- <th scope="col">Wallet Address</th> -->
                                            <th scope="col">Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $value)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                <a href="https://stock-wise.online/ci_api/{{ $value->screenshotImage }}" target="_blank">
                                                    <img class="logo" src="https://stock-wise.online/ci_api/{{ $value->screenshotImage }}" alt="">
                                                </a>
                                             </td>
                                                    <!-- <div>
                                                        <h3 class="card-title">Beauty</h3>
                                                        <p class="mb-0">abc@gmail.com</p>
                                                    </div> -->
                                                </div>

                                                  <!--  <td>{{ $value->transectionId }}</td> -->
                                                    <td>{{ $value->transectionNo }}</td>
                                                    <td>{{ $value->addDate }}</td>
                                                    <td><b>{{ $value->amount }}</b></td>
                                                    <td>
                                                            @if ($value->isApproved == 0)
                                                                <span class="badge bg-warning text-dark">Pending</span>
                                                            @else
                                                                {{ $value->isApproved }}
                                                            @endif
                                                        </td>
                                                    <td>
                                                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                    <a class="link-icon editbtn" data-bs-toggle="modal" data-bs-target="#transactionModal" href="#" data-id="{{$value->transectionId}}">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a class="link-icon" id="deletetransectionbtn" href="#" data-id="{{$value->transectionId}}">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                                    <!------------------END TRANSACTIONS ------------------->




<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Transaction Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="" id="transactiondetail">
                        <!-- Hidden id -->
                        <input type="text" name="transectionId" value="" id="eid" hidden>
                        <!-- Hidden id -->

                        <div class="col-lg-8">
                            <h5 class="text" id="userid">User Id: <span></span></h5>
                            <h5 class="text" id="transectionNo">Transection No: <span></span></h5>
                            <h5 class="text" id="addDate">Date: <span></span></h5>
                            <h5 class="text" id="transaction_type"> Transaction Type: <span></span></h5>
                            <h1 class="amount" id="getamount"></h1>
                        </div>
                        <div class="col-lg-4">
                            <a href="" class="img-wrapper mb-3" data-image-lightbox target="_blank">
                                <img class="img-fluid" id="modalImage" alt="">

                            </a>
                        </div>
                    </form>
                </div>

                <div class="input-wrapper mb-3">
                    <input type="text" class="form-control w-100" id="amount" name="amount" value="" placeholder="Enter amount">
                </div>
                <button type="button" id="sendbtn" class="btn btn-primary w-100">Send</button>
            </div>
        </div>
    </div>
    @include('footer')

    <script>
        
        //---- 	Transection data get ajax ------>
    $(document).on('click', '.editbtn', function() {
        var id = $(this).data('id');
        $.get('dashboard/' + id + '/transectiongetdata', function(res) {
        $('#transactiondetail')[0].reset();
        $('#transactionModal').modal("show");
        $('#eid').val(res.transectionId);
        $('#userid span').text(res.userid);
        $('#transectionNo span').text(res.transectionNo);
        $('#addDate span').text(res.addDate);
        $('#amount').val(res.amount);
        $('#transaction_type').text(res.transaction_type);
        $('#getamount').text(res.amount);
        var imageSrc = res.screenshotImage;
        $('.img-fluid').attr('src', imageSrc);
        $('.img-wrapper').attr('href', imageSrc);
    });
});

     //---- 	END Transection data get ajax ------>

     //---- 	UPDATE Transection data  ajax ------>

     $('#sendbtn').click(function() {
    var transectionId = $('#eid').val();
    var userid = $('#userid span').text();
    var transectionNo = $('#transectionNo span').text();
    var addDate = $('#addDate span').text();
    var transaction_type = $('#transaction_type span').text();
    var amount = $('#amount').val();
    var screenshotImage = $('#modalImage').attr('src');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "PUT",
        url: "{{ route('update.transections') }}",
        data: {
            transectionId: transectionId,
            userid: userid,
            transectionNo: transectionNo,
            addDate: addDate,
            amount: amount,
            screenshotImage: screenshotImage,
            transaction_type: transaction_type
        },
        success: function(response) {
            if (response.success) {
                swal({
                    icon: 'success',
                    title: 'Successfully',
                    text: 'Amount Added',
                    timer: 1500
                }).then(() => {
                    location.reload();
                });
            } else {
                swal({
                    icon: 'error',
                    title: "Try Again",
                    timer: 1500
                });
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            swal({
                icon: 'error',
                title: "Your Transection Already Exist",
                text: "Please try again",
            });
        }
    });
});


        //--- Delete Transection data Ajax ---->

        $(document).on('click', '#deletetransectionbtn', function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var id = $(this).data('id');

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: ["Cancel", "Delete"],
        dangerMode: true,
    }).then(function(confirmDelete) {
        if (confirmDelete) {
            $.ajax({
                type: 'delete',
                url: "dashboard/transectiondestroy/" + id,
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        swal({
                            icon: 'success',
                            title: 'Successfully',
                            text: 'Deleted',
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        swal({
                            icon: 'error',
                            title: "Try Again",
                            timer: 1500
                        });
                    }
                },
                error: function() {
                    swal({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to delete',
                        timer: 1500
                    });
                }
            });
        } else {
            swal("Your Transection is safe!");
        }
    });
});

    </script>