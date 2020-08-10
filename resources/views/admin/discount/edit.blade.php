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
                                <h2>Edit Discount <b>{{$TheDiscount->title}}</b></h2>
                                <div class="bgc-white p-20 bd">
                                    <div class="mT-30">
                                        <form action="{{route('admin.discount.postEdit' , $TheDiscount->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title" value="{{old('title') ?? $TheDiscount->title}}" placeholder="Enter Title Here" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="type" class="form-control" required>
                                                    <option value="{{$TheDiscount->type}}">{{$TheDiscount->type}}</option>
                                                    <option value="percent">Percent</option>
                                                    <option value="fixed">Fixed</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="number" class="form-control" name="amount"
                                                    value="{{old('amount') ?? $TheDiscount->amount}}"
                                                    placeholder="Enter a Number Here ..." required>
                                            </div>
                                            <div class="form-group">
                                                <label>Valid Until</label>
                                                <input type="date" class="form-control" name="valid_until"
                                                    value="{{old('valid_until') ?? $TheDiscount->valid_until->format('Y-m-d')}}" required>
                                            </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script>
        //Auto Create Clean Slug...
        var SlugValue;
        $('input[name="title"]').keyup(function () {
            SlugValue = $(this).val().replace(/\s+/g, '-').replace(/[^a-zA-Z ]/g, "-").toLowerCase();
            //Assign the value to the input
            $('input[name="slug"]').val(SlugValue);
        });

    </script>
</body>

</html>
