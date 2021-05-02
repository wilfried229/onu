@extends('templates.index-template2')
@section('tab-title')
  Dashboard - cumille des retards;
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
<form action="{{route('rapport2.search.cumilleRetard',$departement )}}" method="get">
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


<br>
<div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="x_panel">
                     <div class="x_title">
                                                 
                                                    <h2>Historiques des cumuls des retards <small>{{$departements->sName}} </small> Totales Heures de Retard : {{$converMinitesEnHeure}} </h2>
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
                    <h3>Cumuls du matin</h3>
                        <thead>
                                <tr>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Date d'entré</th>
                                    <th>Minutes de retard</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($test as $key =>$bios)
                                    <tr>
                                    <td>{{$bios->nUserID}}</td>
                                            <td>
                                                    @foreach ($users as $us)
                                                    @if ($bios->nUserID == $us->sUserID)
                                                    {{$us->sUserName}}
                                                    @endif
                                                    @endforeach
                                            </td>
                                    <td>
                                    {{$bios->date_type}}
                                    </td>

                                    <td>


                                        @php($dateConvert = date('Y-m-d',strtotime($bios->date_type)))



                                        @if ($diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 08:00:00"))) <= -60)
                                        {{$diff = Carbon\Carbon::parse($bios->date_type)->diffInSeconds(Carbon\Carbon::parse(date("$dateConvert 08:00:00")))}} Seconds
                                        @endif


                                        @if ($diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 08:00:00"))) <= 60)
                                        {{$diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 08:00:00")))}} Minutes


                                        @endif
                                        @if ($diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 08:00:00"))) >= 60)

                                        @php($dateMinutes = $diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 08:00:00"))))
                                        @php($dateMintes = $diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 08:00:00"))))
                                        {{date('G \H\e\u\r\s i \m\i\n\u\t\e\s',mktime(0,$dateMintes))}}


                                        @endif



                                    </td>
                                        </tr>
                                    @endforeach

                                </tbody>

               

                   </table>

<br>

<!-- soir -->
<table id="datatable-buttons" class="table table-striped table-bordered">

                        <h3>Cumls après midi</h3>
                        <thead>
                                <tr>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Date d'entré</th>
                                    <th>Minutes de retard</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($test2 as $key =>$bios)
                                    <tr>
                                    <td>{{$bios->nUserID}}</td>
                                            <td>
                                                    @foreach ($users as $us)
                                                    @if ($bios->nUserID == $us->sUserID)
                                                    {{$us->sUserName}}
                                                    @endif
                                                    @endforeach
                                            </td>
                                    <td>
                                    {{$bios->date_type}}
                                    </td>

                                    <td>


                                        @php($dateConvert = date('Y-m-d',strtotime($bios->date_type)))



                                        @if ($diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 13:00:00"))) <= -60)
                                        {{$diff = Carbon\Carbon::parse($bios->date_type)->diffInSeconds(Carbon\Carbon::parse(date("$dateConvert 13:00:00")))}} Seconds
                                        @endif


                                        @if ($diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 13:00:00"))) <= 60)
                                        {{$diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 13:00:00")))}} Minutes


                                        @endif
                                        @if ($diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 13:00:00"))) >= 60)

                                        @php($dateMinutes = $diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 13:00:00"))))
                                        @php($dateMintes = $diff = Carbon\Carbon::parse($bios->date_type)->diffInMinutes(Carbon\Carbon::parse(date("$dateConvert 13:00:00"))))
                                        {{date('G \H\e\u\r\s i \m\i\n\u\t\e\s',mktime(0,$dateMintes))}}


                                        @endif



                                    </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                           
                   </table>




                </div>
                     </div>
                   </div>
                 </div>
            </div>
           </div>


</div>
@endsection
