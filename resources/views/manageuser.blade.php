@include('header')
<!------------------ MANAGE USER ------------------->
<div class="container-fluid">
    <div class="main-title">
        <h1>Manage Users</h1>
    </div>
    <div class="card table-responsive">
        <table class="table table-striped table-hover" id="tableUsers" style="width:100%;">
            <thead>
                <tr>
                    <th scope="col">User Id</th>
                    <th scope="col">userTypeId</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <!-- <th scope="col">Phone Number</th>
                                            <th scope="col">WhatsApp Number</th> -->
                    <th scope="col">Status</th>
                    <!-- <th scope="col">Status Types</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($manageuser as $value)
                    <tr>
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
                        </td>
                        <td>{{ $value->userId }} </td>
                        <td>{{ $value->userTypeId }} </td>
                        <td>{{ $value->email }} </td>
                        <td>{{ $value->name }} </td>
                        <!-- <td>{{ $value->phoneNumber }} </td>
                                            <td>{{ $value->whatsAppNumber }} </td> -->
                        <td>Active</td>
                        <!-- <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Active</option>
                                                        <option value="1">Temprory Block</option>
                                                        <option value="2">Block 1 Month</option>
                                                        <option value="3">Permenent Block</option>
                                                    </select>
                                                </div>
                                            </td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!------------------END MANAGE USER ------------------->
@include('footer')
