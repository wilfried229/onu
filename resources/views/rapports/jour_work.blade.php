@extends('templates.index-template')
@section('tab-title')
  Dashboard - Days/work
@endsection
@section('custom-css')

<link rel="stylesheet" href="{{ asset('Admin/plugins/datatables/dataTables.bootstrap4.min.css') }}">

@endsection

@section('content')

<br>
<br>
<div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Listes  des jours de travail par jour</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tableaux</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Listes  des absents par jour</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- ============================================================== -->
            <!-- basic table  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header bg-success ">Rapports des Utilisateurs/journalier</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table notreDataTable table-striped table-bordered first">
                                    <thead>
                                        <tr>
                                            <th>Utilisateurs</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td> <a href="" class="btn btn-sm btn-info" title="Imprimer"><i class="fa fa-print"></i></a>
                                                <a href="" class="btn btn-sm btn-warning" title="CSV Export"><i class="fa fa-filter"></i></a>
                                            </td>
                                        </tr>
                                               </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Option</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- ============================================================== -->
            <!-- end basic table  -->
            <!-- ============================================================== -->
        </div>

        </div>



@endsection

@section('extra-js')

    <!-- DataTables -->
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>

        $(function () {
            $(".notreDataTable").DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "language": {
                    "lengthMenu": "Afficher _MENU_ Utilisateur par Page",
                    "zeroRecords": "Aucun résultat",
                    "info": "Page _PAGE_ sur _PAGES_",
                    "infoEmpty": "Aucun  Utilisateur trouvée",
                    "infoFiltered": "(sur les _MAX_ Utilisateurs",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "loadingRecords": "Chargement...",
                    "processing":     "Traitement...",
                    "search":         "Rechercher : ",
                    "paginate": {
                        "first":      "Premier",
                        "last":       "Dernier",
                        "next":       "Suivante",
                        "previous":   "Précedente"
                    }
                }


            });
        });



    </script>
@endsection
