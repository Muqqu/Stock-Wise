@include('header')

                <div class="container-fluid">
                    <div class="tab-content mt-lg-4 mt-3" id="myTabContent">
                        <div class="tab-pane fade show active" id="dashboard-tab-pane" role="tabpanel"
                            aria-labelledby="dashboard-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card card-s1 dash-primary-card">
                                        <div class="card-body">
                                            <div>
                                                <h3 class="card-title">{{ $totalsum }}$</h3>
                                                <h3 class="title">Total Amount</h3>
                                                <p class="text mb-0">10 Apr 2023</p>
                                            </div>
                                            <a class="side-link" href="">View Details</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card card-s1 dash-secondary-card">
                                        <div class="card-body">
                                            <div>
                                                <h3 class="card-title">{{ $totalsumwithdraw }}$</h3>
                                                <h3 class="title">Withdraw Amount</h3>
                                                <p class="text mb-0">10 Apr 2023</p>
                                            </div>
                                            <a class="side-link" href="">View Details</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card card-s1 dash-tritary-card">
                                        <div class="card-body">
                                            <div>
                                                <h3 class="card-title">{{ $totalbalanceprofit }}$</h3>
                                                <h3 class="title">Total Profit</h3>
                                                <p class="text mb-0">10 Apr 2023</p>
                                            </div>
                                            <a class="side-link" href="">View Details</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-lg-4">
                                <div class="col-lg-7">
                                    <div class="main-title mt-3">
                                        <h1>Transactions</h1>
                                    </div>
                                    <ul class="transaction-list pe-lg-5 mb-3 mb-lg-0">
                                    @foreach ($data as $value)
                                        <li class="list-item">
                                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                <img src="https://stock-wise.online/ci_api/{{ $value->screenshotImage }}"
                                                    alt="" class="user-img">
                                                <div>
                                                    <h3 class="title">{{ $value->userid }}</h3>
                                                    <h3 class="text">{{ $value->userid }}</h3>
                                                </div>
                                            </div>
                                            <h3 class="text">{{ $value->amount }}</h3>
                                            <div>
                                                <h3 class="text">{{ $value->addDate }}</h3>
                                                <h3 class="text">10:30pm</h3>
                                            </div>
                                            <h3 class="title">20.08$</h3>
                                            <div class="dropdown">
                                                <button class="btn p-1" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        @endforeach
                                        <!-- <li class="list-item">
                                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                <img src="https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                                                     alt="" class="user-img">
                                                <div>
                                                    <h3 class="title">Sabrena</h3>
                                                    <h3 class="text">abc@gmail.com</h3>
                                                </div>
                                            </div>
                                            <h3 class="text">lsafjasdf8asdf9</h3>
                                            <div>
                                                <h3 class="text">Apr 06, 2023</h3>
                                                <h3 class="text">10:30pm</h3>
                                            </div>
                                            <h3 class="title">20.08$</h3>
                                            <div class="dropdown">
                                                <button class="btn p-1" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="list-item">
                                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                                                    alt="" class="user-img">
                                                <div>
                                                    <h3 class="title">Jack</h3>
                                                    <h3 class="text">abc@gmail.com</h3>
                                                </div>
                                            </div>
                                            <h3 class="text">lsafjasdf8asdf9</h3>
                                            <div>
                                                <h3 class="text">Apr 06, 2023</h3>
                                                <h3 class="text">10:30pm</h3>
                                            </div>
                                            <h3 class="title">20.08$</h3>
                                            <div class="dropdown">
                                                <button class="btn p-1" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="list-item">
                                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                <img src="https://images.unsplash.com/photo-1552374196-c4e7ffc6e126?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                                                     alt="" class="user-img">
                                                <div>
                                                    <h3 class="title">Paul</h3>
                                                    <h3 class="text">abc@gmail.com</h3>
                                                </div>
                                            </div>
                                            <h3 class="text">lsafjasdf8asdf9</h3>
                                            <div>
                                                <h3 class="text">Apr 06, 2023</h3>
                                                <h3 class="text">10:30pm</h3>
                                            </div>
                                            <h3 class="title">20.08$</h3>
                                            <div class="dropdown">
                                                <button class="btn p-1" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="list-item">
                                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                <img src="https://images.unsplash.com/photo-1567532939604-b6b5b0db2604?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                                                     alt="" class="user-img">
                                                <div>
                                                    <h3 class="title">Sabrena</h3>
                                                    <h3 class="text">abc@gmail.com</h3>
                                                </div>
                                            </div>
                                            <h3 class="text">lsafjasdf8asdf9</h3>
                                            <div>
                                                <h3 class="text">Apr 06, 2023</h3>
                                                <h3 class="text">10:30pm</h3>
                                            </div>
                                            <h3 class="title">20.08$</h3>
                                            <div class="dropdown">
                                                <button class="btn p-1" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="list-item">
                                            <div class="d-flex align-items-center gap-2 gap-lg-3">
                                                <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80"
                                                     alt="" class="user-img">
                                                <div>
                                                    <h3 class="title">Jack</h3>
                                                    <h3 class="text">abc@gmail.com</h3>
                                                </div>
                                            </div>
                                            <h3 class="text">lsafjasdf8asdf9</h3>
                                            <div>
                                                <h3 class="text">Apr 06, 2023</h3>
                                                <h3 class="text">10:30pm</h3>
                                            </div>
                                            <h3 class="title">20.08$</h3>
                                            <div class="dropdown">
                                                <button class="btn p-1" type="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                                </ul>
                                            </div>
                                        </li> -->
                                    </ul>
                                </div>
                                <div class="col-lg-5">
                                    <div class="main-title mt-3">
                                        <h1>Total Amount Details</h1>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <canvas id="totalAmount"></canvas>
                                        </div>
                                    </div>
                                    <div class="main-title mt-3">
                                        <h1>Total Withdraw Amount</h1>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <canvas id="withdraw"></canvas>
                                        </div>
                                    </div>
                                    <div class="main-title mt-3">
                                        <h1>Total Profit</h1>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <canvas id="profit"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                            <!--------------- End Transaction Details Model ---------------------->
    <!-- <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Transaction Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <form action="" id="transactiondetail">

                     !-- Hidden id -
                     <input type="text" name="	transectionId" value="" id="eid" hidden>
                            !-- Hidden id --

                        <div class="col-lg-8">
                            <h5 class="text" name="userid" id="userid">Name: <span>John</span></h5>
                            <h5 class="text" name="transectionNo" id="transectionNo">Email: <span>abc@gmail.com</span></h5>
                            <-- <h5 class="text" id="">Transaction ID: <span>wjetevkatpia</span></h5>
                            <h5 class="text" id="">Wallet add: <span>wjetevkatpia</span></h5> --
                            <h5 class="text" name="" id="addDate">Date: <span>Oct 04, 2023 10:30pm</span></h5>
                            <h1 class="amount" name="amount" id="amount">20.00$</h1>

                        </div>
                        <div class="col-lg-4">
                            <a href="https://images.unsplash.com/photo-1533228100845-08145b01de14?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=738&q=80"
                                class="img-wrapper mb-3" data-image-lightbox target="_blank">
                                <img class="img-fluid"
                                    src="https://images.unsplash.com/photo-1533228100845-08145b01de14?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=738&q=80"
                                   alt="">
                            </a>
                        </div>
                    </div>

                        <div class="input-wrapper mb-3">
                            <input type="text" class="form-control w-100" id="amount" name="amount" placeholder="Enter amount">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</div>              
@include('footer');

