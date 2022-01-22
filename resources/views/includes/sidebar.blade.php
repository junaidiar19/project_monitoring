<div class="l-navbar show" id="nav-bar">
    <nav class="nav">
        <div> <a href="#" class="nav_logo mb-3"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Project <br> Monitoring</span> </a>
            <div class="nav_list"> 
                <a href="{{ route('project.index') }}" class="nav_link {{ Request::is('*project*') || Request::is('*tugas*') ? 'active' : '' }}"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Project</span> </a>
                <a href="{{ route('tim.index') }}" class="nav_link {{ Request::is('*tim*') ? 'active' : '' }}"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Tim</span> </a> 
            </div>
    </nav>
</div>