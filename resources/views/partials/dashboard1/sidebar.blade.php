
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                      <h3>General</h3>
                      <ul class="nav side-menu">
                        <li><a href="{{route('rapport2.choice')}}"><i class="fa fa-home"></i> Accueil <span class="fa fa-chevron-down"></span></a>

                        </li>
                        <li>
                            <a href="{{route('rapport2.days.works',$departement)}}"><i class="fa fa-table"></i> Journaliers <span class="fa fa-chevron-down"></span></a>
                        </li>
                        <li><a href="{{route('rapport2.month',$departement)}}"><i class="fa fa-desktop"></i>Mensuels <span class="fa fa-chevron-down"></span></a>

                        </li>


                        @if ($departement != '1' and $departement != '4' and $departement != '542183565')

 <li><a href="{{route('rapport2.days.absences',$departement)}}"><i class="fa fa-remove"></i>Absences <span class="fa fa-chevron-down"></span></a></li>

 <li>
                                <a href="{{route('rapport2.times.retard.matin',$departement)}}"><i class="fa fa-bar-chart-o"></i> Heures de retard <span class="fa fa-chevron-down"></span></a>

                           <!--  <ul class="nav child_menu">
                              <li><a href="{{route('rapport2.times.retard.matin',$departement)}}">Matin</a></li>
                              <li><a href="{{route('rapport2.times.retard.soir',$departement)}}">Soir</a></li>
                            </ul> -->
                          </li>

                          <li>
 <li><a href="{{route('rapport2.heureEntrer',$departement)}}"><i class="fa fa-bar-chart-o"></i>Heures d'Entrée</a></li>

 <li><a href="{{route('rapport2.heureSortiesmartin',$departement)}}" ><i class="fa fa-bar-chart-o"></i>Heures de Sortie</a></li>

 <li><a href="{{route('rapport2.search.cumileAbsences',$departement)}}" ><i class="fa fa-pie-chart"></i>Cumuls d'absence</a></li>

 <li><a href="{{route('rapport2.search.cumilleRetard',$departement)}}" ><i class="fa fa-clock-o"></i>Cumuls de retard</a></li>


                        @else
                        <li>
                                <a href="{{route('rapport2.days.absences',$departement)}}"><i class="fa fa-remove"></i>Absences <span class="fa fa-chevron-down"></span></a>

{{--                         <ul class="nav child_menu">
                          <li><a href="{{route('rapport.days.absent',$departement)}}">Journaliers</a></li>
                          <li><a href="{{route('rapport.absence.date',$departement)}}">Par Date</a></li>
                        </ul>
 --}}                      </li>
                        <li>
                                <a><i class="fa fa-bar-chart-o"></i> Heures de retard <span class="fa fa-chevron-down"></span></a>

                            <ul class="nav child_menu">
                              <li><a href="{{route('rapport2.times.retard.matin',$departement)}}">Matin</a></li>
                              <li><a href="{{route('rapport2.times.retard.soir',$departement)}}">Soir</a></li>
                            </ul>
                          </li>

                          <li>
                            <a  href="{{route('rapport2.heureEntrer',$departement)}}"><i class="fa fa-bar-chart-o"></i> Heures d'Entrée (avant 13 h)<span class="fa fa-chevron-down"></span></a>

                   <!--      <ul class="nav child_menu">
                          <li><a href="{{route('rapport2.heureEntrer',$departement)}}">Avant 13h</a></li>
                           <li><a href="{{route('rapport2.times.retard.soir',$departement)}}">DE 13H</a></li>
                        </ul>
 -->
                      </li>

                      <li>
                        <a><i class="fa fa-bar-chart-o"></i> Heures de Sortie <span class="fa fa-chevron-down"></span></a>

                    <ul class="nav child_menu">
                      <li><a href="{{route('rapport2.heureSortiesmartin',$departement)}}">De 12H</a></li>
                      <li><a href="{{route('rapport2.heureSortiesSoir',$departement)}}">DE 17H</a></li>
                    </ul>

                  </li>


                  <li><a href="{{route('rapport2.search.cumileAbsences',$departement)}}" ><i class="fa fa-pie-chart"></i>Cumuls d'absence</a></li>

<li><a href="{{route('rapport2.search.cumilleRetard',$departement)}}" ><i class="fa fa-clock-o"></i>Cumuls de retard</a></li>

                        @endif
 
   
               <li><a href="{{route('rapport2.search.date',$departement)}}"> Cumuls des Jours Travaillés </a></li>
 
                  <li><a href="{{route('rapport2.search.alluser',$departement)}}"> Rapport par date  </a></li>

                      </ul>


                    </div>


                  </div>
                  <!-- /sidebar menu -->

                  <!-- /menu footer buttons -->

