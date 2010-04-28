
-- CREATE TABLES MYSQL
-- ------------------------------------------------------
-- KEY SYSTEM
-- ------------------------------------------------------
DROP TABLE IF EXISTS tb_perfil;
CREATE TABLE tb_perfil (
	id_perfil int(7) NOT NULL AUTO_INCREMENT,
	ds_perfil varchar(50) NOT NULL,
	dt_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_perfil),
	UNIQUE KEY(ds_perfil)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO tb_perfil (ds_perfil) VALUES ('Administra'), ('Investigador');

DROP TABLE IF EXISTS tb_centro;
CREATE TABLE tb_centro (
	id_centro int(7) NOT NULL AUTO_INCREMENT,
	ds_centro varchar(50) NOT NULL,
	ds_json text,
	dt_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_centro),
	UNIQUE KEY(ds_centro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO tb_centro (ds_centro) VALUES ('TODOS OS CENTROS');

DROP TABLE IF EXISTS tb_type;
CREATE TABLE tb_type (
	id_type int(7) NOT NULL AUTO_INCREMENT,
	ds_type varchar(15),
	dt_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO tb_type (ds_type) VALUES ('msg'),('news'),('monitor'),('query');
	
DROP TABLE IF EXISTS tb_status;
CREATE TABLE tb_status (
	id_status int(7) NOT NULL AUTO_INCREMENT,

	id_type int(7) NOT NULL,
		FOREIGN KEY (id_type)
			REFERENCES tb_type(id_type)
			ON UPDATE CASCADE ON DELETE RESTRICT,

	ds_status varchar(15),
	dt_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO tb_status (id_type,ds_status) VALUES (1,'End'),(1,'Open'),(1,'Process');
	
DROP TABLE IF EXISTS tb_uf;
CREATE TABLE tb_uf (
	id_uf int(7) NOT NULL AUTO_INCREMENT,
	ds_uf varchar(2),
	dt_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_uf)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO tb_uf (ds_uf) VALUES('AC'),('AL'),('AM'),('AP'),('BA'),('CE'),('DF'),('ES'),('GO'),('MA'),('MG'),('MS'),('MT'),('PA'),('PB'),('PE'),('PI'),('PR'),('RJ'),('RN'),('RO'),('RR'),('RS'),('SC'),('SE'),('SP'),('TO');

DROP TABLE IF EXISTS tb_municipio;
CREATE TABLE tb_municipio (
	id_municipio int(7) NOT NULL AUTO_INCREMENT,

	id_uf int(7) NOT NULL,
		FOREIGN KEY (id_uf)
			REFERENCES tb_uf(id_uf)
			ON UPDATE CASCADE ON DELETE RESTRICT,

	ds_municipio varchar(50),
	dt_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_municipio)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ------------------------------------------------------
-- TABLE SYSTEM
-- ------------------------------------------------------
DROP TABLE IF EXISTS tb_user;
CREATE TABLE tb_user (
	id_user int(7) NOT NULL AUTO_INCREMENT,
	
	id_centro int(7) NOT NULL,
		FOREIGN KEY (id_centro)
			REFERENCES tb_centro(id_centro)
			ON UPDATE CASCADE ON DELETE RESTRICT,
	
	id_perfil int(7) NOT NULL,
		FOREIGN KEY (id_perfil)
			REFERENCES tb_perfil(id_perfil)
			ON UPDATE CASCADE ON DELETE RESTRICT,
	
	ds_user varchar(15) NOT NULL,
	ds_passwd text NOT NULL,
	ds_json text,
	dt_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_user),
	UNIQUE KEY(ds_user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO tb_user (id_centro,id_perfil,ds_user,ds_passwd,ds_json) VALUES (1,1,'avelino','95c728f5c27da5fc002d3bcdd25e1d97','{"name": "Thiago Avelino","st": 1,"block": 1,"treinamento": 1}');
INSERT INTO tb_user (id_centro,id_perfil,ds_user,ds_passwd,ds_json) VALUES (1,1,'felipe','95c728f5c27da5fc002d3bcdd25e1d97','{"name": "Felipe Hespporte","st": 1,"block": 1,"treinamento": 1}');

DROP TABLE IF EXISTS tb_msg;
CREATE TABLE tb_msg (
	id_msg int(7) NOT NULL AUTO_INCREMENT,
	
	id_user int(7) NOT NULL,
		FOREIGN KEY (id_user)
			REFERENCES tb_user(id_user)
			ON UPDATE CASCADE ON DELETE RESTRICT,
	
	id_type int(7) NOT NULL,
		FOREIGN KEY (id_type)
			REFERENCES tb_type(id_type)
			ON UPDATE CASCADE ON DELETE RESTRICT,
	
	id_status int(7) NOT NULL,
		FOREIGN KEY (id_status)
			REFERENCES tb_status(id_status)
			ON UPDATE CASCADE ON DELETE RESTRICT,
			
	ds_json text,
	dt_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_msg)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO tb_msg (id_user,id_type,id_status,ds_json) VALUES (1,1,1,'{"date": "26/03/2010","de": "avelino","title":"Testando","msg": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at velit a risus accumsan facilisis tincidunt sed odio. Vestibulum aliquet, erat quis gravida aliquet, est justo sodales magna, ac vestibulum mi nisl sit amet augue. Nunc eget ipsum consectetur tortor lacinia porttitor. Vestibulum ornare rutrum tellus sit amet tincidunt. Aenean ullamcorper convallis leo et interdum. Pellentesque mattis, urna sed ultrices bibendum, dui nisi gravida mi, at hendrerit dolor quam vitae enim. Duis ultrices, ante non posuere posuere, elit nibh aliquam mauris, nec dapibus erat massa sit amet nisl. Proin magna lorem, lobortis nec dignissim id, porta sit amet orci. Nulla facilisi. Nullam ut tortor felis, et posuere ligula. Praesent fermentum malesuada congue. Mauris sed ante risus, ut pretium elit. Donec suscipit ornare est non tincidunt. Curabitur dolor ipsum, euismod in hendrerit at, malesuada id quam. Ut vitae ipsum at ligula posuere hendrerit. Praesent sapien metus, gravida et dictum id, elementum et justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos."}');
	
DROP TABLE IF EXISTS tb_centro;
CREATE TABLE tb_centro (
	id_centro int(7) NOT NULL AUTO_INCREMENT,
	
	id_status int(7) NOT NULL,
		FOREIGN KEY (id_status)
			REFERENCES tb_status(id_status)
			ON UPDATE CASCADE ON DELETE RESTRICT,
			
	ds_json text,
	dt_stamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY(id_centro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;































