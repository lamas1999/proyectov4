<?php
namespace clases\usuario;  
  class Usuario
  {
      private $id;
      private $nombre;
      private $apellido;
      private $email;
      private $login;
      private $password;
      private $telefono;
      private $imagen;
     
      private $cnx;


      function inicializar($id,$nombre,$apellido,$email,$login,$password,$telefono,$imagen)
      {
          $this->id = $id;
          $this->nombre = $nombre;
          $this->apellido = $apellido;
          $this->email = $email;
          $this->login= $login;
          $this->password = $password;
          $this->telefono = $telefono;
          $this->imagen = $imagen;
          
          
          
      }
      function __construct($cnx)
      {
            $this->id = 0;
            $this->nombre = "";
            $this->apellido = "";
            $this->email = "";
            $this->login="";
            $this->password = "";
            $this->telefono = "";
            $this->imagen = "";
        
            $this->cnx = $cnx;
      }

/*********************************************** */
      function set_id($id)
      {
          $this->id = $id;
      }
      function get_id()
      {
          return $this->id;
      }
      /***********************************/
      function set_nombre($nombre)
      {
          $this->nombre = $nombre;
      }
      function get_nombre()
      {
          return $this->nombre;
      }
      /*******************************/
      function set_apellido($apellido)
      {
          $this->apellido = $apellido;
      }
      function get_apellido()
      {
          return $this->apellido;
      }
       /***********************************/
       function set_email($email)
       {
           $this->email = $email;
       }
       function get_email()
       {
           return $this->email;
       }
    
       /***********************************/
       function set_login($login)
      {
          $this->login = $login;
      }
      function get_login()
      {
          return $this->login;
      }
       /***********************************/
       function set_password($password)
       {
           $this->login = $password;
       }
       function get_password()
       {
           return $this->password;
       }
        /***********************************/

      function set_telefono($telefono)
      {
          $this->telefono = $telefono;
      }
      function get_telefono()
      {
          return $this->telefono;
      }
       /***********************************/
       function set_imagen($imagen)
       {
           $this->imagen = $imagen;
       }
       function get_imagen()
       {
           return $this->imagen;
       }
    
       /***********************************/


       function guardar()
    {     
      
      $nombre= $this->nombre;
      $apellido=$this->apellido;
      $email=$this->email;
      $login=$this->login;
      $password=$this->password;
      $telefono=$this->telefono;
      $imagen=$this->imagen;

     

        $sql = "insert into usuario values(null,'$nombre','$apellido','$email','$login',md5('$password'),'$telefono','$imagen')";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return true;
        }
        else
        {
           return false;
        }
    }

    function modificar()
    { 
      $id =$this->id;
      $nombre= $this->nombre;
      $apellido=$this->apellido;
      $email=$this->email;
      $login=$this->login;
      $telefono=$this->telefono;
      $imagen=$this->imagen;
     
        $sql = "update usuario set nombre = '$nombre',apellido ='$apellido', email = '$email', login= '$login', telefono='$telefono',imagen='$imagen'  where id = $id";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return true;
        }
        else
        {
           return false;
        }
    }

 
    function modificar_sinImg()
    { 
      $id =$this->id;
      $nombre= $this->nombre;
      $apellido=$this->apellido;
      $email=$this->email;
      $login=$this->login;
      $telefono=$this->telefono;

     
        $sql = "update usuario set nombre = '$nombre', apellido ='$apellido', email = '$email', login= '$login', telefono='$telefono'  where id = $id";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return true;
        }
        else
        {
           return false;
        }
    }  

   /* ******************** */ 
       function modificar_password()
    { 
      $id =$this->id;  
      $new_password=$this->password;

        $sql = "UPDATE usuario SET  password=md5('$new_password')  where id = $id";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return true;
        }
        else
        {
           return false;
        }
    } 
 

    function eliminar()
    {     
        $id = $this->id;
        $sql = "delete from usuario where id = $id";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return true;
        }
        else
        {
           return false;
        }
    }
    function buscar($criterionombre)
    {     
        //$id = $this->id;
        $sql = "select * from usuario where nombre like '%$criterionombre%' ";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return $resultado;
        }
        else
        {
           return false;
        }
    }


    function traerporid($id)
    {     
        //$id = $this->id;
        $sql = "select * from usuario where id = $id";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           $registro = $this->cnx->next($resultado);
           $this->id = $id;
           $this->nombre = $registro["nombre"];
           $this->apellido=$registro['apellido'];
           $this->email=$registro['email'];
           $this->login=$registro['login'];
           $this->password=$registro['password'];
           $this->telefono=$registro['telefono'];
           $this->imagen=$registro['imagen'];

           return true;
        } 
        else
        {
           return false;
        }
    }

    function loguear($login,$password)
    {
        //$id = $this->id;
        $sql = "SELECT * FROM usuario WHERE login = '$login' and password = MD5('$password') ";
        $resultado = $this->cnx->execute($sql);
        //para evitar errores en la consulta
        //me aseguro que el resultado no sea nulo
        //y que la cantidad de filas afectadas sea mayour a cero
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            //cada vez que se hace una consulta el apuntador apunta a un registro nulo
            //se debe apuntar al siguiente registro para obtener el primer registro de una consulta
            $registro = $this->cnx->next($resultado);
            $this->id = $registro["id"];
            $this->nombre = $registro["nombre"];
            $this->apellido=$registro['apellido'];
            $this->email = $registro["email"];
            $this->login = $registro["login"];
            $this->telefono = $registro["telefono"];
            $this->imagen = $registro["imagen"];
            return true;
        } else {
            return false;
        }
    }




  /*   function buscarabm($criterionombre,$paginadestino)
    {     
        //$id = $this->id;
        $sql = "select * from usuario where nombre like '%$criterionombre%' ";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
            echo "<table  class='table table-striped table-hover'>";
            echo "<tr class='thead-dark'>
            <th scope='col'>Id.</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Email</th>
            <th scope='col'>direccion</th>
            <th scope='col'>login</th>
            <th scope='col'>password</th>
            <th scope='col'>telefono</th>
            <th scope='col'>Mod.</th>
            <th scope='col'>Elim.</th>";
            while($registro = $this->cnx->next($resultado))
            {
                  $id = $registro["id"];
                  $nombre=$registro['nombre'];
                  $email=$registro['email'];
                  $direccion=$registro['direccion'];
                  $login=$registro['login'];
                  $password=$registro['password'];
                  $telefono=$registro['telefono'];
            
                $linkmodificar = "<a class='btn btn-outline-success' href='$paginadestino?id=$id&op=2' role='button'><i class='fas fa-user-edit pr-2 'aria-hidden='true'></i>Modificar</a>";
                $linkeliminar = "<a class='btn btn-outline-danger' href='$paginadestino?id=$id&op=3' role='button'><i class='fas fa-user-times pr-2 'aria-hidden='true'></i>Eliminar</a>";
                
                echo "<tr>
                <th scope='row'>$id</th>
                <td>$nombre</td>
                <td>$email</td>
                <td>$direccion</td>
                <td>$login</td>
                <td>$password</td>
                <td>$telefono</td>
                <td>$linkmodificar</th><th>$linkeliminar</th>";
                
            }
            echo "</table>";
        }
        else
        {
           return false;
        }
    } */

 /************************* */
  }
?>
