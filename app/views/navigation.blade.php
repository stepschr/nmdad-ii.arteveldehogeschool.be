            <div data-role="navbar" id="nav">

                <ul>
                    <li>{{ HTML::linkRoute('user.index', 'Profiel', [], [
                        'class' => 'ui-btn ui-btn-inline',
                        ]) }}</li>
                    <li><a href="/nmdad-ii.arteveldehogeschool.be/public/" class="{{{ $pageActive == 'page-tasks' ? 'ui-btn-active ui-state-persist ' : '' }}}ui-btn-icon-left ui-icon-bullets">Taken</a></li>

                    <li><a href="#page-lists" class="{{{ $pageActive == 'page-lists' ? 'ui-btn-active ui-state-persist ' : '' }}}ui-btn-icon-left ui-icon-tag">Lijsten</a></li>
                    <!--<li><a href="#page-labels" class="{{{ $pageActive == 'page-lijsten' ? 'ui-btn-active ui-state-persist ' : '' }}}ui-btn-icon-left ui-icon-tag">Labels & Tags</a></li>-->
                    <li><a href="#page-vrienden" class="{{{ $pageActive == 'page-vrienden' ? 'ui-btn-active ui-state-persist ' : '' }}}ui-btn-icon-left ui-icon-tag">Vrienden</a></li>
                    <li><a href="#page-instellingen" class="{{{ $pageActive == 'page-instellingen' ? 'ui-btn-active ui-state-persist ' : '' }}}ui-btn-icon-left ui-icon-tag">Instellingen</a></li>


                </ul>

            </div><!-- /navbar -->

