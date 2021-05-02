
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                  <h3>General</h3>
                  <ul class="nav side-menu">
                    <li><a href="{{route('rapport.choice')}}"><i class="fa fa-home"></i> Accueil <span class="fa fa-chevron-down"></span></a>

                    </li>
                    <li>
                        <a href="{{route('rapport.days.works',$names)}}"><i class="fa fa-table"></i> Journaliers <span class="fa fa-chevron-down"></span></a>
                    </li>
                    <li><a href="{{route('rapport.month',$names)}}"><i class="fa fa-desktop"></i>Mensuels <span class="fa fa-chevron-down"></span></a>

                    </li>
                    <li>
                            <a href="{{route('rapport.days.absent',$names)}}"><i class="fa fa-remove"></i>Absences <span class="fa fa-chevron-down"></span></a>

                  {{--   <ul class="nav child_menu">
                      <li><a href="{{route('rapport.days.absent',$names)}}">Journaliers</a></li>
                      <li><a href="{{route('rapport.absence.date',$names)}}">Par Date</a></li>
                    </ul> --}}
                  </li>
                    <li>
                            <a><i class="fa fa-bar-chart-o"></i> Heures de retard <span class="fa fa-chevron-down"></span></a>

                        <ul class="nav child_menu">
                          <li><a href="{{route('rapport.times.retard.matin',$names)}}">Matin</a></li>
                          <li><a href="{{route('rapport.times.retard.soir',$names)}}">Soir</a></li>
                        </ul>
                      </li>

                  </ul>
                </div>


              </div>
              <!-- /sidebar menu -->

              <!-- /menu footer buttons -->

