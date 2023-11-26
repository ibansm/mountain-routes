
-- Datos reales sacados de https://runedia.mundodeportivo.com/

-- EJECUCION (DESPUES DE REALIZAR LAS MIGRACIONES)
-- php artisan import:script_carreras


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
		),
		(
		"Sant Mateu Xtrail 25k", 11, "Barelona, Premià de Dalt ", "Riera de Sant Pere 147, Premia de Dalt, Societat Sant Jaume", "Riera de Sant Pere 147, Premia de Dalt, Societat Sant Jaume", 25000, '{"subida":600,"bajada":"-"}', "2024-01-09", true, '["Servicio guardarropa","Prueba cronometrada con chip", "Bocadillos o comida a la llegada", "Servicio de duchas"]', '{"Altura max.":500,"Tiempo max.":"2h30","Avituallamientos":4,"% asfalto":2,"% pista o camino tierra":5,"% senderos":93}', null, null, null, "http://www.stmateuxtrail.com/"
		),
		(
		"Les Deux Alpes Night Snow Trail :5, 10,15 et 20 km", 33, "Isère, Les Deux Alpes ", null, null, 20000, '{"subida":600,"bajada":"-"}', "2024-01-13", false, null, null, '{"latitud":45.012284,"longitud":6.124414}', null, null, "http://www.les2alpes.com/"
		),
		(
		"Nájera Xtrem Cuna de Reyes - corta", 13, "La Rioja, Nájera", null, null, 11000, null, "2024-03-01", false, null, null, '{"latitud":42.417368,"longitud":-2.733225}', null, null, "https://clubdemontanak2.blogspot.com/2023/02/ya-tenemos-el-nuevo-cartel-de-la-najera.html"
		),
		(
		"Ultra Fiord 16K", 8, "Torres del Paine", null, null, 16000, '{"subida":950,"bajada":"-"}', "2024-02-03", true, '["Servicio guardarropa","Prueba cronometrada con chip", "Bocadillos o comida a la llegada"]', null, null, null, null, "https://www.ultrafiord.com/es/"
		),
		(
		"Express Trail Cap de Creus", 13, "Girona, Roses", "Roses", "Roses", 12000, '{"subida":600,"bajada":600}', "2024-03-09", true, '["Servicio guardarropa","Prueba cronometrada con chip", "Bocadillos o comida a la llegada", "Servicio de masaje", "Trofeo a los ganadores"]', '{"Altura max.":470,"Tiempo max.":"4h","Avituallamientos":1,"% asfalto":10,"% pista o camino tierra":5,"% senderos":85}', '{"latitud":42.26430367,"longitud":3.173959851}', null, 50.00, "https://www.klassmark.com/trailcapdecreus/"
		),
		(
		"Camí dels ibers Marató ", 11, "Barcelona, La Roca del Vallès", "Plaça de Can Torrents", "Plaça de Can Torrents", 42000, '{"subida":1300,"bajada":1300}', "2024-03-17", true, '["Servicio guardarropa","Prueba cronometrada con chip", "Carrera infantil", "Bocadillos o comida a la llegada", "Servicio de masaje", "Trofeo a los ganadores", "Sorteo de premios"]', '{"Altura max.":520,"Tiempo max.":"5h30","Avituallamientos":13,"% asfalto":1,"% pista o camino tierra":7,"% senderos":92}', '{"latitud":41.587174,"longitud":2.325998}', 300, 28.00, "http://www.elsibers.cat/inscripcions/"
		),
		(
		"Trail del Serrucho ", 11, "Madrid, Alalpardo", "Plaza de Toros de Alalpardo", "Plaza de Toros de Alalpardo", 14200, '{"subida":240,"bajada":240}', "2024-01-14", true, '["Servicio guardarropa","Prueba cronometrada con chip", "Carrera infantil", "Bocadillos o comida a la llegada", "Servicio de masaje", "Trofeo a los ganadores", "Sorteo de premios"]', '{"Altura max.":789,"Tiempo max.":"2h","Avituallamientos":5,"% asfalto":5,"% pista o camino tierra":5,"% senderos":90}', '{"latitud":40.62859500784598,"longitud":-3.4727277073887217}', 800, 16.00, "https://inscripcionesdeportivas.timinglap.com/inscripcion/trail-del-serrucho-11/"
		);
