<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
  <a class="nav-link" href="/admin">
    <i class=" fas fa-building"></i><span>Dashboard</span>
  </a>
</li>
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
  <a href="{{ route('admin.roles.index') }}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('courses*') ? 'active' : '' }}">
  <a href="{{ route('admin.courses.index') }}"><i class="fa fa-book"></i><span>Courses</span></a>
</li>

<li class="{{ Request::is('lessons*') ? 'active' : '' }}">
  <a href="{{ route('admin.lessons.index') }}"><i class="fa fa-book-open"></i><span>Lessons</span></a>
</li>
<li class="{{ Request::is('contents*') ? 'active' : '' }}">
  <a href="{{ route('admin.contents.index') }}"><i class="fa fa-list-ul"></i><span>Contents</span></a>
</li>
<li class="{{ Request::is('questions*') ? 'active' : '' }}">
  <a href="{{ route('admin.questions.index') }}"><i class="fa fa-question-circle"></i><span>Questions</span></a>
</li>
<li class="{{ Request::is('questions*') ? 'active' : '' }}">
  <a href="{{ route('admin.users.index') }}"><i class="fa fa-user-circle"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('report*') ? 'active' : '' }}">
  <a href="{{ route('admin.dashboard.report') }}"><i class="fa fa-user-circle"></i><span>Report</span></a>
</li>

<li class="{{ Request::is('badgeSettings*') ? 'active' : '' }}">
  <a href="{{ route('admin.badgeSettings.index') }}"><i class="fa fa-medal"></i><span>Badge Settings</span></a>
</li>
