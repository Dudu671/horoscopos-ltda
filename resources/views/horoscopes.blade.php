<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }} ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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

        <div class="container-fluid main gap-3 p-3 d-flex flex-wrap justify-content-center">
            @foreach($horoscopes as $horoscope)
            <div class="card col-12" style="width: 18rem;">
                <div class="card-header">
                    {{$horoscope->title}}
                </div>

                <img src="{{asset('/storage/'.$horoscope->image_path)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-content"><?php echo nl2br($horoscope->content); ?></p>
                    <p><strong>Autor:</strong> {{$horoscope->author}}</p>
                    <p><strong>Data de publicação:</strong> <?php echo date('d/m/Y - H:i T', strtotime($horoscope->created_at)); ?></p>
                </div>

                <hr />
                <p class="likes-info fs-6 lh-1 m-0">100 likes</p>
                <hr />

                <div class="buttons-container mb-3 d-flex justify-content-around">
                    <a href="" class="btn btn-primary btn-sm"><i class="bi-hand-thumbs-up"></i> Like</a>
                    <a href="" class="btn btn-primary btn-sm">Ver mais</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>