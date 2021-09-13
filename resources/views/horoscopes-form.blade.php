<?php

use Illuminate\Support\Facades\Auth;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }} ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Horóscopos</title>
</head>

<body>
    <div class="fluid-container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a href="/"><img src="{{asset('assets/logo.png')}}" alt="Logo" class="logo ms-2 me-2" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Horóscopos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Signos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Acadêmicos</a>
                        </li>
                    </ul>

                    @if (Route::has('login'))
                    <ul class="navbar-nav me-3 mb-2 mb-lg-0">
                        @auth
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo Auth::user()->name ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{route('horoscopes.new')}}">Nova postagem</a></li>
                                    <li><button class="dropdown-item" type="submit">Sair</button></li>
                                </ul>
                            </li>
                        </form>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endif
                    </ul>
                    @endif
                </div>
            </div>
        </nav>

        <div class="container-fluid main gap-2 p-3 d-flex flex-wrap justify-content-center">
            <form class="col-10" action="{{route('horoscopes.new')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Título</label>
                    <input type="text" class="form-control" id="inputTitle" name="title">
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Imagem da postagem</label>
                    <input class="form-control" type="file" id="formFile" name="image">
                </div>

                <div class="form-floating">
                    <textarea class="form-control" id="floatingTextarea2" name="content" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Conteúdo da sua postagem...</label>
                </div><br />

                <button type="submit" class="btn btn-primary">Publicar</button>

                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>