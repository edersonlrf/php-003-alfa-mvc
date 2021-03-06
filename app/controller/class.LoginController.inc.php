<?php

class LoginController extends Controller
{
    public function Index() {
        $this->InicializaView('login_form.html');

        $this->Exibe();
    }

    public function Validar() {
        if (isset($_POST['usuario']) && isset($_POST['senha'])) {
            $login = new LoginModel();
            if ($login->Validar($_POST['usuario'], $_POST['senha'])) {
                $_SESSION['logado'] = $_POST['usuario'];

                header("Location: index.php?controller=login&metodo=bemvindo");

                return true;
            }
        }

        $_SESSION['mensagem'] = "Usuário ou senha inválida!";

        header("Location: index.php?controller=login");
    }

    // Exemplo de método/página com acesso restrito usuários logados no sistema.
    public function Bemvindo() {
        // Isso garante que se o usuário não estiver logado,
        // a página não será exibida.
        if (!isset($_SESSION['logado'])) {
            header("Location: index.php?controller=login");
        }

        $this->InicializaView('bemvindo.html');

        $this->Exibe();
    }

    public function Sair() {
        // Destroi a sessao e volta a tela de login.
        session_destroy();

        unset($_SESSION['logado']);

        header("Location: index.php?controller=login");
    }

    public function teste() {
        echo "string";
    }
}

// app/controller/class.LoginController.inc.php
