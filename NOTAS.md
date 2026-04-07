## Flujo de un HTTP Request en Laravel

Cuando el usuario presiona ENTER el request viaja hasta
index.php donde captura al request y lo redirecciona a app.php.

En este punto app.php envia el request por tres caminos, a web, command y health. Aquí pasa por el HTTP Kernel, donde se ejecuta en un programa de arranque seguro, donde el app.php envia la aplicación configurada.

Una vez en web.php, el sistema recibe la aplicación y redirige a los controladores, donde se ejectuan funciones de validación y redireccionamiento tras recibir la solicitud. 
Finalmente, se envia a una vista en la carpeta View.

## Middleware
Lo que hace es brindar un mecanismo, donde antes de recibir el http request, verifica que estemos logeados, y si no lo estamos nos manda a la pagina de register, brindando seguridad.

## Separation of Concerns
Esto es algo como una separación de áreas, lo que nos recomienda este principio de arquitectura es que mientras mas abstractos esten los conceptos mas separadas estaran las áreas, por ejemplo, a la hora de crear un sistema donde tengamos un área de envios, donde se recibe el pedido, se envia la solicitud a los cocineros, y ademas se asigna un repartidor, es mejor tener un área que haga cada una de las cosas por separado que tenerlas juntas, lo que mejora el mantenimiento, y escalabilidad de un sistema.

## don't repeat yourself
Nos dice que para hacer nuestro código mas rapido, y mantenible, es mejor no repetir la misma logica en varias partes dentro del sistema, lo cual mejora el rendimiento y mantenimiento de nuestro sistema. Por ejemplo; En este sistema tuve un problema, porque yo creía que para mostrar una lista de categorias dentro de la pagina de creacion de transacciones debia retornar el index del controlador de categorias a la pagina de creaciones.

## Mass Assignament Protection
Es un protocolo de proteccion frente a problemas de seguridad con los http request. El problema que resuelve es; cuando un usuario con malas intenciones, hace un http request o envia un formulario con muchisimos datos buscando asignar masivamente datos, este protocolo lo bloquea. Es por ello que usamos $fillable, para permitir que datos si recibiran una asignacion masiva de parte de usuarios.

## Form Request
Es una manera de proteger a mayor escala los datos, y asegurarnos de recibir los correctos.
Utiliza un rule y un authorize, el rule propone reglas como en una query de MySQL. Y authorize verifica que el usuario esté correctamente logeado. 
En nuestro caso usamos esto para separar la funcion store dentro del controlador para cumplir con el principio de arquitectura SoC.

## Ownership Validation
Lo que significa es que el usuario logeado solo pueda crear, ver, editar y borrar datos que el mismo ha creado.
Esto ayuda a la seguridad y fiabilidad del sistema.

## Service Layer
Hace que un sistema sea mas organizado, también usa el principio de SoC, porque por ejemplo, no podemos poner la lógica de un saldo final, porque ocasionaria que al momento de querer migrar a celulares usemos API, lo cual nos afectaria, porque si lo hacemos en el controller devolvemos vistas, pero si lo hacemos desde el service Layer devolvemos datos json. Por ejemplo, en un controlador. Ademas esto hace que nuestro sistema no sea tan escalable, ya que al querer usar API, vamos a tener fallas. 

## Conventional Commit
Lo usé para mejorar mi escritura de commmits, ya que he visto que es una forma convencional de escribirlos, por lo que lo implemente buscando practicar para que a futuro los mensajes sean clartos para quienes sean mis compañeros de trabajos y para entender yo mismo mis propios commits.

## Route Model Binding
Usa el id que viene desde el URL, lo recibe y lo busca en la base de datos, si no lo encuentra manda un 404.
El problema que resuelve es cuando un usuario desea modificar los datos 
En el proyecto se uso para la edicion tanto de categorias y de transacciones.

## try/catch
try / catch captura los errores a la hora de la ejecucion. 

## Flash Messages
Son mensajes que podemos enviar al usuario al concretar una tarea o cuando el usuario intenta hacer algo que no está permitido como intentar usar letras en "monto", en nuestro proyecto.

## Datos estáticos vs dinámicos en Blade
Los datos estáticos como por ejemplo los datos de tipo "type" que solo pueden ser dos "expenses" o "incomes", y luego los datos dinamicos que son traidos desde una base de datos y mostrados, como por ejemplo las categorias, que mostramos una y cada una de las creadas por el usuario a la hora de crear una nueva transaccion.

