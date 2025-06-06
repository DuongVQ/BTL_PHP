<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
    <!-- header section strats -->
    @include('home.header')

    <!-- slider section -->
    @include('home.slider')

    <!-- shop section -->
    @include('home.product')

    <!-- contact section -->
    @include('home.contact')

    <!-- info section -->
    @include('home.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
