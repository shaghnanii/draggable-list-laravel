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
            <h4 class="alert alert-success pb-3 mt-4">Laravel Drag & Drop</h4>

            <div class="row">
                @if(count($products) > 0)
                    <div class="col-12 p-3 shadow-lg">
                        <ul class="list-group  sortable-data-list" id="products-drag-and-drop">
                            @foreach($products as $key => $product)
                                <li class="list-group-item ">
                                    <div class="d-flex justify-content-between drag-me">
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
        $("#products-drag-and-drop").sortable({
            connectWith: ".sortable-data-list",
            opacity: 0.5,
            handle: ".drag-icon"
        });
        $(".sortable-data-list").on("sortupdate", function (event, ui) {
            console.log("Drag update enable...")
            let products = [];
            $(".drag-icon").each(function (index) {
                products[index] = $(this).attr('product-id');
                console.log('Dragging.... ID: ', products[index])
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
