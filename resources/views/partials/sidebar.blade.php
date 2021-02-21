<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
	<div class="c-sidebar-brand d-md-down-none">
        <img class="brandicon" src="{{asset('favicon.png')}}"><span class="brandname">DummyTwitter</span>
	</div>
	<ul class="c-sidebar-nav">
		<li class="c-sidebar-nav-item">
			<a class="c-sidebar-nav-link c-active" href="/home">
		 		<i class="fa fa-home" aria-hidden="true"></i>Home
		 	</a>
		 </li>
		
		 <li class="c-sidebar-nav-item">
			<a class="c-sidebar-nav-link" href="{{ route('logout') }}"
             	onclick="event.preventDefault();
               	document.getElementById('logout-form').submit();">
		 		<i class="fa fa-sign-out" aria-hidden="true"></i>Logout
		 	</a>
		 </li>
	</ul>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>