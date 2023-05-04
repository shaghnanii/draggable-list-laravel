<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel - Draggable</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-sortable-helper {
            background-color: gray !important;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="alert alert-success pb-3 mt-4">Laravel Drag & Drop - using icon</h4>

            <div class="row">
                @if(count($products) > 0)
                    <div class="col-12 p-3 shadow-lg">
                        <ul class="list-group  sortable-data-icon" id="products-drag-and-drop-icon">
                            @foreach($products as $key => $product)
                                <li class="list-group-item ">
                                    <div class="d-flex justify-content-between drag-me-icon">
                                        <span>{{ $product->title }}</span>
                                        <span class="fa fa-bars p-2 drag-icon" product-id="{{ $product->id }}"></span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="alert alert-danger">No products found in the server. Please add some products first.</div>
                @endif
            </div>

            <hr>
            <h4 class="alert alert-success pb-3 mt-4">Laravel Drag & Drop - on whole list</h4>
            <div class="row mb-5">
                @if(count($products) > 0)
                    <div class="col-12 p-3 shadow-lg">
                        <ul class="list-group  sortable-data-list" id="products-drag-and-drop-list">
                            @foreach($products as $key => $product)
                                <li class="list-group-item drag-list" product-id="{{ $product->id }}">
                                    <div class="d-flex justify-content-between">
                                        <span>{{ $product->title }}</span>
                                        <span class="fa fa-bars p-2"></span>
                                    </div>
                                </li>
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
<script src="https://kit.fontawesome.com/dc8b83c874.js" crossorigin="anonymous"></script>
<script>
    $(function () {
        // logic for icon drag
        $("#products-drag-and-drop-icon").sortable({
            connectWith: ".sortable-data-icon",
            opacity: 0.5,
            handle: ".drag-icon"
        });
        $(".sortable-data-icon").on("sortupdate", function (event, ui) {
            let products = [];
            $(".drag-icon").each(function (index) {
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
                    console.log('Dragged and updated successfully.');
                }
            });
        });


        // whole list drag logic
        $("#products-drag-and-drop-list").sortable({
            connectWith: ".sortable-data-list",
            opacity: 0.5,
        });

        $(".sortable-data-list").on("sortupdate", function (event, ui) {
            let productLists = [];
            $(".drag-list").each(function (index) {
                productLists[index] = $(this).attr('product-id');
            });
            $.ajax({
                method: 'PUT',
                url: "{{ route('products.update', 1) }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {products: productLists},
                success: function (data) {
                    console.log('Dragged and updated successfully.');
                }
            });
        });

    });
</script>
</body>
</html>
