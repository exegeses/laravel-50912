# Peticiones

> El primer concepto que debemos tener en cuenta es el de **peticiones**: le vamos hacer una petición a nuestra aplicación y esta nos va a responder con un recurso. 

<img src="imagenes/FrontController.png">

> El recurso puede ser una vista generalmente, aunque podemos obtener otro tipo de recursos. 

> El segundo concepto es el del Enrutador, técnicamente este es el proveedor del servicio de peticiones. 
> Cuando hacemos una petición esta es recibida por el enrutador que se encargará de; según la peticion, ejecutar una acción y luego responder con un recurso.

<img src="imagenes/peticiones.png">

> La sintáxis es: 

    Route::metodo( 'petición', acción );


----
## Circuito

  1- Relizar una petición    
        a través de un enlace <a href="/adminRegiones">Enlace</a>
        pegando a una url /adminRegiones    
  2- La petición es recibida por el ENRUTADOR y según esta peticion, va a realizar una acción

        Route::metodo( 'petición', acción );

        Route::get('/agregarRegion', acción );
        Route::get('/modificarRegion/{dato}', acción );
