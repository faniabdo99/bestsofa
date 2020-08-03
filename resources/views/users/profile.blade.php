@include('layout.header' , ['PageTitle' => 'My Account'])
<body>
    <!--================Header Menu Area =================-->
    @include('layout.navbar')
    <!--================Login Box Area =================-->
    <section class="user_profile p_120 mt-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-2">
                    <img class="user_image" src="{{$TheUser->profile_image}}" alt="{{$TheUser->name}}">
                </div>
                <div class="col-4">
                    <h1 class="user_name">{{$TheUser->name}}</h1>
                    <ul class="user_data_list">
                        <li><i class="fas fa-envelope"></i> {{$TheUser->email}}</li>
                        <li>@if($TheUser->confirmed) <span class="text-success"><i class="fas fa-check"></i> Account Active</span> @else <a id="send_activate_link" action-route="{{route('user.sendActivateLink')}}" user-id="{{$TheUser->id}}" class="main_btn" href="javascript:;">Re Send Activation Link</a>@endif</li>
                    </ul>
                </div>
                <div class="col-6">
                    <a class="edit_profile_btn" href="javascript:;" data-toggle="modal" data-target="#update-modal"><i class="fas fa-edit"></i> Update Info</a>
                    <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="update-modal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="update-modal">Update Profile</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{route('profile.update.post')}}" method="post" enctype="multipart/form-data">
                                  @csrf
                                  <label>Name: </label>
                                  <input name="name" type="text" placeholder="Enter Your Name Here" value="{{$TheUser->name}}" required>
                                  <label>Email: </label>
                                  <input name="email" type="email" placeholder="Enter Your Name Here" value="{{$TheUser->email}}" required>
                                  @if($TheUser->auth_provider == 'Signup')
                                  <label>Current Password: </label>
                                  <input name="password_current" type="password" placeholder="Enter Your Current Password">
                                  <label>Password: </label>
                                  <input name="password" type="password" placeholder="Enter The New Password">
                                  @endif
                                  <label>Profile Image: </label>
                                  <input name="image" type="file">
                                  <br><br>
                                  <input hidden name="id" value="{{$TheUser->id}}">
                                  <button type="submit" class="main_btn">Save changes</button>
                                  
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <p class="font-weight-bold">Purchases <i class="fas fa-question-circle toggle_more_info" title="lorem ipsum stuff"></i></p>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 22%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                            54€ of 500€
                        </div>
                    </div>
                    <p class="font-weight-bold">Other Action <i class="fas fa-question-circle toggle_more_info" title="lorem ipsum stuff"></i></p>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 42%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                            154€ of 500€
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 orders_list">
                    <h2 class="text-dark">Orders History (0)</h2>
                    <ul class="orders_list_element">
                        <li class="single_order_item d-flex">
                            <div class="single_order_image">
                                <img src="https://placehold.it/200x200" alt="Product Title">
                            </div>
                            <div class="single_order_data">
                                <h3>Item title here </h3>
                                <div class="d-flex">
                                    <ul class="mr-5">
                                        <li>21PCs</li>
                                        <li>245€</li>
                                    </ul>
                                    <ul>
                                        <li>Week Ago</li>
                                    </ul>
                                </div>
                                <a href="#">View Order</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--================ start footer Area  =================-->
    @include('layout.footer')
    <!--================ End footer Area  =================-->



    <!-- Optional JavaScript -->
    @include('layout.scripts')
</body>

</html>
