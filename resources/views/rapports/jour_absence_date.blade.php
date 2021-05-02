@extends('templates.index-template')
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
                       <h2>Histoiriques des absences par date <small>{{$lecteur}}</small></h2>

                     <input type="hidden" name="" id="name" value="{{$names}}">
                     <form  method="get">
                        <div class="input-group">

                            <input type="date" placeholder="01/01/2016" name="date" id="date" class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" id='search'class="btn btn-primary">Rechercher</button>
                                </span>

                            </div>


                           </form>

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
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>


                       </table>
                     </div>
                   </div>
                 </div>
            </div>
           </div>


</div>
@endsection
@section('custom-js')
<script>

$(document).ready(function(){
                 var table = $('#datatable-buttons > tbody:last');

        $('#search').click(function(e){
            e.preventDefault();

           var date = $('#date').val();
            var names = $('#name').val();

            console.log(names);
            var route = '/api/rapport/absence/'+date+'/'+names;
            $.ajax({
                url:route,
                type:'get',
                dataType:'json',

            }).done(function (response) {



                    jQuery.each(response,function (i,val) {
                        var html  = "<tr><td>" + val+ "</td>"+"</tr></td>";
                        table.append(html);

                    })
                    for (let i = 0; i < response.length; i++) {
                        const data = response[i];
                       }

                    $('#datatable-buttons').DataTable();

                console.log(response)
            })


        })


})
</script>

@endsection


