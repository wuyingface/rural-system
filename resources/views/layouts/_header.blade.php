<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                村村汇
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <!-- <ul class="nav navbar-nav">
                <li class="active"><a href="{{ route('articles.index') }}">所有</a></li>
                <li><a href="{{ route('articleCategories.show', 1) }}">乡村发展</a></li>
                <li><a href="{{ route('articleCategories.show', 2) }}">民风民俗</a></li>
                <li><a href="{{ route('articleCategories.show', 3) }}">文化建设</a></li>
                <li><a href="{{ route('articleCategories.show', 4) }}">吃喝玩乐</a></li>
                <li><a href="{{ route('articleCategories.show', 5) }}">随想随写</a></li>
            </ul> -->

            <ul class="nav navbar-nav">
                <li class="{{ active_class(if_route('articles.index')) }}"><a href="{{ route('articles.index') }}">所有</a></li>
                <li class="{{ active_class((if_route('articleCategories.show') && if_route_param('articleCategory', 1))) }}"><a href="{{ route('articleCategories.show', 1) }}">乡村发展</a></li>
                <li class="{{ active_class((if_route('articleCategories.show') && if_route_param('articleCategory', 2))) }}"><a href="{{ route('articleCategories.show', 2) }}">民风民俗</a></li>
                <li class="{{ active_class((if_route('articleCategories.show') && if_route_param('articleCategory', 3))) }}"><a href="{{ route('articleCategories.show', 3) }}">文化建设</a></li>
                <li class="{{ active_class((if_route('articleCategories.show') && if_route_param('articleCategory', 4))) }}"><a href="{{ route('articleCategories.show', 4) }}">吃喝玩乐</a></li>
                <li class="{{ active_class((if_route('articleCategories.show') && if_route_param('articleCategory', 5))) }}"><a href="{{ route('articleCategories.show', 5) }}">随想随写</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{ route('register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                <img src="{{ Auth::user()->avatar }}" class="img-responsive img-circle" width="30px" height="30px">
                            </span>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('users.show', Auth::id()) }}">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    个人中心
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.edit', Auth::id()) }}">
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    编辑资料
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>