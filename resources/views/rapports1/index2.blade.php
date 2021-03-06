<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- forgot password  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center">


                <h1 class="btn btn-primary">RapportS BioStar V1</h1>

                <span class="splash-description">Choisissez un département.</span></div>
            <div class="card-body">
                    <form action="{{route('rapport2.redirect')}}" method="get">

                    <div class="form-group">


                            <select name="departement" id="site" class="form-control form-control-lg">

                                <option value="" selected='selected'>Selectionnez</option>
                                    @foreach ($departement as $d)
                                    <option value="{{$d->nDepartmentIdn}}">{{$d->sName}}</option>
                                    @endforeach
                                </select>
                    </div>
                    <div class="form-group pt-1">
                        <input type="submit" value="Accéder"class="btn btn-block btn-primary btn-x">
                </form>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end forgot password  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
<script src="{{asset('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
</body>


</html>
