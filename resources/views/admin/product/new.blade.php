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
                                                <label>Price in Kron</label>
                                                <input type="text" class="form-control" name="price" value="{{ old('price') ?? ''}}" placeholder="Please Enter The Item Price in Kron" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Count in Inventory</label>
                                                <input type="number" class="form-control" name="inventory" placeholder="Please Enter a Number" value="{{ old('inventory') ?? '0'}}" required>
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
                                                <label>Fabric Type</label>
                                                <select class="form-control mb-4" name="fabrics" required>
                                                        <option value="leather">Leather</option>
                                                        <option value="facbric">Fabric</option>
                                                        <option value="fabric-with-leather">Fabric With Leather</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Shipping Status</label>
                                                <input type="text" class="form-control" name="shipping_status" value="{{ old('shipping_status') ?? ''}}" placeholder="Please Enter Product Shipping Status">
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
                                                <input type="number" step="0.01" class="form-control" value="{{old('weight') ?? ''}}" name="weight" placeholder="Please Enter a Number in KG" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Height</label>
                                                <input type="number" class="form-control" value="{{old('height') ?? ''}}" name="height" placeholder="Please Enter a Number in CM">
                                            </div>
                                            <div class="form-group">
                                                <label>Width</label>
                                                <input type="number" class="form-control" value="{{old('width') ?? ''}}" name="width" placeholder="Please Enter a Number in CM">
                                            </div>

                                            <div class="form-group">
                                                <label>Length</label>
                                                <input type="text" class="form-control" value="{{old('length') ??''}}" name="length" placeholder="Please Enter the Length">
                                            </div>
                                            <div class="form-group">
                                                <label>Persons</label>
                                                <input type="text" class="form-control" value="{{old('persons') ?? ''}}" name="persons" placeholder="Please Enter Persons Number">
                                            </div>
                                            <div class="form-group">
                                                <label>Seat height</label>
                                                <input type="text" class="form-control" value="{{old('seat_height') ?? ''}}" name="seat_height" placeholder="Please Enter Seat Height">
                                            </div>
                                            <div class="form-group">
                                                <label>Legs</label>
                                                <input type="text" class="form-control" value="{{old('legs') ?? ''}}" name="legs" placeholder="Please Enter Legs Number">
                                            </div>
                                            <div class="form-group">
                                                <label>Right or left direction</label>
                                                <input type="text" class="form-control" value="{{old('direction') ?? ''}}" name="direction" placeholder="Please Enter Direction">
                                            </div>
                                            <div class="form-group">
                                                <label>Excl</label>
                                                <input type="text" class="form-control" value="{{old('excl') ?? ''}}" name="excl" placeholder="Please Enter Excl">
                                            </div>
                                            <div class="form-group">
                                                <label>Cover</label>
                                                <input type="text" class="form-control" value="{{old('cover') ?? ''}}" name="cover" placeholder="Please Enter Cover">
                                            </div>
                                            <div class="form-group">
                                                <label>Item number</label>
                                                <input type="text" class="form-control" value="{{old('item_number') ?? ''}}" name="item_number" placeholder="Please Enter Item Number">
                                            </div>


                                            <h6 class="c-grey-900 mT-40 mB-40">Taxes</h6>
                                            <div class="form-group">
                                                <label>Tax Rate</label>
                                                <select class="form-control" name="tax_rate" required>
                                                    <option selected value="0.25">Tax rate 1: 25%</option>
                                                    <option value="0.21">Tax rate 1: 21%</option>
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
             maxFiles: 7,
             dictDefaultMessage: "Drag Images or Click to Upload",
     });
    </script>
</body>

</html>
