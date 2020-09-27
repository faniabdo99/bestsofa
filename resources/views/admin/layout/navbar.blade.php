<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="fas fa-bars"></i></a></li>
        </ul>
        <ul class="nav-right">
            <li class="notifications dropdown"><span class="counter bgc-red"></span> <a href="" class="dropdown-toggle no-after" data-toggle="dropdown"><i class="fas fa-bell"></i></a>
                <ul class="dropdown-menu">
                    <li class="pX-20 pY-15 bdB"><i class="fas fa-bell"></i> <span
                            class="fsz-sm fw-600 c-grey-900">Notifications</span></li>
                    <li>
                        <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                            {{-- <li><a href="" class="peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100">
                                    <div class="peer mR-15"><img class="w-3r bdrs-50p"
                                            src="https://randomuser.me/api/portraits/men/1.jpg" alt=""></div>
                                    <div class="peer peer-greed"><span><span class="fw-500">John Doe</span> <span
                                                class="c-grey-600">liked your <span
                                                    class="text-dark">post</span></span></span>
                                        <p class="m-0"><small class="fsz-xs">5 mins ago</small></p>
                                    </div>
                                </a></li> --}}
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown"><a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1"
                    data-toggle="dropdown">
                    <div class="peer mR-10"><img class="w-2r bdrs-50p" src="{{auth()->user()->profile_image}}"
                            alt="{{auth()->user()->name}}"></div>
                    <div class="peer"><span class="fsz-sm c-grey-900">{{auth()->user()->name}}</span></div>
                </a>
                <ul class="dropdown-menu fsz-sm">
                    <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-settings mR-10"></i>
                            <span>Setting</span></a></li>
                    <li><a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="ti-user mR-10"></i>
                            <span>Profile</span></a></li>
                    <li><a href="email.html" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                class="ti-email mR-10"></i> <span>Messages</span></a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{route('logout')}}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i class="fas fa-power-off mR-10"></i>
                            <span>Logout</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@if(session()->has('success'))
<div class="noto noto-success">
    {{session('success')}}
</div>
@endif
@if ($errors->any())
<div class="noto noto-danger">
    @foreach ($errors->all() as $error)
    {!! $error . '<br>' !!}
    @endforeach
</div>
@endif
