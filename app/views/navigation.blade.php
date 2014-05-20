<div data-role="navbar" id="nav">

    <sidebar class="menu">
        <ul>
            <li>{{ HTML::linkRoute('user.index', '', [], [
                'class' => 'nav-profiel',
                ]) }}</li>
            <li><a href="/nmdad-ii.arteveldehogeschool.be/public/" class="{{{ $pageActive == 'page-tasks' ? 'ui-btn-active ui-state-persist ' : '' }}}ui-btn-icon-left ui-icon-grid">Taken</a></li>
              <li><a href="/nmdad-ii.arteveldehogeschool.be/public/#page-lists" class="{{{ $pageActive == 'page-lists' ? 'ui-btn-active ui-state-persist activenav' : '' }}}ui-btn-icon-left ui-icon-bullets">Lijsten</a></li>
            <!--<li><a href="#page-labels" class="{{{ $pageActive == 'page-lijsten' ? 'ui-btn-active ui-state-persist ' : '' }}}ui-btn-icon-left ui-icon-tag">Labels & Tags</a></li>-->
            <li><a href="/nmdad-ii.arteveldehogeschool.be/public/#page-vrienden" class="{{{ $pageActive == 'page-vrienden' ? 'ui-btn-active ui-state-persist activenav' : '' }}}ui-btn-icon-left ui-icon-star">Vrienden</a></li>
            <li><a href="/nmdad-ii.arteveldehogeschool.be/public/#page-instellingen" class="{{{ $pageActive == 'page-instellingen' ? 'ui-btn-active ui-state-persist activenav' : '' }}}ui-btn-icon-left ui-icon-gear">Instellingen</a></li>


        </ul>
    </sidebar>

</div><!-- /navbar -->