## Null Coalescing Operator (??)
Este operador resultó muy util en un momento, por ejemplo, mediante el route model binding, en el request de categorias, cuando queriamos editar teniamos una alternativa que ignoraba si el id mostrado en el URL era el mismo que estabamos modificando, y sino le mandabamos un id 0 que mostraba error.

## @selected en Blade
La funcion que le encontramos es la siguiente: El usuario a la hora de editar necesita ver sus selecciones recientes, permite una mejor experiencia para el usuario, evita confusiones, en fin es un poco de UX. Ahora, nosotros lo implementamos para categorias y tipos de transacciones. Entendi que es importante que el usuario observe las categorias que tuvo previamente seleccionada porque de este modo no se confunde, una confusion de categorias, cuando tengamos el sistema terminado, puede llegar a modificar lo que el usuario ve en sus finanzas. Lo mismo sucederia con los tipos de transaccion pero un poco peor, porque esto modifica el desglose de los gastos del usuario.

## Eloquent Scopes

Estos lo añadimos pero no lo implementamos, porque es una forma facil de acceder a los datos de manera mas eficaz. Por ejemplo, en vez de hacer "$transacciones->$types->'income'", hacemos "$transacciones->incomes()"

## Eloquent Accessors

A los Accessors lo usamos principalmente para mejorar la experiencia de usuario, porque el usuario normalmente veia 'expenses' cuando el seleccionaba 'Gastos', pero ahora ve 'Gastos'. Creo que en sistemas de finanzas es imprescindible la correcta interpretacion, ya que un mal movimiento puede alterar el conocimiento propio de los gastos, y hacer que una herramienta se vuelva un problema.

## Mutators
A mutators lo usamos para guardar en la base de datos los valores de manera correcta, por ejemplo, a la hora de recibir un numero de telefono debemos quitarle los espacios o giuones que a veces suelen poner los usuarios. utilizamos el set() con la misma logica que el get pero con distinta funcion y direccion 

## API REST vs Vistas HTML
El api REST lo que hace es, segun los datos que recibimos en forma de json lo procesa y lo podemos usar como queramos y donde queramos, en cambio las vistas html, solo pueden ser mostrada en una web.

## Autenticación por tokens vs sesiones
Autenticar por tokens significa que el sistema busca en sus funciones, en el caso de laravel usa API Tokens, crea un token unico para cada usuario registrado, este puede durar años. Por otro lado autenticarse por sesiones significa que una vez que el usuario se registra se le asigna un id unico tambien, pero este es recuperado por las cookies del navegador en vez de ser recuperadas por la base de datos,

## Sanctum y HasApiTokens
Sanctum nos brinda la posibilidad de autenticar de dos maneras mdiante tokens API Tokens y mediante sesiones con SPA Authentication, API tokens maneja la autenticacion mediante tokens, lo que significa que el sistema crea un token unico. Y SPA crea una autenticacion utilizando datos de sesiones previas que son creados al registrarse dentro del navegador, como las cookies.
HasApiTokens es un trait que nos brinda herramientas para usar tokens, una de ellas es crearlo, tambien con HasApiTokens podemos cambiar el cifrado del Token y pasarlo a texto plano mediante plainTextToken, que proviene de NewAccessToken. De este modo podemos mostrarle al usuario su token luego de ser creado. Ademas podemos iterar con este token mediante la herramienta tokens proveniente de HasApiTokens. 

## Bearer Token en headers
Lo que hace esto es recibir el request, y como está en el header por preferencia de que alli los datos se manejan mas rapidos y son mas seguros. Lo recibe el Authenticator, antes de que vaya a la base de datos, luego lo compara con los datos del usuario, con el token de la base de datos, y verifica si está vencido o no existe, si existe pasa al transaction controller donde guarda los datos.

## Api/TransactionController separado
En esta carpeta se traen todos los datos que provienen del resourse,que es donde traemos los archivos de la base sde datos y los transformamos en un array, y en el TransactionController de la carpeta API, lo modificamos y lo convertimos a un JSON.

## routes/api.php y apiResource
api.php funciona casi de la misma forma que web.php, se usa para cumplir con la definicion de arquitectura de software SoC, su uso es para tomar los datos del usuario verificado, ya mediante Sanctum, y luego enviarlo a el controlador de las API.
apiResource nos ayuda a que laravel cree las rutas para el sistema CRUD y que las conecte finalmente con el controlador.

