<div id="zp-admin-menu-bg"></div>
<div id="zp-admin-menu-wrap" class="zp-sidebar">
	<ul class="nav flex-column">
		<div class="zp-nav-closed"><i class="fas fa-times"></i></div>
		<div class="zp-user-info">
			<div class="zp-image">
				<img src="{{ url( '/images/default.png' ) }}" border="0" width="48" class="img-circle">
			</div>
			<div class="zp-info-wrap">
				<div class="name">{{ Auth::user()->name }}</div>
				{{-- <a href="" class="position text-white"></a> --}}
			</div>
		</div>
	    @if (Gate::check('isSuperAdmin') || Gate::check('isAdmin'))
		    <li class="nav-item"><a class="nav-link {{ request()->is('Dashboard') ? 'active' : '' }}" href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
		    <li class="nav-item">
				<a href="#zpNavMedia" class="nav-link" data-toggle="collapse" data-target="#zpNavMedia">
					<i class="fas fa-photo-video"></i> Media </a>
				<div class="collapse {{ request()->is('media*') ? 'show' : '' }}" id="zpNavMedia">
					<ul class="nav flex-column py-0 submenu">
						<li class="nav-item">
							<a class="nav-link @yield('active_add_media')" href="{{ route('media.create') }}"><i class="fas fa-pencil-alt"></i> Add Media</a>
						</li>
						<li class="nav-item">
							<a class="nav-link @yield('active_library')" href="{{ route('media.index') }}"><i class="fas fa-photo-video"></i> Library</a>
						</li>
						<li class="nav-item">
							<a class="nav-link @yield('active_category')" href="{{ route('category.index') }}"><i class="fas fa-list"></i> Categories</a>
						</li>
					</ul>
				</div>
		    </li>
		    
	    @endif
	    @if (Gate::check('isSuperAdmin'))
		    <li class="nav-item"><a class="nav-link @yield('active_register')" href="{{ route('register') }}"><i class="fas fa-user-edit"></i> Register User</a></li>
		    <li class="nav-item"><a class="nav-link @yield('active_reset')" href="{{ route('password.request') }}"><i class="fas fa-user-edit"></i> Reset Password</a></li>
		    <li class="nav-item"><a class="nav-link @yield('active_user')" href="{{ route('admin.index') }}"><i class="fas fa-users"></i> Users</a></li>
		    <li class="nav-item"><a class="nav-link @yield('active_roles')" href="{{ route('role.index') }}"><i class="fas fa-cogs"></i> Roles</a></li>
	  @endif
	</ul>	
</div>
