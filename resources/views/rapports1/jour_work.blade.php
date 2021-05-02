@extends('templates.index-template2')
@section('tab-title')
  Dashboard - Days/work
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
                       <h2>Historiques journalier <small>{{$departements->sName}}</small></h2>
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
                                    <th>Matricule</th>
                                    <th>Nom et Prénom</th>
                                    <th>Date d'entré</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($days as $key =>$bios)
                                   
                                    <tr>
                                        <td>
                                          {{$bios->nUserID}}  
                                    </td>
                                        <td> 
                                        {{$bios->sUserName}}  

                                            </td>
                                    <td>
                                    {{$bios->date_type}}
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
