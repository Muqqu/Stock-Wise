@include('header')
<div class="container-fluid">

    <div class="main-title d-flex align-items-center justify-content-between">
        <h1>Buy Stocks Status</h1>
        <!-- <a href="#" data-bs-target="#addStockModal" data-bs-toggle="modal"
            class="btn btn-primary">Add Stock</a> -->
    </div>
    <div class="card table-responsive">
        <table class="table table-striped table-hover" id="tableBuyStock" style="width:100%;">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">buy Stock Id</th>
                    <th scope="col">user Id</th>
                    <th scope="col">Company Id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Profit</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buystock as $value)
                    <tr>
                        <td>{{ $value->buyStockId }}</td>
                        <td>{{ $value->userId }}</td>
                        <td>{{ $value->companyId }}</td>
                        <td>{{ $value->amount }}</td>
                        <td>{{ $value->profit }}</td>
                        <td>{{ $value->stock_profit }}</td>
                        <td>
                            <a href="" class="link-icon" id="deletebuystockbtn"
                                data-id="{{ $value->buyStockId }}"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('footer')
<script>
    //----  Buy Stock data Delete ajax ------>

    $(document).on('click', '#deletebuystockbtn', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var buyStockId = $(this).data('id');
        //alert(buyStockId);

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
                    url: "/dashboard/buystock/" + buyStockId,
                    data: {
                        buyStockId: buyStockId
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
                swal("Your buy stock is safe!");
            }
        });
    });
</script>
