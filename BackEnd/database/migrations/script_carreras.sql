
-- Ejecutar en terminal php artisan import:script_carreras
-- despues de realizar las migraciones


INSERT INTO carreras (
		nombre, edicion, lugar,
		salida, llegada, desnivel,
		desniveles, fecha,
		fecha_confirmada, servicios,
		info_tecnica, coordenadas,
		inscripcion, precio, web
		)
	VALUES	(
		"Los Montes de Vitoria - irekia", 12, "Araba, Vitoria-Gasteiz", "Ullibarri-Jauregi", "Vitoria-Gasteiz", 62310, '{"subida":2848,"bajada":2968}', "2024-01-01", false, '{"Altura-max":1177,"Tiempo max":"14h","% asfalto":1,"% pista o camino tierra":30,"% senderos":70}', null, null, null, null, "http://www.manueliradier.com/"
		),
		(
		"Speed Trail Monte Naranco", 13, "Asturias, Naranco", null, null, 10000, null, "2024-01-02", false, null, null, '{"latitud":43.36026,"longitud":-5.844759}', null, null, "https://www.clubrunning.es/carrera/?id=16526"
		),
		(
		"La Ronde Solidaire de la St Vincent", 15, "Indre-et-Loire, Amboise ", null, null, 7000, null, "2024-01-06", false, null, null, '{"latitud":47.413326,"longitud":0.984407}', null, null, "http://www.rondesaintvincent.com/"
		),
		(
		"Trail des Castels", 14, "Tarn, Marssac", "Marssac-Sur Tarn", "Marssac-Sur Tarn", 23000, '{"subida":550,"bajada":550}', "2024-01-06", false, '["Servicio de duchas","Servicio de masaje", "Bocadillos o comida a la llegada", "Trofeos", "Sorteo de premios"]', '{"Avituallamientos":1,"% asfalto":20,"% pista o camino tierra":30,"% senderos":30,"% campo a través":30}', '{"latitud":43.915537,"longitud":2.0304370000000063}', null, null, "http://www.rivesdutarnrunning.fr/"
		);
