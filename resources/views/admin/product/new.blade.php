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
                                <h2>Add New Product</h2>
                                <div class="bgc-white p-20 bd">
                                    <h6 class="c-grey-900">Main Data</h6>
                                    <div class="mT-30">
                                        <form action="{{route('admin.products.postNew')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input hidden name="id" value={{$NextProductId}}>
                                            <div class="form-group">
                                                <label>Fallback Title *</label>
                                                <input type="text" class="form-control" name="title" value="{{old('title') ?? ''}}" placeholder="Enter Title Here">
                                            </div>
                                            <div class="form-group">
                                                <label>Fallback Slug *</label>
                                                <input type="text" class="form-control" name="slug" value="{{old('slug') ?? ''}}" placeholder="Enter Slug Here">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Main Image</label>
                                                <input type="file" class="form-control" name="image">
                                            </div>
                                            <div class="form-group">
                                                <label>Fallback Description *</label>
                                                <textarea class="form-control" name="description" rows="6" placeholder="Enter Description Here">{{old('description') ?? ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Fallback Body *</label>
                                                <textarea class="form-control editor" name="body" rows="6" placeholder="Enter Description Here">{{old('body') ?? ''}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Main Category *</label>
                                                <select class="form-control" name="category_id" required>
                                                    @forelse ($AllCategories as $Single)
                                                    <option value="{{$Single->id}}">{{$Single->title}}</option>
                                                    @empty
                                                    <option>Please Add Categories to The System</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Price in EUR</label>
                                                <input type="text" class="form-control" name="price" value="{{ old('price') ?? ''}}" placeholder="Please Enter The Item Price in EUR" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Count in Inventory</label>
                                                <input type="number" class="form-control" name="inventory" placeholder="Please Enter a Number" value="{{ old('inventory') ?? '0'}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Fake Inventory</label>
                                                <input type="number" class="form-control" name="fake_inventory" placeholder="Please Enter a Number" value="{{ old('fake_inventory') ?? '0'}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Minimum Order</label>
                                                <input type="number" class="form-control" name="min_order" placeholder="Please Enter a Number" value="{{ old('min_order') ?? '0'}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status" required>
                                                        <option selected value="Available">Available</option>
                                                        <option value="Pre-order">Pre-order</option>
                                                        <option value="Sold Out">Sold out</option>
                                                        <option value="Invisible">Invisible</option>
                                                        <option value="Customers only">Only visible for logged in customers</option>
                                                        <option value="0">Do not display product status</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <select class="form-control" name="discount_id">
                                                        <option selected value="">No Discount</option>
                                                        @forelse($DiscountsList as $Discount)
                                                          <option value="{{$Discount->id}}">{{$Discount->title}} , {{$Discount->amount}} {{$Discount->type}}</option>
                                                        @empty
                                                        @endforelse
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>For Season</label>
                                                <select class="form-control mb-4" name="season" required>
                                                        <option value="winter">Winter</option>
                                                        <option value="summer">Summer</option>
                                                        <option value="fall">Fall</option>
                                                        <option value="spring">Spring</option>
                                                        <option value="all">All</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>For Gender</label>
                                                <select class="form-control mb-4" name="gender" required>
                                                        <option value="men">Men</option>
                                                        <option value="women">Women</option>
                                                        <option value="children">Children</option>
                                                        <option value="adults">Adults</option>
                                                        <option value="young">Young</option>
                                                        <option value="all">All</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Product Gallery</label>
                                                <div id="drop-zone" class="dropzone"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" name="show_inventory" id="show_inventory"> <label for="show_inventory">Show Inventory Count ?</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" name="is_promoted" id="is_promoted"> <label for="is_promoted">Promote on Homepage ?</label>
                                            </div>
                                            <div class="form-group">
                                                 <input type="checkbox" name="allow_reviews" id="allow_reviews" checked> <label for="allow_reviews">Allow Reviews ?</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" name="allow_reservations" id="allow_reservations"> <label for="allow_reservations">Allow Reservations ?</label>
                                            </div>
                                            <h6 class="c-grey-900 mT-40 mB-40">Advanced Data</h6>
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <input type="number" step="0.1" class="form-control" value="{{old('weight') ?? ''}}" name="weight" placeholder="Please Enter a Number in KG" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Height</label>
                                                <input type="number" class="form-control" value="{{old('height') ?? ''}}" name="height" placeholder="Please Enter a Number in CM">
                                            </div>
                                            <div class="form-group">
                                                <label>Width</label>
                                                <input type="number" class="form-control" value="{{old('width') ?? ''}}" name="width" placeholder="Please Enter a Number in CM">
                                            </div>
                                            <h6 class="c-grey-900 mT-40 mB-40">Taxes</h6>
                                            <div class="form-group">
                                                <label>Tax Rate</label>
                                                <select class="form-control" name="tax_rate" required>
                                                    <option selected value="0.21">Tax rate 1: 21%</option>
                                                    <option value="0.12">Tax rate 2: 12%</option>
                                                    <option value="0.06">Tax rate 3: 6%</option>
                                                    <option value="1">Tax rate 4: 0%</option>
                                                </select>
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
            SlugValue = $(this).val().replace(/\s+/g, '-').replace(/[^a-zA-Z0-9 ]/g, "-").toLowerCase();
            //Assign the value to the input
            $('input[name="slug"]').val(SlugValue);
        });
        //Dropzone For Images
        var myDropzone = new Dropzone("div#drop-zone", {
             url: "{{route('admin.product.uploadGalleryImages')}}",
             paramName: "image",
             params: {'product_id':$('input[name="id"]').val()},
             acceptedFiles: 'image/*',
             maxFiles: 5,
             dictDefaultMessage: "Drag Images or Click to Upload",
     });
    </script>
</body>

</html>
