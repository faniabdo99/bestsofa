@include('layout.header' , ['PageTitle' => __('titles.profile')])
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
                        @if($TheUser->company_name)<li><i class="fas fa-home"></i> {{$TheUser->company_name}}</li>@endif
                        @if(!$TheUser->AddressCompleted())<li><span class="text-warning"><i class="fas fa-home"></i> @lang('users.add_shipping')</span></li>@endif
                        <li>@if($TheUser->confirmed) <span class="text-success">@else <a id="send_activate_link" action-route="{{route('user.sendActivateLink')}}" user-id="{{$TheUser->id}}" class="main_btn" href="javascript:;">@lang('users.resend_activation')</a>@endif</li>
                    </ul>
                </div>
                <div class="col-6">
                    <a class="edit_profile_btn" href="javascript:;" data-toggle="modal" data-target="#update-modal"><i class="fas fa-edit"></i> @lang('users.update_info')</a>
                    <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="update-modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="update-modal">@lang('users.update_profile')</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="{{route('profile.update.post')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <h4>@lang('users.main_info')</h4>
                                        <label>@lang('users.first_name'): </label>
                                        <input name="first_name" type="text" placeholder="@lang('users.first_name_ph')" value="{{$TheUser->first_name}}" required>
                                        <label>@lang('users.last_name'): </label>
                                        <input name="last_name" type="text" placeholder="@lang('users.last_name_ph')" value="{{$TheUser->last_name}}" required>
                                        <label>@lang('users.company_name'): </label>
                                        <input name="company_name" type="text" placeholder="@lang('users.company_name_ph')" value="{{$TheUser->company_name}}">
                                        <label>@lang('users.email'): </label>
                                        <input name="email" type="email" placeholder="@lang('users.email_ph')" value="{{$TheUser->email}}" required>
                                        @if($TheUser->auth_provider == 'Signup')
                                        <label>@lang('users.current_pass'): </label>
                                        <input name="password_current" type="password" placeholder="@lang('users.current_pass_ph')">
                                        <label>@lang('users.password'): </label>
                                        <input name="password" type="password" placeholder="@lang('users.new_pass_ph')">
                                        @endif
                                        <label>@lang('users.profile_img'): </label>
                                        <input name="image" type="file">
                                        <input hidden name="id" value="{{$TheUser->id}}">
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <h4>@lang('users.shipping_info')</h4>
                                        <label>@lang('users.phone'): </label>
                                        <input name="phone_number" type="text" placeholder="@lang('users.phone_ph')" value="{{$TheUser->phone_number}}" required>
                                        <label>@lang('users.country'): </label>
                                        <select name="country" required>
                                            @if($TheUser->country)
                                            <option value="{{$TheUser->country}}">{{$TheUser->country}}</option>
                                            @else
                                            <option value="">@lang('users.country_choose')</option>
                                            @endif
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Åland Islands">Åland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                        <label>@lang('users.city'): </label>
                                        <input name="city" type="text" placeholder="@lang('users.city_ph')" value="{{$TheUser->city}}" required>
                                        <label>@lang('users.address'): </label>
                                        <input name="street_address" type="text" placeholder="@lang('users.address_ph')" value="{{$TheUser->street_address}}" required>
                                        <label>@lang('users.z_code'): </label>
                                        <input name="zip_code" type="text" placeholder="@lang('users.z_code_ph')" value="{{$TheUser->zip_code}}" required>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <h4>@lang('users.pay_info')</h4>
                                        <label>@lang('users.vat_num'): </label>
                                        <input name="vat_number" type="text" placeholder="@lang('users.vat_num_ph')" value="{{$TheUser->vat_number}}">
                                    </div>
                                </div>
                                  <button type="submit" class="mt-5 main_btn">@lang('users.save')</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    {{-- <p class="font-weight-bold">Purchases <i class="fas fa-question-circle toggle_more_info" title="lorem ipsum stuff"></i></p>
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
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <a href="{{route('myOrders')}}">
                        <div class="profile_state_card">
                            <h3 class="card_title"><i class="fas fa-shopping-basket"></i> @lang('users.my_orders') ({{$UserOrders->count()}})</h3>
                            <p class="card_description">@lang('users.view_orders')</p>
                        </div>
                    </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{route('wishlist')}}">
                            <div class="profile_state_card">
                                <h3 class="card_title"><i class="fas fa-heart"></i> @lang('users.wish') ({{$TheUser->LikedProducts()->count()}})</h3>
                                <p class="card_description">
                                    @if($TheUser->LikedProducts()->count() == 0)
                                    @lang('users.no_wish')
                                    @else
                                    @lang('users.view_wish')
                                    @endif
                                </p>
                            </div>
                        </a>
                    </div>
                {{-- <div class="col-lg-6 orders_list">
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
                <div class="col-lg-6 orders_list">
                    <h2 class="text-dark">Wish List (0)</h2>
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
                </div> --}}
            </div>
        </div>
    </section>
    <!--================ start footer Area  =================-->
    @include('layout.footer')
    <!--================ End footer Area  =================-->
    @include('layout.scripts')
</body>

</html>
