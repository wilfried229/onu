@extends('templates.index-template2')
@section('tab-title')
  Dashboard - Search
@endsection

@section('header')
<div class="page-title">
        <div class="title_left">
          <h3> Rapports<small></small></h3>
        </div>
      </div>
@endsection

@section('content')


<div class="row">
<form action="{{route('rapport2.search.date',$departement)}}" method="get">
            @csrf
                <div class="col-lg-6">
                        <label for="">Date de début</label>
                        <input type="date" name="date_debut" id="" class="form-control">
                </div>

                <div class="col-lg-6">
                        <label for="">Date de fin</label>
                        <input type="date" name="date_fin" id="" class="form-control">
                </div>

                <div class="col-lg-6">
                    <label for="">Matricule</label>
                    <input type="text" name="matricule" id="" class="form-control">
            </div>

            <div class="col-lg-6">
                    <label for=""></label>
                                    <br>
                    <input type="submit" value="Rechercher" class="btn btn-info">

            </div>



            </form>


</div>


<div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="x_panel">
                     <div class="x_title">
                                                   
                                                    <h2>Cumuls des Jours Travaillés <small>{{$departements->sName}}</small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                         <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                         </li>

                       </ul>
                       <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                       <p class="text-muted font-13 m-b-30">
                       </p>

                    </div>

                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                                <tr>
                                <th>Date de présence</th>
                                </tr>
                            </thead>
                            <tbody>
                                  
                                @foreach ($cumuleJourTravail as $item)
                                   <td>

                                {{$item}}

                            </td>
                                     </tr>

                                @endforeach


                                </tbody>

                                <tfoot>
                                <th colspan="4">Totales de Jours Travailler: {{$countDays}} Jour (s)</th>
                                </tfoot>

                   </table>

                </div>
                     </div>
                   </div>
                 </div>
            </div>
           </div>


</div>
@endsection
