<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!--Favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>

    <!--Bootstrap.min css-->
    <link rel="stylesheet" href="{{url('')}}/assets/plugins/bootstrap/css/bootstrap.min.css">

    <!--Style css-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/style.css">

    <!--Icons css-->
    <link rel="stylesheet" href="{{url('')}}/assets/css/icons.css">

    <!-- my style -->
    <link rel="stylesheet" href="{{url('')}}/assets/css/mystyle.css">

</head>

<body class="bg-colour bg-primary ">

<!--app open-->
<div id="app" class="page">
    <section class="section">
        <div class="container">
            <div class="">

            @section('content')
                <!--app open-->

                    @yield('auth.content')

            </div>
        </div>
    </section>
</div>
<!--app closed-->

<!--Jquery.min js-->
<script src="{{url('')}}/assets/js/jquery.min.js"></script>

<!--Scripts js-->
<script src="{{url('')}}/assets/js/scripts.js"></script>
</body>
</html>






