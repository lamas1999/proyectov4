 CREATE DATABASE ProyecGeolocalizacion;
 use ProyecGeolocalizacion;
create table usuario
(
    id int not null auto_increment,
    nombre varchar(50) not null,
	apellido varchar(100),
    email varchar(100) not null,
    login varchar(50) unique not null,
    password varchar(128) not null,
    telefono varchar(15)DEFAULT NULL,
    imagen text DEFAULT NULL,
    primary key(id)

)ENGINE=InnoDB DEFAULT CHARSET=latin1;

select * from usuario;

insert into usuario values (null,'Administrador','Frontend Developer','mocino9163@50000z.com','admin',MD5('123456'),'70000000',NULL);
 

CREATE TABLE `gps_track` (
  `rider_id` int(11) NOT NULL,
  `track_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `track_lng` decimal(11,7) NOT NULL,
  `track_lat` decimal(11,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `gps_track`
  ADD PRIMARY KEY (`rider_id`),
  ADD KEY `track_time` (`track_time`);
COMMIT;