@include('header')
<!------------------ WithDRAW REQUEST ------------------->
<div class="container-fluid">
    <div class="main-title">
        <h1>Withdraw Requests</h1>
    </div>
    <div class="card table-responsive">
        <table class="table table-striped table-hover" id="tableWithdraw" style="width:100%;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">wallet Address</th>
                    <th scope="col">Amount</th>
                    <th scope="col">User id</th>
                    <th scope="col">Add Date</th>
                    <th scope="col">Is Approved</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr> -->
                <!-- <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <img class="logo"
                                                        src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                                            alt="">
                                                    <div>
                                                        <h3 class="card-title">John</h3>
                                                        <p class="mb-0">abc@gmail.com</p>
                                                    </div>
                                                </div> -->
                @foreach ($draw as $value)
                    <tr>
                        <td>{{ $value->withdrawRequestId }}</td>
                        <td>{{ $value->walletAddress }}</td>
                        <td>{{ $value->amount }}</td>
                        <td>{{ $value->userId }}</td>
                        <td>{{ $value->addDate }}</td>
                        <td>
                            @if ($value->isApproved == 0)
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-info text-dark">Approved</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                <a class="link-icon editwithdrawbtn" data-bs-toggle="modal"
                                    data-bs-target="#withdrawModal" href="#"
                                    data-id="{{ $value->withdrawRequestId }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="" class="link-icon" id="deletewithdrawbtn"
                                    data-id="{{ $value->withdrawRequestId }}"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!--------------- Withdraw Model ---------------------->
<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Withdraw</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="withdrawdetail">
                    <!-- Hidden id -->
                    <input type="text" name="transectionId" value="" id="withdrawid" hidden>
                    <!-- Hidden id -->

                    <h5 class="text" id="withdrawname">Name: <span></span></h5>
                    <h5 class="text" id="withdrawmail">Email: <span></span></h5>
                    <h5 class="text" id="withdrawacc">Acc no: <span></span></h5>
                    <h5 class="text" id="withdrawadd">Wallet address: <span></span></h5>
                    <h5 class="text" id="withdrawdate">Date: <span></span></h5>

                    <div class="input-wrapper my-3">
                        <input type="text" id="withdrawamount" class="form-control w-100" value
                            placeholder="Enter amount">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--------------- End Withdraw Model ---------------------->


@include('footer')
<script>
    //---- 	withDraw data get ajax ------>
    $(document).on('click', '.editwithdrawbtn', function() {
        var withdrawRequestId = $(this).data('id');
        $.ajax({
            type: 'get',
            url: "dashboard/getwithdraw/" + withdrawRequestId,
            success: function(response) {
                if (response) {
                    $('#withdrawid').val(response.withdrawRequestId);
                    $('#withdrawname span').text(response.name);
                    $('#withdrawmail span').text(response.email);
                    $('#withdrawacc span').text(response.phoneNumber);
                    $('#withdrawadd span').text(response.walletAddress);
                    $('#withdrawdate span').text(response.addDate);
                    $('#withdrawamount').val(response.amount);
                    $('#withdrawModal').modal('show');
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
                    text: 'Failed to fetch withdrawal data',
                    timer: 1500
                });
            }
        });
    });

    //---- END	WithDraw data get ajax ------>

    //---- Delete WithDraw data ajax ------>

    $(document).on('click', '#deletewithdrawbtn', function(event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $(this).data('id');
        // alert(id);

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
                    url: "dashboard/withdrawdestroy/" + id,
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
                swal("Your Withdraw record is safe!");
            }
        });
    });


    //----- Withdraw Amount update -----//
    $(document).ready(function() {
        // Event listener for form submit
        $('#withdrawdetail').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // Retrieve form data
            var withdrawRequestId = $('#withdrawid').val();
            var amount = $('#withdrawamount').val();

            // Make AJAX request
            $.ajax({
                type: 'post',
                url: "dashboard/updatewithdraw/" + withdrawRequestId,
                data: {
                    amount: amount
                },
                success: function(response) {
                    if (response.success) {
                        swal({
                            icon: 'success',
                            title: " Thanks To Withdrawal Amount",
                            timer: 1500
                        }).then(function() {
                            location.reload(); // Reload the page
                        });
                        $('#withdrawModal').modal('hide');
                        // Perform any additional actions or page updates if needed
                    } else {
                        swal({
                            icon: 'error',
                            title: "Failed to withdrawal amount",
                            timer: 1500
                        });
                    }
                },
                error: function() {
                    swal({
                        icon: 'error',
                        title: "An error occurred. Please try again.",
                        timer: 1500
                    });
                }
            });
        });
    });
</script>
