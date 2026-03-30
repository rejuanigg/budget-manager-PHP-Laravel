##Flujo de un HTTP Request en Laravel

Cuando el usuario presiona ENTER el request viaja hasta
index.php donde captura al request y lo redirecciona a app.php.

En este punto app.php envia el request por tres caminos, a web, command y health. Aquí pasa por el HTTP Kernel, donde se ejecuta en un programa de arranque seguro, donde el app.php envia la aplicación configurada.

Una vez en web.php, el sistema recibe la aplicación y redirige a los controladores, donde se ejectuan funciones de validación y redireccionamiento tras recibir la solicitud. 
Finalmente, se envia a una vista en la carpeta View.

##Middleware
Lo que hace es brindar un mecanismo, donde antes de recibir el http request, verifica que estemos logeados, y si no lo estamos nos manda a la pagina de register, brindando seguridad.

##Separation of Concerns
Esto es algo como una separación de áreas, lo que nos recomienda este principio de arquitectura es que mientras mas abstractos esten los conceptos mas separadas estaran las áreas, por ejemplo, a la hora de crear un sistema donde tengamos un área de envios, donde se recibe el pedido, se envia la solicitud a los cocineros, y ademas se asigna un repartidor, es mejor tener un área que haga cada una de las cosas por separado que tenerlas juntas, lo que mejora el mantenimiento, y escalabilidad de un sistema.

##don't repeat yourself
Nos dice que para hacer nuestro código mas rapido, y mantenible, es mejor no repetir la misma logica en varias partes dentro del sistema, lo cual mejora el rendimiento y mantenimiento de nuestro sistema. Por ejemplo; En este sistema tuve un problema, porque yo creía que para mostrar una lista de categorias dentro de la pagina de creacion de transacciones debia retornar el index del controlador de categorias a la pagina de creaciones.

##Mass Assignament Protection
Es un protocolo de proteccion frente a problemas de seguridad con los http request. El problema que resuelve es; cuando un usuario con malas intenciones, hace un http request o envia un formulario con muchisimos datos buscando asignar masivamente datos, este protocolo lo bloquea. Es por ello que usamos $fillable, para permitir que datos si recibiran una asignacion masiva de parte de usuarios.

##Form Request
Es una manera de proteger a mayor escala los datos, y asegurarnos de recibir los correctos.
Utiliza un rule y un authorize, el rule propone reglas como en una query de MySQL. Y authorize verifica que el usuario esté correctamente logeado. 
En nuestro caso usamos esto para separar la funcion store dentro del controlador para cumplir con el principio de arquitectura SoC.

##Ownership Validation
Lo que significa es que el usuario logeado solo pueda crear, ver, editar y borrar datos que el mismo ha creado.
Esto ayuda a la seguridad y fiabilidad del sistema.

##Service Layer
Hace que un sistema sea mas organizado, también usa el principio de SoC, porque por ejemplo, no podemos poner la lógica de un saldo final, porque ocasionaria que al momento de querer migrar a celulares usemos API, lo cual nos afectaria, porque si lo hacemos en el controller devolvemos vistas, pero si lo hacemos desde el service Layer devolvemos datos json. Por ejemplo, en un controlador. Ademas esto hace que nuestro sistema no sea tan escalable, ya que al querer usar API, vamos a tener fallas. 

##Conventional Commit
Lo usé para mejorar mi escritura de commmits, ya que he visto que es una forma convencional de escribirlos, por lo que lo implemente buscando practicar para que a futuro los mensajes sean clartos para quienes sean mis compañeros de trabajos y para entender yo mismo mis propios commits.
