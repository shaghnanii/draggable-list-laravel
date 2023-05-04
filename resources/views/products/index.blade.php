<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel - Draggable</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="pb-2 pt-2">Laravel Drag & Drop</h4>

            <div class="row">
                @if(count($products) > 0)
                    <div class="col-md-5 p-3 offset-md-1 shadow-lg">
                        <ul class="list-group  sortable-data-list" id="products-drag-and-drop">
                            @foreach($products as $key => $product)
                                <li class="list-group-item " product-id="{{ $product->id }}">{{ $product->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="alert alert-danger">No products found in the server. Please add some products first.</div>
                @endif
            </div>

        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#products-drag-and-drop").sortable({
            connectWith: ".sortable-data-list",
            opacity: 0.5,
        });
        $(".sortable-data-list").on("sortupdate", function (event, ui) {
            let products = [];
            $("#products-drag-and-drop li").each(function (index) {
                products[index] = $(this).attr('product-id');
            });
            $.ajax({
                method: 'PUT',
                url: "{{ route('products.update', 1) }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {products: products},
                success: function (data) {
                    console.log('success');
                }
            });

        });
    });
</script>
</body>
</html>
