<ul class="sidebar-menu" data-widget="tree">
    <li class="@yield('dashboard')">
      <a href="{{ route('dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li class="treeview @yield('user')">
      <a href="#">
        <i class="fa fa-user"></i> <span>User</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="@yield('user-index')"><a href="{{ route('user.index') }}">Users</a></li>
        <li class="@yield('user-create')"><a href="{{ route('user.create') }}">Create</a></li>
      </ul>
    </li>
    <li>
      <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-sign-out"></i> <span>Logout</span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidde">
        @csrf
      </form>
    </li>
</ul>