## API Resources (TransactionResource)
Aqui en transaction Resouse lo que hacemos es transformar los datos que necesitemos y que sean necesarios y seguros, transformarlos a un ARRAY para luego ser transformado en una API.

## collection() vs recurso individual
Collection lo que hace, a diferencia de traer un solo elemento para usarlo en una funcion como por ejemplo show(), es que ensambla los datos tipo array en una coleccion de datos tipo json. Pasa dato por dato por el TransactionResourse para formatearlo identicamente y lo envuelve en una respuesta json

## $this dentro de un Resource

Dentro de un Resource el uso de $this es para indicar el objeto de dicha clase de la que se esta usando, osea si tenemos una clase llamada trabajo, y un objeto que tiene como atributo un nombre, para llamar a ese nombre usamos $this. En el caso de Resourse lo usamos para traer los datos, renombrarlo y devolverlo como array.

## response()
Usamos reponse porque nos sirve para personalizar los HTTP codes.

#### HTTP CODE: 200
Significa que salió bien la operacion, pero depende mucho del tipo, por ejemplo para un GET significa que se mostró correctamente en el body.
En el Put o POST significa que envia el resultado de la accion segun sea el caso

#### HTTP CODE: 201
Significa que fue correctamente creado

#### HTTP CODE: 204
Significa que se ha borrado correctamente y que no hay nada para mostrar 

## Thunder Client
Lo utilizamos para probar el estado de las nuevas funciones API, según lo probado, se trata de una herramienta util para el testeo permite utilizar datos personalizados, lo cual me parece genial porque no hace falta hacer una inyeccion de datos, sino solo poner datos temporales para el test. Ademas permite usar varias acciones como PUT, POST, GET, DELETE, PATCH, por lo tanto a mi parecer es muy util para proyectos a futuro con datos API.

## new Objet
Es una instancia, crea un objeto en la memoria PHP pero no lo registra en la BD.

## ->names()
Esta funcion hace que cuando queremos anteponer un nombre antes de una ruta, por ejemplo, en nuestro caso usamos api.transactions, esto nos sirvio para arreglar un error con las rutas, al tener un controlador que recibian las mismas transacciones, se sobrescribio la ruta original por la del api, por lo tanto, nos enviaba a una ruta sin vista. Lo solucionamos añadiendo la funcion ->name('api.') en el api.php.

## Testing
Sirve para realizar tests de funciones como store, update o destroy, que son escenciales a la hora de usar un sistema. Usamos este tipo de testing automatizado para no crear uno por uno la carga de datos y usar funciones provenientes de laravel para simular entornos falsos para mejorar el testeo.

## Pest
Es un framework que nos facilita la realizacion de un test. En el caso del proyecto lo usaremos para hacer un test del store, update y destroy por ahora. 
La estructura convencional es la siguiente test(parametro 1, parametro 2), en el parametro 1 recibe en forma de string el nombre del test, como parametro dos recibe una funcion, dicha funcion debe crear elementos falsos para finalmente hacer el test, en nuestro caso creamos un usuario falso, y una categoria falsa, con ello pudimos testear y verificar que todo este bien, finalmente retornar algun tipo de mensaje segun la operacion, en el caso del test usamos el http code 201.

## actingAs()
Este sirve para, cuando creamos un usuario falso, interactuar en el test mediante dicho usuario falso.

## postJson
Sirve para inyectar valores tipo JSON en el test, recibe dos parametros.
postJson(p1,p2), el p1 es la ruta de donde proviene el modelo a simular. Nosotros usamos 'api/transactions', y el p2 son los datos.

## assertStatus
Sirve para poner un http code como predeterminado en la operacion, es decir, en el caso del store usamos un 201.

## ¿Porque un test debe ser autosuficiente?
En mi test tuve un error y es que al principio a la hora de crear una transaccion apunté a una categoria con su id en especifico, pero esto no es valido, porque cuando un tercero desee testear va a intentar correr el test y le va a dar error, y es porque mi bd no es la misma bd que su usuario.
Por lo tanto lo solucionamos creando una categoria dentro del test. De esta manera el test depende simple y llanamente de si mismo, lo que lo hace autosuficiente.
