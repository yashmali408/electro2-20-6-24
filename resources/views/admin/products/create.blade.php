
<x-layout title=""><!-- I will pass data to the layout compoent using prop/ properties -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 a_tbdr">
                    <h1 class="m-0">Add New Product</h1>
                </div>
                <!-- <div class="col-sm-6 a_tbdr text-right">
                    <a href="{{route('category.create')}}" class="btn btn-primary">Add New Category</a>
                </div> -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="GET" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="product_desc">Product Description</label>
                                    <textarea name="product_desc" class="form-control" id="product_desc" placeholder=""></textarea>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="unit">Unit</label>
                                            <select name="unit" id="unit" class="select2" style="width: 100%;">
                                                <option selected>KG</option>
                                                <option>Pices</option>
                                                <option>Ltr</option>
                                            </select>
                                        </div>  
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select name="brand_id" class="select2" style="width: 100%;">
                                                @foreach($brands as $brand)
                                                    <option>{{$brand->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>  
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_id" class="select2" style="width: 100%;">
                                                @foreach($categories as $category)
                                                    <option>{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mrp">MRP</label>
                                            <input id="mrp" name="mrp" type="number" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="sell_price">Sell Price</label>
                                            <input id="sell_price" name="sell_price" type="number" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="qty_available">Available Quantity</label>
                                            <input id="qty_available" name="qty_available" type="number" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Product Thumbnail (212 × 200)</label>
                                    <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Product Main Image (720 × 660)</label>
                                    <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>