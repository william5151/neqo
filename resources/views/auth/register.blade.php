<!DOCTYPE html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/estiloslog.css')}}">
</head>

<body>
<section class="h-100  gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="text-center">
                                    <img src="{{asset('assets/logo.png')}}"
                                         style="width: 200px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1"></h4>
                                </div>

                                <form action="{{ route('register') }}" method="post">
                                    @csrf

                                    <p>Registrarse</p>

                                    <!-- Nombre -->
                                    <div class="form-outline mb-4">
                                        <input type="text" name="name" id="form2Example11" class="form-control"
                                               placeholder="Ingresar nombre"
                                               value="{{ old('name') }}" />
                                        <label class="form-label" for="form2Example11">Nombre</label>
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif

                                    <!-- Número de Identificación -->
                                    <div class="form-outline mb-4">
                                        <input type="text" name="numero_identificacion" id="form2Example22"
                                               class="form-control"
                                               placeholder="Identificación"
                                               value="{{ old('numero_identificacion') }}" />
                                        <label class="form-label" for="form2Example22">Número de Identificación</label>
                                    </div>
                                    @if ($errors->has('numero_identificacion'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('numero_identificacion') }}
                                        </div>
                                    @endif

                                    <!-- Correo -->
                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" id="form2Example11" class="form-control"
                                               placeholder="Correo"
                                               value="{{ old('email') }}" />
                                        <label class="form-label" for="form2Example11">Correo</label>
                                    </div>
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif

                                    <!-- Contraseña -->
                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="form2Example22" class="form-control" />
                                        <label class="form-label" for="form2Example22">Contraseña</label>
                                    </div>
                                    @if ($errors->has('password'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif

                                    <!-- Confirmar Contraseña -->
                                    <div class="form-outline mb-4">
                                        <input type="password" name="password_confirmation" id="form2Example22"
                                               class="form-control" />
                                        <label class="form-label" for="form2Example22">Confirmar Contraseña</label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">Registrarse
                                        </button>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Ir a login</p>
                                        <a href="{{ route('login') }}"
                                           class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Login</a>
                                    </div>
                                </form>


                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <h4 class="mb-4">Neqo: Redefiniendo la Experiencia Bancaria con Innovación Digital
                                </h4>
                                <p class="small mb-0">
                                    En la era de la transformación digital, surge un protagonista destacado en el
                                    mundo financiero: Neqo, un banco digital diseñado para cambiar la forma en que
                                    experimentamos las transacciones y servicios bancarios.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz"
        crossorigin="anonymous"></script>
</body>

</html>
