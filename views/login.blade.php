@extends('app')

@section('contenido')
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3><i class="bi bi-gear p-2"></i>Login</h3>
                </div>
                <div class="card-body">
                    <div id="mensaje" class="d-none alert alert-danger" role="alert">
                    Credenciales incorrectos
                    </div>
                    <form id="login" method="POST" action="login.php">
                        <div class="input-group my-2">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" placeholder="usuario"
                               name="usuario" id="usuario">
                        </div>
                        <div id="errorUsuario" class="d-none text-danger small mb-2">
                        </div>

                        <div class="input-group my-2">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" placeholder="contraseña"
                               name="pass" id="pass">
                        </div>
                        <div id="errorPass" class="d-none text-danger small mb-2">
                        </div>
                        <div class="text-end mt-2">
                            <input type="submit" value="Entrar" class="btn btn-success" name="aceptar">
                            <a href="index.html" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="js/validar.js"></script>
@endsection