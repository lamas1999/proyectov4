<?php
namespace clases\track_da;  
  class Track_da
  {
      private $rider_id;
      private $track_time;
      private $track_lng;
      private $track_lat;
      private $cnx;


      function inicializar($rider_id,$track_time,$track_lng,$track_lat)
      {
          $this->rider_id = $rider_id;
          $this->track_time = $track_time;
          $this->track_lng = $track_lng;
          $this->track_lat = $track_lat;     
      }
      function __construct($cnx)
      {
            $this->rider_id = 0;
            $this->track_time = 0;
            $this->track_lng = 0;
            $this->track_lat = 0;
     
            $this->cnx = $cnx;
      }

/*********************************************** */
      function set_rider_id($rider_id)
      {
          $this->rider_id = $rider_id;
      }
      function get_rider_id()
      {
          return $this->rider_id;
      }
      /***********************************/
      function set_track_time($track_time)
      {
          $this->track_time = $track_time;
      }
      function get_track_time()
      {
          return $this->track_time;
      }
      /*******************************/
      function set_track_lng($track_lng)
      {
          $this->track_lng = $track_lng;
      }
      function get_track_lng()
      {
          return $this->track_lng;
      }
       /***********************************/
       function set_track_lat($track_lat)
       {
           $this->track_lat = $track_lat;
       }
       function get_track_lat()
       {
           return $this->track_lat;
       }
    
   
       /***********************************/

       function traerporid($rider_id)
       {     
           //$id = $this->id;
           $sql = "select * from gps_track where rider_id = $rider_id";
           $resultado = $this->cnx->execute($sql);    
           if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
           {  
              $registro = $this->cnx->next($resultado);
              $this->rider_id = $rider_id;
              $this->track_lng = $registro["track_lng"];
              $this->track_lat=$registro['track_lat'];
           
              return true;
           } 
           else
           {
              return false;
           }
       }
    }
    ?>