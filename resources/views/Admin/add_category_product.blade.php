@extends('Admin.admin_header')
@section('dashboard')


<!-- page start-->
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Danh Mục Sản Phẩm
            </header>
            <div class="panel-body">
                <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="text-alert">'.$message.'</span>' ;
                        Session::put('message'.null);
                    }
	            ?>
                <div class="position-center">
                    <form role="form" action="{{ URL::to('/save_category_product') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1"
                                placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô Tả Danh Mục</label>
                            <textarea style="resize:none" rows="8" class="form-control" id="exampleInputPassword1"
                                name="category_product_desc" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển Thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện Thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm Danh Mục</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection