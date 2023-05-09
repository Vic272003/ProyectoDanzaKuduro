INSERT INTO eventos(dia,hora,precio,lugar,especialidad) VALUES ('2023-09-23','16:05:00','80','Alicante','Danza moderna');
INSERT INTO eventos(dia,hora,precio,lugar,especialidad) VALUES ('2024-12-28','08:05:00','100','Almeria','Danza antigua');
INSERT INTO eventos(dia,hora,precio,lugar,especialidad) VALUES ('2023-11-20','19:10:00','20','Almeria','Ballet');
INSERT INTO eventos(dia,hora,precio,lugar,especialidad) VALUES ('2023-11-15','14:05:00','10','Ecuador','Danza moderna');
INSERT INTO eventos(dia,hora,precio,lugar,especialidad) VALUES ('2024-12-28','08:05:00','90','Almeria','Ballet');

INSERT INTO grupo VALUES ('B30','Ballet');
INSERT INTO grupo VALUES ('DC1','Danza clasica');
INSERT INTO grupo VALUES ('DM1','Danza moderna');
INSERT INTO grupo VALUES ('DA1','Danza antigua');
INSERT INTO grupo VALUES ('DE1','Danza estilista');

INSERT INTO tarifas(nombre,descuento) VALUES ('Basico',10);
INSERT INTO tarifas(nombre,descuento) VALUES ('Normal',30);
INSERT INTO tarifas(nombre,descuento) VALUES ('Premium',50);
INSERT INTO tarifas(nombre,descuento) VALUES ('Caducado',0);

INSERT INTO gestor VALUES ('44587499R','Eduardo', 'Manos Tijeras','$2y$10$nxcmPouzt3iyfMBPa3d5LuqtwHEFkoLEgRRmW1MbsTDtXxDBGDsW.','no');
INSERT INTO gestor VALUES ('88956244E','Amanda', 'Rizos Amalgama','$2y$10$nxcmPouzt3iyfMBPa3d5LuqtwHEFkoLEgRRmW1MbsTDtXxDBGDsW.','si');
INSERT INTO gestor VALUES ('66253155G','Tomás', 'Rodríguez Marín','$2y$10$nxcmPouzt3iyfMBPa3d5LuqtwHEFkoLEgRRmW1MbsTDtXxDBGDsW.','no');
INSERT INTO gestor VALUES ('77240233T','Adam', 'Yala Soriano','$2y$10$nxcmPouzt3iyfMBPa3d5LuqtwHEFkoLEgRRmW1MbsTDtXxDBGDsW.','si');
INSERT INTO gestor VALUES ('88965222T','María', 'Rosa García','$2y$10$nxcmPouzt3iyfMBPa3d5LuqtwHEFkoLEgRRmW1MbsTDtXxDBGDsW.','no');
INSERT INTO gestor VALUES ('00000000A','Admin', '','$2y$10$nxcmPouzt3iyfMBPa3d5LuqtwHEFkoLEgRRmW1MbsTDtXxDBGDsW.','no');

INSERT INTO monitor VALUES ('12345678R','44587499R','Mario', 'Sánchez Salvador','$2y$10$xgbKcmnxXar.nq3Is.O0auGCDBtIV.MYxvx/8XUcoRm3NTzkuio5.','Ballet','no','2005-05-26');
INSERT INTO monitor VALUES ('87456321E','44587499R','Andrea', 'Salazar Mclovin','$2y$10$xgbKcmnxXar.nq3Is.O0auGCDBtIV.MYxvx/8XUcoRm3NTzkuio5.','Danza clasica','si','2015-10-20');
INSERT INTO monitor VALUES ('66999877R','88956244E','Pablo', 'Pérez Marín','$2y$10$xgbKcmnxXar.nq3Is.O0auGCDBtIV.MYxvx/8XUcoRm3NTzkuio5.','Ballet','no','2022-09-05');
INSERT INTO monitor VALUES ('44888877R','66253155G','Félix', 'López Soriano','$2y$10$xgbKcmnxXar.nq3Is.O0auGCDBtIV.MYxvx/8XUcoRm3NTzkuio5.','Danza estilista','si','2020-06-23');
INSERT INTO monitor VALUES ('99666222L','66253155G','Marta', 'Osorio García','$2y$10$xgbKcmnxXar.nq3Is.O0auGCDBtIV.MYxvx/8XUcoRm3NTzkuio5.','Danza antigua','no','2018-07-21');

INSERT INTO cliente VALUES ('48795684B',1,'B30','44587499R','Arturo', 'López Soriano','$2y$10$v..F81jgEQi09L9UJktnZep1xqnnGmhbCGoU6gR52FJSIhJbduLPe','no','2020-06-23','2020-05-23');
INSERT INTO cliente VALUES ('82935647N',2,'DC1','66253155G','Javier', 'Áles Soriano','$2y$10$v..F81jgEQi09L9UJktnZep1xqnnGmhbCGoU6gR52FJSIhJbduLPe','no','2021-07-20','2021-06-23');
INSERT INTO cliente VALUES ('44444489Y',4,'DA1','66253155G','Lola', 'Pino Soriano','$2y$10$v..F81jgEQi09L9UJktnZep1xqnnGmhbCGoU6gR52FJSIhJbduLPe','si','2016-07-20','2021-08-25');
INSERT INTO cliente VALUES ('22222222W',2,'DA1','44587499R','Luis', 'Galisteo Soriano','$2y$10$v..F81jgEQi09L9UJktnZep1xqnnGmhbCGoU6gR52FJSIhJbduLPe','no','2016-07-20','2020-04-24');
INSERT INTO cliente VALUES ('66658741W',3,'DC1','88965222T','Ana', 'Moreno Soriano','$2y$10$v..F81jgEQi09L9UJktnZep1xqnnGmhbCGoU6gR52FJSIhJbduLPe','no','2020-07-20','2023-01-23');

INSERT INTO inscrito VALUES (1,'48795684B',80,'2023-05-24');
INSERT INTO inscrito VALUES (2,'44444489Y',500,'2023-04-24');
INSERT INTO inscrito VALUES (3,'22222222W',250,'2023-03-24');
INSERT INTO inscrito VALUES (4,'66658741W',250,'2023-03-23');

INSERT INTO clases VALUES ('B30','12345678R','10:00:00','11:00:00','2024-06-23');
INSERT INTO clases VALUES ('B30','66999877R','10:00:00','11:00:00','2023-06-23');
INSERT INTO clases VALUES ('B30','66999877R','09:00:00','11:00:00','2020-06-23');
INSERT INTO clases VALUES ('DA1','44888877R','09:00:00','11:00:00','2024-06-23');