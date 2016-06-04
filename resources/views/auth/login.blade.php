<html>
    <head>  
        <title>Панель управления</title>
       <link rel="shortcut icon" href="/img/fav.png" type="image/x-icon">
        
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/css/vendor/pikaday.css">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet/less" type="text/css" href="/css/admin.less" />
        <script src="/js/vendor/less.min.js"></script>
        <style>
        * {
            font-family: 'Roboto';
        }
        </style>
    </head>
</html>


    <section class="container contacts">
        <article class="col-xs-8 col-xs-offset-2">
            <h2>
                <i class="fa fa-cogs"></i> Вход в панель управления
            </h2>

            <div style="height: 20px;">
            </div>

            <form role="form" method="POST" action="/admin/login">
                {!! csrf_field() !!}

                <div class="input-group input-group-lg">
                  <span class="input-group-addon" id="sizing-addon1">
                    <i class="fa fa-envelope">
                    </i>
                    </span>
                  <input required type="text" id="email" name="email" class="form-control" placeholder="Адрес электронной почты" aria-describedby="sizing-addon1">
                </div>
                <br>
                <div class="input-group input-group-lg">
                  <span class="input-group-addon" id="sizing-addon1">
                    <i class="fa fa-key">
                    </i>
                    </span>
                  <input required type="password" id="password" name="password" class="form-control" placeholder="Пароль" aria-describedby="sizing-addon1">
                </div>

                <br>
                <button class="btn btn-success btn-lg pull-right">
                    <i class="fa fa-sign-in">
                    </i>
                    Войти
                </button>
            </form>
                    
        </article>
    </section>

