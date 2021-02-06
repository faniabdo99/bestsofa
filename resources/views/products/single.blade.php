@include('layout.header',['PageTitle' => $TheProduct->local_title])
<body>
    @include('layout.navbar')

    <div class="product_image_area mt-5">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_product_img">
                        @if($TheProduct->GalleryImages->count() != 0)
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                                        <img width="60" height="60" src="{{$TheProduct->main_image}}" alt="{{$TheProduct->local_title}}">
                                    </li>
                                    @foreach ($TheProduct->GalleryImages as $i=>$GalleryImage)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$i+1}}">
                                        <img width="60" height="60" src="{{$GalleryImage->image_path}}" alt="{{$TheProduct->local_title}}">
                                    </li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="w-100" src="{{$TheProduct->main_image}}" alt="{{$TheProduct->local_title}}">
                                    </div>
                                    @foreach ($TheProduct->GalleryImages as $GalleryImage)
                                    <div class="carousel-item">
                                        <img class="w-100" src="{{$GalleryImage->image_path}}" alt="{{$TheProduct->local_title}}">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <img class="w-100" src="{{$TheProduct->main_image}}" alt="{{$TheProduct->local_title}}">
                            @endif
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{$TheProduct->local_title}}</h3>
                        @if($TheProduct->HasDiscount())
                            <h2 class="product-price-before-discount d-inline">{{($TheProduct->price+$TheProduct->TaxAmount)}}</h2>
                            <h2 class="text-success ml-4 d-inline">{{($TheProduct->FinalPrice+$TheProduct->TaxAmount).getCurrency()['symbole']}}</h2>
                            @else
                            <h2>{{($TheProduct->FinalPrice+$TheProduct->TaxAmount).getCurrency()['symbole']}}</h2>
                            @endif
                            <ul class="list">
                                @if($TheProduct->status == 'Available' || $TheProduct->status == 'Sold Out' || $TheProduct->status == 'Pre-Oreder')
                                    <li>
                                        <a href="#"><span class="font-weight-bold">@lang('products.status')</span> <span class=" @if($TheProduct->status != 'Available') {{$TheProduct->status_class['text']}} @endif ">{{$TheProduct->status}}</span></a>
                                    </li>
                                @endif
                                @if($TheProduct->shipping_status)
                                <li>
                                    <a href="#">
                                        <span class="font-weight-bold">Shipping</span>
                                        <span>{{$TheProduct->shipping_status}}</span>
                                    </a>
                                </li>
                                @endif
                                @if($TheProduct->show_inventory)
                                    <li><a href="#"><span class="font-weight-bold">@lang('products.in_stock')</span> {{$TheProduct->inventory_value}}</a></li>
                                @endif
                            </ul>
                            <p>{!! $TheProduct->local_description !!}</p>
                            <div class="product_count">
                                <label for="qty">@lang('products.quantity'):</label>
                                <input type="text" name="qty" id="sst" maxlength="12" value="1" title="@lang('products.quantity'):" class="input-text qty">
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                    <i class="lnr lnr-chevron-up"></i>
                                </button>
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                    <i class="lnr lnr-chevron-down"></i>
                                </button>
                            </div>
                            <div class="card_area">
                                @if($TheProduct->inventory > 0 && $TheProduct->status == 'Available')
                                    {{-- Allow Add to Cart if The Product is In-Stock --}}
                                    <a class="main_btn add-to-cart" data-id="{{$TheProduct->id}}" href="javascript:;">@lang('products.add_cart')</a>
                                    @else
                                    @if($TheProduct->inventory < 1) <p class="text-danger">@lang('products.out_stock')</p>
                                            @else
                                            <p class="text-danger">@lang('products.not_available_sale')</p>
                                            @endif
                                            @endif
                                            @auth
                                            <a class="icon_btn like_item @if($TheProduct->LikedByUser()) bg-danger text-white @endif" product-id="{{$TheProduct->id}}" href="javascript:;">
                                            <i class="lnr lnr lnr-heart"></i>
                                            </a>
                                            @endauth
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">@lang('products.description')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">@lang('products.specification')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">@lang('products.question')</a>
                </li>
                @if($TheProduct->allow_reviews)
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">@lang('products.reviews')</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade text-dark show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    {!! $TheProduct->local_body !!}
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><h5>@lang('products.width')</h5></td>
                                    <td><h5>@if($TheProduct->width){{$TheProduct->width}}CM @else @lang('products.not_available') @endif</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>@lang('products.height')</h5></td>
                                    <td><h5>@if($TheProduct->height){{$TheProduct->height}}CM@else @lang('products.not_available') @endif</h5></td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>@lang('products.weight')</h5>
                                    </td>
                                    <td>
                                        <h5>
                                            @if($TheProduct->weight){{$TheProduct->weight}}KG
                                                @else @lang('products.not_available') @endif</h5>
                                    </td>
                                </tr>




                                @if($TheProduct->length)
                                    <tr>
                                        <td><h5>@lang('products.length')</h5></td>
                                        <td><h5>{{$TheProduct->length}}</h5></td>
                                    </tr>
                                @endif
                                @if($TheProduct->persons)
                                    <tr>
                                        <td><h5>@lang('products.persons')</h5></td>
                                        <td><h5>{{$TheProduct->persons}}</h5></td>
                                    </tr>
                                @endif
                                @if($TheProduct->seat_height)
                                    <tr>
                                        <td><h5>@lang('products.seat_height')</h5></td>
                                        <td><h5>{{$TheProduct->seat_height}}</h5></td>
                                    </tr>
                                @endif
                                @if($TheProduct->legs)
                                    <tr>
                                        <td><h5>@lang('products.legs')</h5></td>
                                        <td><h5>{{$TheProduct->legs}}</h5></td>
                                    </tr>
                                @endif
                                @if($TheProduct->direction)
                                    <tr>
                                        <td><h5>@lang('products.direction')</h5></td>
                                        <td><h5>{{$TheProduct->direction}}</h5></td>
                                    </tr>
                                @endif
                                @if($TheProduct->excl)
                                    <tr>
                                        <td><h5>@lang('products.excl')</h5></td>
                                        <td><h5>{{$TheProduct->excl}}</h5></td>
                                    </tr>
                                @endif
                                @if($TheProduct->cover)
                                    <tr>
                                        <td><h5>@lang('products.cover')</h5></td>
                                        <td><h5>{{$TheProduct->cover}}</h5></td>
                                    </tr>
                                @endif
                                @if($TheProduct->item_number)
                                    <tr>
                                        <td><h5>@lang('products.item_number')</h5></td>
                                        <td><h5>{{$TheProduct->item_number}}</h5></td>
                                    </tr>
                                @endif



                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="review_box">
                                <h4>@lang('products.question_us')</h4>
                                <form class="row contact_form" style="max-width:100%;">
                                    <input hidden name="product_id" value="{{$TheProduct->id}}">
                                    <input hidden name="product_slug" value="{{$TheProduct->slug}}">
                                    <input hidden name="site_locale" value="{{app()->getLocale()}}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="@lang('products.name')" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="@lang('products.email')" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="number" name="phone_number" placeholder="@lang('products.phone')" required>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="form-control" name="country" required>
                                                <option value="">@lang('products.country_choose')</option>
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
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="@lang('products.message')" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button id="submit-ask-question-about-product-form" action-route="{{route('product.askQuestion')}}" type="submit" class="btn submit_btn">@lang('products.send')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if($TheProduct->allow_reviews)

                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row total_rate">
                                    <div class="col-12 mb-5">
                                        <div class="box_total">
                                            <h5>@lang('products.overall')</h5>
                                            <h4>{{$TheProduct->Reviews()->avg('rate')}}</h4>
                                            <h6>({{$TheProduct->Reviews()->count()}} @lang('products.reviews'))</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="review_list">
                                  @foreach ($TheProduct->Reviews() as $Review)
                                    <div class="review_item bg-light p-3 mb-5">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4>{{$Review->User->name}}</h4>
                                                @for ($i = 0; $i < $Review->rate; $i++)
                                                  <i class="fa fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-dark">{{$Review->review}}</p>
                                    </div>
                                  @endforeach
                                </div>
                                @auth
                                  @if(auth()->user()->Bought($TheProduct->id))
                                      <div class="review_box">
                                    <h4>@lang('products.add_review')</h4>
                                    <p>@lang('products.rating'):</p>

                                    <form class="row contact_form" action="{{route('review.post')}}" method="post">
                                        @csrf
                                        <input hidden name="product_id" value="{{$TheProduct->id}}">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                              <select required class="form-control" name="rate">
                                                <option value="">@lang('products.rate_choose')</option>
                                                <option value="1">1 @lang('products.star')</option>
                                                <option value="2">2 @lang('products.star')s</option>
                                                <option value="3">3 @lang('products.star')s</option>
                                                <option value="4">4 @lang('products.star')s</option>
                                                <option value="5">5 @lang('products.star')s</option>
                                              </select>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="review" rows="1" placeholder="@lang('products.review_placeholder')"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button type="submit" value="submit" class="btn submit_btn">@lang('products.submit')</button>
                                        </div>
                                    </form>
                                </div>
                                    @else
                                      <p>@lang('products.buy_to_review')</p>
                                    @endif
                                @endauth
                                @guest
                                <p>@lang('products.login_to_review')</p>
                                @endguest
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('layout.footer')

    @include('layout.scripts')
</body>

</html>
