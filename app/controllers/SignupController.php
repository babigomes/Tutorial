<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function indexAction()
    {

    }
    public function registerAction()
    {
        $user = new Users();

        //atribui o valor do formulário para $user
        $user->assign(
            $this->request->getPost(),
            [
                'name',
                'email'
            ]
        );

        // grava e verifica por erros
        $success = $user->save();

        // envia o resultado para a view
        $this->view->success = $success;

        if ($success) {
            $message = "Obrigado por se registrar!";
        } else {
            $message = "Desculpe, o seguinte erro foi encontrado:<br>"
                     . implode('<br>', $user->getMessages());
        }

        // passa a mensagem para a view
        $this->view->message = $message;
    }
    
}
