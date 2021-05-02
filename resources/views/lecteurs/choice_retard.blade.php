@extends('templates.index-template')
@section('tab-title')
  Dashboard - Days/Users
@endsection
@section('custom-css')


@endsection

@section('content')

<br>
<br>
<div class="row">
    <!-- /.col -->
    <div class="col-md-12">
    <div class="box">
                <div class="box-header">
              <hr>
                  <h3 class="box-title">Selectionez un lecteur</h3>

                </div><!-- /.box-header -->
                <div class="box-body">

                            <div class="row">

                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                <form action="{{route('rapport.users')}}" method="get">
                                <div class="form-group">
                                <select name="lecteurs" id="site" class="form-control">
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

                            <div class="form-group">
                                    <input type="submit" value="Valider" class="btn btn-info">

                            </div>
                        </form>

                                </div>
                                <div class="col-sm-4"></div>
                            </div>


                </div>


    </div>
  </div>
  <!-- /.row -->

  </div>

<br>
<br>
<br>
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
                    "lengthMenu": "Afficher _MENU_ Utilisateurs par Page",
                    "zeroRecords": "Aucun résultat",
                    "info": "Page _PAGE_ sur _PAGES_",
                    "infoEmpty": "Aucun  Utilisateurs trouvée",
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
