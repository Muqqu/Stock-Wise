@include('header')

<div class="container-fluid">
    <div class="main-title d-flex align-items-center justify-content-between">
        <h1>Company Status</h1>

        <a href="#" data-bs-target="#addcompanymodal" id="addcompanyModalbtn" data-bs-toggle="modal"
            class="btn btn-primary">Add Company</a>
    </div>

    <div class="card table-responsive">
        <table class="table table-striped table-hover" id="companyTable" style="width:100%;">
            <thead>
                <tr>
                    <th scope="col">Company Id </th>
                    <th scope="col">Company Info</th>
                    <!-- <th scope="col">Company Name</th> -->
                    <th scope="col">Profit</th>
                    <th scope="col">Income</th>
                    <th scope="col">Profit Margin</th>
                    <th scope="col">Short Title</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($company as $value)
                    <tr>
                        <td>{{ $value->companyId }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img class="logo" src="{{ $value->company_logo }}" alt="">
                                <div>
                                    <h3 class="card-title">{{ $value->company_name }}</h3>
                                    <p class="mb-0">wik</p>
                                </div>
                            </div>
                        </td>
                        <!-- <td>{{ $value->company_name }}</td> -->
                        <td>{{ $value->profit }}</td>
                        <td>{{ $value->income }}</td>
                        <td>{{ $value->profit_margin }}</td>
                        <td>{{ $value->short_title }}</td>
                        <td>
                            <a href="" class="link-icon"><i class="fas fa-trash" id="deletecompanybtn"
                                    data-id="{{ $value->companyId }}"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<!--------------- ADD Company Model ---------------------->

<div class="modal fade" id="addcompanymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Company</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="addcompanyform">
                    <div class="input-wrapper mb-3">
                        <input type="url" class="form-control w-100" id="logourl" name="logourl"
                            placeholder="Logo URL">
                    </div>
                    <div class="input-wrapper mb-3">
                        <input type="text" class="form-control w-100" id="companyname" name="companyname"
                            placeholder="Company Name">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-wrapper mb-3">
                                <input type="text" class="form-control w-100" id="shortname" name="shortname"
                                    placeholder="Short Name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="input-wrapper mb-3">
                                <input type="text" class="form-control w-100" id="shareprofit" name="shareprofit"
                                    placeholder="Share Profit">
                            </div>
                        </div>
                        <div class="input-wrapper mb-3">
                            <input type="text" class="form-control w-100" id="income" name="income"
                                placeholder="Income">
                        </div>
                    </div>
                    <button type="button" id="addcompanybtn" class="btn btn-primary w-100">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--------------- End ADD Company Model ---------------------->
@include('footer')

<script>
    // <--- Company Insert Ajax ---->
    $(document).ready(function() {
        $('#addcompanyModalbtn').on('click', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#addcompanymodal').modal('show');
            $('#exampleModalLabel').text('Add New Company');
            $('#addcompanyform').trigger('reset');
        });

        $('#addcompanybtn').click(function() {
            var logourl = $('#logourl').val();
            var companyname = $('#companyname').val();
            var shortname = $('#shortname').val();
            var shareprofit = $('#shareprofit').val();
            var income = $('#income').val();

            if (logourl == "") {
                swal({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Enter Logo URL',
                    timer: 1500
                });
            } else if (companyname == "") {
                swal({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Enter Company Name',
                    timer: 1500
                });
            } else if (shortname == "") {
                swal({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Enter Short Name',
                    timer: 1500
                });
            } else if (shareprofit == "") {
                swal({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Enter Share Profit',
                    timer: 1500
                });
            } else if (income == "") {
                swal({
                    icon: 'error',
                    title: 'Error',
                    text: 'Please Enter Income',
                    timer: 1500
                });
            } else {
                var form = $('#addcompanyform').serialize();
                $.ajax({
                    type: 'post',
                    url: '{{ route('addcomapny.store') }}',
                    data: form,
                    success: function(response) {
                        if (response) {
                            swal({
                                icon: 'success',
                                title: 'Success',
                                text: 'Company is Added',
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            swal({
                                icon: 'error',
                                title: 'Error',
                                timer: 1500
                            });
                        }
                    }
                });
            }
        });
    });
    //--- END Company Insert Ajax ---->

    //----  Company data Delete ajax ------>

    $(document).on('click', '#deletecompanybtn', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var companyId = $(this).data('id');
        //alert(companyId);

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
                    url: "/dashboard/deletecompany/" + companyId,
                    data: {
                        companyId: companyId
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
                swal("Your record is safe!");
            }
        });
    });
</script>
