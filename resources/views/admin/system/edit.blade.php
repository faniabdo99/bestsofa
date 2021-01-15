@include('admin.layout.header')

<body class="app">

    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                    <div class="bgc-white p-20 bd">
                                        <h6 class="c-grey-900">Edit <b>{{$SystemSettings->title}}</b></h6>
                                        <div class="mT-30">
                                            <form action="{{route('admin.system.postEdit' , $SystemSettings->id)}}" method="post">
                                            @csrf
                                                <div class="form-group">
                                                    <label>Value</label>
                                                    <input type="text" class="form-control" name="value" value="{{$SystemSettings->value}}" placeholder="Value" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('admin.layout.scripts')
</body>
</html>
