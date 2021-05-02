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
            <div class="card-header text-center"><img class="logo-img" src="{{asset('assets/images/logo.png')}}" alt="logo"><span class="splash-description">Veillez choisir un lecteur.</span></div>
            <div class="card-body">
                    <form action="{{route('rapport.redirect')}}" method="get">

                    <div class="form-group">


                            <select name="lecteurs" id="site" class="form-control form-control-lg">

                                <option value="" selected='selected'>Selectionnez</option>
                                    @foreach ($lecteurs as $l)
                                    @foreach ($name as $n)
                                    @if ($l->DEVUID == $n->INSDEVUID)
                                    <option value="{{$l->DEVUID}}">{{$n->NM}}</option>
                                    @if ($l->DEVUID != $n->INSDEVUID)
                                    <option value="{{$l->DEVUID}}">{{$l->DEVUID}}</option>
                                    @endif
                                    @endif
                                    @endforeach
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
