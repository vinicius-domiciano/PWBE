<?php
    $controller = (string) null;
    $modo = (string) null;

    $controller = $_GET['controller'];
    $modo = $_GET['modo'];

    //validando qual controller enviar;
    switch(strtoupper($controller)){
        case 'LOGIN':
            //instancia A classe loginController
            require_once('controller/loginController.php');
            switch(strtoupper($modo)){
                case 'LOGIN':
                    $loginController = new LoginController();
                    //Metodo para verificar se existe o usuario
                    $loginController->validarLogin();
                    break;
                    
                case 'LOGOUT':
                    $loginController = new LoginController();
                    //metodo para lougout
                    $loginController->logout();
                    break;
            }            
            
            break;
        /**/
        case 'PRODUTOS':
            //import do controller produtos
            require_once('controller/produtoController.php');
            switch(strtoupper($modo)){
                case 'INSERT':
                    //Intancia da classe 
                    $produtoController = new ProdutoController();
                    $produtoController->novoProduto();
                    
                    break;
                case 'UPDATE':
                    $id = $_GET['id'];
                    $produtoController = new ProdutoController();
                    $produtoController->atualizarProduto($id);
                    
                    break;
                case 'BUSCAR':
                    //Resgata o id
                    $id = $_GET['id'];
                    
                    $produtoController = new ProdutoController();
                    //Metodo para buscar
                    $produtoController->buscarProduto($id);
                    
                    break;
                case 'DELETE':
                    $id = $_GET['id'];
                    $imagem = $_GET['imagem'];
                    
                    $produtoController = new ProdutoController();
                    $produtoController->deletarProduto($id, $imagem);
                    
                    break;
                case 'BUSCARSUBCATEGORIA':
                    require_once('view/produto/selectSubcategoria.php');
                    break;
                    
                case 'UPLOAD':
                    //import e instancia da classe de upload de imagem
                    require_once('controller/uploadController.php');
                    $uploadController = new UploadController();
                    $uploadController->uploadImagem();
                    break;
                    
                case 'STATUS':
                    $id = $_GET['id'];
                    $status = $_GET['status'];
                    //instancia do objeto controller
                    $produtoController = new ProdutoController();
                    //metodo para atualizar o status;
                    $produtoController->atualizarStatus($id, $status);
                    break;
                    
                case 'MODAL':
                    require_once('view/produto/modalProduto.php');
                    
                    break;
            }
            
            break;
        /**/    
        case 'CATEGORIA':
            require_once('controller/categoriaController.php');
            switch(strtoupper($modo)){
                case 'INSERT':
                    //Intancia da classe 
                    $categoriaController = new CategoriaController();
                    $categoriaController->novaCategoria();
                    break;
                case 'UPDATE':
                    $id = $_GET['id'];
                    $categoriaController = new CategoriaController();
                    $categoriaController->atualizarCategoria($id);
                    
                    break;
                case 'BUSCAR':
                    //Resgata o id
                    $id = $_GET['id'];
                    
                    $categoriaController = new CategoriaController();
                    //Metodo para buscar
                    $categoriaController->buscarCategoria($id);
                    
                    break;
                case 'DELETE':
                    $id = $_GET['id'];
                    //instancia do objeto controller
                    $categoriaController = new CategoriaController();
                    //metodo para deletar
                    $categoriaController->deletarCategoria($id);
                    break;
                    
                case 'STATUS':
                    $id = $_GET['id'];
                    $status = $_GET['status'];
                    //instancia do objeto controller
                    $categoriaController = new CategoriaController();
                    //metodo para atualizar o status;
                    $categoriaController->atualizarStatus($id, $status);
                    
                    break;
            }
            
            break;
        /**/    
        case 'SUBCATEGORIA':
            //Intancia da classe subcategoriaController
            require_once('controller/subcategoriaController.php');
            switch(strtoupper($modo)){
                case 'INSERT':
                    $subcategoriaController = new SubcategoriaController();
                    $subcategoriaController->novaSubcategoria();
                    
                    break;
                case 'UPDATE':
                    $id = $_GET['id'];
                    
                    $subcategoriaController = new SubcategoriaController();
                    $subcategoriaController->atualizarSubcategoria($id);
                    
                    break;
                case 'BUSCAR':
                    //Resgata o id
                    $id = $_GET['id'];
                    
                    $subcategoriaController = new SubcategoriaController();
                    //Metodo para buscar
                    $subcategoriaController->buscarSubcategoria($id);
                    
                    break;
                case 'DELETE':
                    $id = $_GET['id'];
                    //instancia do objeto controller
                    $subcategoriaController = new SubcategoriaController();
                    //metodo para deletar
                    $subcategoriaController->deletarSubcategoria($id);
                    
                    break;
                    
                case 'STATUS':
                    $id = $_GET['id'];
                    $status = $_GET['status'];
                    //instancia do objeto controller
                    $subcategoriaController = new SubcategoriaController();
                    //metodo para atualizar o status;
                    $subcategoriaController->atualizarStatus($id, $status);
                    
                    break;
            }
            
            break;
    }

?>