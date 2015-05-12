@section('header')
<h1 class="page-header">Tech Study!
    <small>IT勉強会まとめサイト</small>
</h1>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">メニュー</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">ホーム <span class="sr-only">(current)</span></a></li>
                <li><a href="#">過去ログ</a></li>
                <li><a href="#">RSSフィード</a></li>
                <li><a href="#">連絡先</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">検索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">地域
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">すべて</a></li>
                        <li class="divider"></li>
                        <li><a href="#">北海道</a></li>
                        <li><a href="#">東北</a></li>
                        <li><a href="#">関東</a></li>
                        <li><a href="#">中部</a></li>
                        <li><a href="#">近畿</a></li>
                        <li><a href="#">中国</a></li>
                        <li><a href="#">四国</a></li>
                        <li><a href="#">九州</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
@stop
