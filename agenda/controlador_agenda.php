<?php

function abrirArquivo (){
    $contatosAuxiliar = file_get_contents('contatos.json'); // lê o conteúdo de um arquivo e o retorna como uma string.
    $contatosAuxiliar = json_decode($contatosAuxiliar, true); // transforma o formato json para um array.

    return $contatosAuxiliar;
}

function atualizarArquivo($contatosAuxiliar){
    $contatosJson = json_encode($contatosAuxiliar, JSON_PRETTY_PRINT); // o json_encode transforma o formato array para o json.

    file_put_contents('contatos.json', $contatosJson); //Escreve uma string para um arquivo.

    header('Location: index.phtml'); //redireciona para outra página.

}

function cadastrar($nome, $email, $telefone){

    //controlador agenda
    $contatosAuxiliar = abrirArquivo();

    $contato = [
        'id'      => uniqid(),
        'nome'    =>$nome,
        'email'   =>$email,
        'telefone'=>$telefone
    ];



    array_push($contatosAuxiliar, $contato);
    atualizarArquivo($contatosAuxiliar);
}


function pegarContatos (){
    $contatosAuxiliar = abrirArquivo();

    return $contatosAuxiliar;

}

function buscarContato($nome){

    $contatos = abrirArquivo();
    $contatosEncontrados = [];

    foreach ($contatos as $contato){
        if($contato['nome'] == $nome){
            $contatosEncontrados[] = $contato;
        }

    }

    return $contatosEncontrados;
}

function excluirContato($id){
    $contatosAuxiliar = abrirArquivo();


    foreach ($contatosAuxiliar as $posicao => $contato) {
        if ($id == $contato['id']) {
            unset($contatosAuxiliar[$posicao]);
        }

    }
    atualizarArquivo($contatosAuxiliar);

}

function editarContato($id){

    $contatosAuxiliar = abrirArquivo();

    foreach ($contatosAuxiliar as $contato){
        if ($contato['id'] == $id){
            return $contato;
        }
    }

}
   function salvarContatoEditado($id, $nome, $email, $telefone){
       $contatosAuxiliar = abrirArquivo();
       foreach ($contatosAuxiliar as $posicao => $contato) {
           if ($contato['id'] == $id){

               $contatosAuxiliar [$posicao]['nome'] = $nome;
               $contatosAuxiliar [$posicao]['email'] = $email;
               $contatosAuxiliar [$posicao]['telefone'] = $telefone;

               break;

           }

       }

       $contatosJson = atualizarArquivo($contatosAuxiliar);

   }

//ROTAS
if ($_GET['acao'] == 'cadastrar'){

   cadastrar($_POST['nome'], $_POST['email'], $_POST['telefone']);

} elseif ($_GET['acao'] == 'excluir'){
    excluirContato($_GET['id']);
} elseif ($_GET['acao'] == 'editar'){
    salvarContatoEditado($_POST['id'], $_POST['nome'], $_POST ['email'], $_POST['telefone']);
}





















