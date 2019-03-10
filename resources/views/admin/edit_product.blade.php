@extends('admin_layout')

@section('admin_content')

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{URL::to('/')}}">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Forms</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Productproduct</h2>
            </div>

            <?php
            $message = Session::get('message');
            if ($message) { ?>
            <strong><p class="alert alert-success">
                    <?php
                    echo $message;
                    Session::put('message', NULL); ?>
                </p></strong>
            <?php } ?>

            <div class="box-content">
                <form class="form-horizontal" action="{{url('/update-product', $product_info->product_id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="date01">Product Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_name" value="{{ $product_info->product_name }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError3" name="category_id">Product Category</label>
                            <div class="controls">
                                <select id="selectError3" name="category_id">
                                    <option value="{{ $product_info->category_id }}">{{ $product_info->category_name }}</option>
                                    <?php
                                    $all_category = DB::table('tbl_category')
                                        ->where('publication_status', 1)
                                        ->get();

                                    foreach ($all_category as $v_category) {
                                    if($product_info->category_id !== $v_category->category_id ) {?>
                                    <option value="{{$v_category->category_id}}">{{$v_category->category_name}}</option>
                                    <?php } }?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError3" name="manufacture_id">Product Manufacture</label>
                            <div class="controls">
                                <select id="selectError3" name="manufacture_id">
                                    <option value="{{ $product_info->manufacture_id }}">{{ $product_info->manufacture_name }}</option>

                                    <?php
                                    $all_manufacture = DB::table('tbl_manufacture')
                                        ->where('publication_status', 1)
                                        ->get();
                                    foreach ($all_manufacture as $v_manufacture) {
                                        if($product_info->manufacture_id !== $v_manufacture->manufacture_id ) { ?>
                                    <option value="{{ $v_manufacture->manufacture_id }}">{{ $v_manufacture->manufacture_name }}</option>
                                    <?php } }?>
                                </select>
                            </div>
                        </div>


                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Product Short Description</label>
                            <div class="controls">
                                <textarea name="product_short_description" rows="3"
                                  value="{{ $product_info->product_short_description }}"></textarea>
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Product Long Description</label>
                            <div class="controls">
                                <textarea name="product_long_description" rows="3"
                                  value="{{ $product_info->product_long_description }}"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Product Price</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_price" value="{{ $product_info->product_price }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Product Image</label>
                            <div class="controls">
                                <input type="file" name="product_image"
                                   value="{{ $product_info->product_image }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Product Size</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_size"
                                   value="{{ $product_info->product_size }}">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Product Color</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="product_color"
                                value="{{ $product_info->product_color }}">
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

@endsection