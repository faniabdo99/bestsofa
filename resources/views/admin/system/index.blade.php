@include('admin.layout.header')

<body class="app">
    <div>
        @include('admin.layout.sidebar')
        <div class="page-container">
            @include('admin.layout.navbar')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="container-fluid">
                        <h4 class="c-grey-900 mT-10 mB-30">System Settings</h4>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Value</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($SystemSettings as $Single)
                                            <tr>
                                                <td>{{$Single->title}}</td>
                                                <td>{{$Single->value}}</td>
                                                <td><a href="{{route('admin.system.getEdit' , $Single->id)}}" class="btn btn-primary">Edit</a></td>
                                            </tr>
                                            @empty
                                            No Data in The System
                                            @endforelse
                                        </tbody>
                                    </table>
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
