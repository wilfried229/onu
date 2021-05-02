@extends('templates.index-template')
@section('tab-title')
  Dashboard - Days/Month
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
        <div class="col-md-12 col-sm-12 col-xs-12">
                   <div class="x_panel">
                     <div class="x_title">
                       <h2>Histoiriques mensuelles <small>{{$lecteur}}</small></h2>
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
                                        <th>Employés</th>
                                        <th>Date d'entré
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($biostars as $b)

                                    <tr>
                                            <td>    @foreach ($users as $u )
                                                @if ($u->USRID ==$b->USRID)
                                                {{$u->NM}}
                                                @endif
                                                @endforeach
                                    </td>

                                    <td>{{$b->SRVDT}}


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

@endsection
