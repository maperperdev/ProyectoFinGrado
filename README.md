# Proyecto Fin Grado

## 1. Introducción

La propuesta de proyecto consiste en la creación de un portfolio de inversiones digital en el cual se podrán adquirir tanto acciones de bolsa como criptomonedas. El usuario de la aplicación establecerá una cantidad de dinero a modo de ingreso (que podrá aumentar en cualquier momento) y que usará para simular una cartera de inversión en la cual podrá comprar o vender acciones por el valor de mercado que tenga esa acción o esa criptomoneda en ese momento.

Para ayudar al usuario a su decisión de compra, éste podrá crear gráficas con el histórico de precios que el activo que desea adquirir tenía dentro de un intervalo de tiempo que éste elija. Además de eso, el usuario puede consultar el valor de su cartera de inversión, así como el cómputo del beneficio de cada activo adquirido. Los datos del valor de las acciones y criptomonedas se obtendrán de Yahoo Finance mediante web scraping y en la base de datos se guardarán tanto los credenciales de los usuarios como la cantidad de activos valorados a precio de compra y la fecha de la misma. De esta manera se podrá computar el beneficio o pérdida de las operaciones que realice o la valoración de la cartera de inversión a tiempo presente.

Tecnologías usadas:

Al tratarse de un trabajo de investigación se usarán tecnologías no usadas en clase:

- Backend: Se usará el framework de PHP llamado Laravel.
- Frontend: Se utilizará el framework de Javascript llamado Vue.
- Estilos: Framework de CSS llamado Tailwind.
- Gráficos: Para realizar las gráficas de las acciones se usará d3.js, un framework de Javascript.
- Base de datos: Se empleará la base de datos relacional MariaDB.

## 2. Estudio de Viabilidad

Dado que se trata de un proyecto para finalizar los estudios de Grado Superior de Desarrollo de Aplicaciones Web, es importante fijar unas metas razonables debido a que se cuenta con un tiempo determinado.

### 2.1. Descripción del Sistema Actual
El sistema actual consistiría en una pantall de login/registro que sería la pantalla que vería el usuario al conectarse a la aplicación. Si el usuario estuviese registrado, introducirá sus credenciales (email y contraseña) y accederá a la pantalla principal.

Desde esa pantalla principal el usuario podrá acceder al estado de su cuenta, ingresar dinero, comprar activos y consultar la evolución en el tiempo del precio de los activos que tenga en cartera como de los que pretenda seguir o comprar.

El usuario dispondrá de herramientas gráficas para estimar las predicciones en cuanto a valoraciones futuras que podría tener un activo de su interés.

### 2.2. Descripción del Sistema Nuevo

### 2.3. Identificación de Requisitos del Sistema

El primer lugar se requiere de una máquina que actúe como servidor de la aplicación con lo cual necesitará de acceso a internet y que se encargará principalmente de la parte de Bac

#### 2.3.1. Requisitos de información
Los requisitos de información que la aplicación demanda se pueden dividir en dos tipos principalmente atendiendo a la procedencia de los mismos.

Tipos de datos según su procedencia:

* Datos que se le requieren al usuario, es decir sus credenciales, así como el saldo de la cuenta que se utilizará para la compra-venta de activos financieros. 
* Datos que se obtienen de la página web de Yahoo Finance y que no son posibles modificar por parte del usuario. Los principales datos serán el precio de las acciones/criptomonedas y las fechas de estos datos.
* Datos resultantes de las operaciones que el usuario realice. Es decir, el cómputo del resultado de las operaciones en curso, las realizadas anteriormente o también el valor de la cartera de inversión a fecha actual.    


Tipos de datos según su volatilidad o persistencia:
* Los datos persistidos en la base de datos serán aparte de los credenciales de usuarios y los datos referidos a operaciones de compra-venta ya finalizadas.
* Los datos volátiles son aquéllos que se sirven para realizar las gráficas de los valores bursátiles que el usuario quiera consultar y que una vez que se ha acabado la sesión no se podrán recuperar.


#### 2.3.2. Requisitos funcionales.

- Conexión a base de datos para guardar credenciales de los usuarios y sus carteras de inversión.
- Se contará en todo momento con una conexión a internet que permita la conexión con los datos de Yahoo Finance.
- Uso de la librería `d3.js` de Javascript para realizar los gráficos de para la valoración y evolución temporal de los activos.
- Registro de las operaciones financieras realizadas por el usuario, tanto las que estén en curso como las pasads.
- Valoración de la cartera tanto de forma global, como pormenorizada.

<!-- #### 2.3.3. Otros Requisitos -->

### 2.4. Descripción de la solución

Como se ha comentado anteriormente la aplicación propuesta como Proyecto Fin de Ciclo se enmarca en lo que se conoce como "Trabajo de Investigación", ya que se usarán tecnologías no vistas en clase. La aplicación a desarrollar serán una cartera de inversión digital, en la que el usuario hará seguimiento de sus inversiones en valores bursátiles así como en criptomonedas. Para ello, dicho usuario se registrará usando los credenciales típicos de nombre, email, contraseña, etc. Al hacerlo, se le asignará una cuenta de inversión en la que depositará de manera ficticia una cantidad de dinero (que podrá ir variando a lo largo del tiempo) que usará para comprar y vender los productos financieros que se le ofrecen.

Para ayudar a la inversión al usuario, éste contará con la posibilidad de consultar los registros históricos de la inversión que pretenda hacer. Para ello introducirá un intervalo de tiempo para seguir la evolución de la futura inversión entre las dos fechas introducidas.

A la hora de realizar una compra de activos, la cuantía del importe se cargará a la cuenta del usuario, no permitiéndose tener números rojos (números negativos). El usuario introducirá la cantidad de activos que comprará y el precio se determinará obteniéndolo del precio que tenga ese activo en la página Yahoo Finance en ese día. Si por ejemplo debido a la diferencia horaria que pueda haber entre la hora de apertura del mercado bursátil de USA y la zona horaria del usuario en el momento de compra no se tuvieran valores de ese día de esa acción se tomará como precio el precio de cierre del día anterior. En la compra de criptomonedas no es necesario hacer esta consideración.

En el mundo de la inversión bursátil la valoración de los mismos está sujeta a cambios constantes. Con esta aplicación el usuario podrá saber en todo momento cuál es el valor de su cartera de inversión, así como conocer la diferencia de valor entre el precio de compra de las inversiones y su valor actual.

En todo momento el usuario podrá un registro histórico de las operaciones de compra-venta realizadas, así como el resultado de beneficio o pérdida de las mismas.

### 2.5. Planificación del proyecto

La planificación del proyecto viene determinada por la consecución de una serie de objetivos o hitos temporales marcado por los profesores del ciclo. Al ser el espacio temporal de tres meses y tener que compaginar el trabajo en el proyecto con las prácticas de empresa se deberá ajustar muy bien tanto los requisitos de la aplicación como el tiempo dedicado a la misma.

#### 2.5.1. Equipo de trabajo

#### 2.5.2. Planificación temporal

La planificación temporal viene determinada por el centro de estudios y será la siguiente:

### 2.6. Estudio del coste del proyecto

El principal coste del proyecto será el tiempo invertido en el mismo, aunque también podría sumársele el coste de uso de una conexión a Internet, así como el coste en términos de factura eléctrica computables al ordenador utilizado para la realización del proyecto.

## 3. Análisis del Sistema de Información

### 3.1. Identificación del entorno tecnológico

<!--Explicar todo el entorno tecnológico, tanto de desarrollo como de explotación del sistema.-->

Al tratarse de un proyecto de investigación, las tecnologías usadas serán novedosas y requirán de cierto tiempo de aprendizaje para poder implementarlas. Usando la división habitual de "Front-End" y "Back-End" se pasará a comentar de manera pormenorizada las tecnologías que se usarán:

##### 3.1.1 Entorno tecnológico en el lado del cliente (Frontend)

En la capa de presentación se usarán a parte de las tecnologías habituales HTML/CSS/Javascript también se usará un framework de CSS, Tailwind; la librería d3.js y el framework Vue de Javascript, que se pasará a comentar a continuación:


###### Vue 
Vue es un framework de JavaScript. Es de código libre y se usa para desarrollar interfaces web. Vue se centra en la capa de presentación y puede ser integrado sin mayor problema en proyectos grandes sin problemas.

Vue nació como una derivación del framework Angular, del cual el creador del framework, Alan Yu, extrajo sus mejores características. Esto hace que Vue sea un framework fácil de usar e integrar con otras tecnologías.

Sus principales características son:

* Ligero: Vue es un framework muy ligero, su core apenas ocupa 24 KB y conceptualmente se trata de un framework incremental. 

* DOM virtual: Vue usa un DOM virtual que permite que los cambios fruto del uso de la aplicación no sean implementados directamente en el DOM sino en una réplica del mismo. Es decir, se crea una réplica del DOM que contendrá sólamente la estructura del DOM. Los cambios se realizarán en el DOM virtual creado y posteriormente se actulizará el DOM real. Con esto se consigue que los cambios puedan ocurrir más rápido.

* Directivas: VueJS lleva implementadas librerías como v-if, v-else, v-show, v-on, v-bind, y v-model, que son usadas para realizar diferentes modificaciones en el DOM.

* Data Binding: Al igual que en Angular, Vue incorpora esta funcionalidad que permite manipular o asignar valores a los atributos HTML para cambiar el estilo, asignar clases con la ayuda de la directiva  **v-bind**.

* Componentes: Como es habitual en los framework de frontend, Vue también incorpora componentes con el objeto de modularizar la aplicación y hacerla más mantenible y reutilizable.

* "Computed properties": Es una de las propiedades más importante que ofrece Vue. Sirve para ayudar a registrar los cambios que se producen en los elementos de la interfaz sin necesidad de realizar posteriores cálculos.

* Manejo de eventos: Con la directiva **v-on** añadida a los elementos HTML se pueden escuchar los eventos que se produzcan.



###### d3.js 
D3.js es una librería de JavaScript que sirve para producir a partir de datos gráficos dinámicos e interactivos en las páginas webs. Hace uso de tecnologías como SVG, HTML5 y CSS. Es una librería con licencia BSD, es decir, Open Source.

###### Tailwind
Tailwind es un framework de CSS de bajo nivel y altamente configurable. A diferencia de de Bootstrap que ofrece componentes prediseñados, Tailwind, en vez de eso, brida la posibilidad de crear componentes personalizados a través de bloques de construcción que perimiten desarrollar un componente en poco tiempo con un mayor grado de personalización que Bootstrap.

Sus principales características son las siguientes:

* Mayor capacidad de personalización que otros framework, con lo cual se pueden crear diseños únicos.
* Posibilidad de crear sitios webs responsives.
* Está estrito en PostCSS y configurado en JavaScript, por tanto tiene el poder de un lenguaje de programación real.
* Según los ránking es uno de los framework con más alta satisfacción entre usuarios.

##### 3.1.1 Entorno tecnológico en el lado del cliente (Backend)

En el lado del servidor se usará el framework Laravel de PHP, que será la pieza clave de la aplicación, ya que sobre él se integrarán el resto de tecnologías tanto de frontend como de base de datos.

###### Laravel

Es un framework de PHP que usa el patróm MVC (Modelo-Vista-Controlador). Se instala con el gestor de dependencias de PHP llamado Composer.
<!-- https://www.optisolbusiness.com/insight/top-6-features-of-php-laravel-framework -->
Sus características principales son las siguientes:

* Sintaxis elegante y funcional que facilita la legilidad de código.
  Framework ligero que implementa algunas funcionalidades de Symphony y que cuenta con un motor de plantillas propio llamado Blade y además permite incorporar widgets de CSS y Javascript.
* Uso del patrón MVC (modelo-vista-controlador) que permita separa la lógica de negocio y la capa de presentación lo cual lo hace fácilmene escalable.
* Uso del ORM Eloquent que permite usar consultas de SQL pero usando la sintaxis de PHP, mucho más amigable.
* Usa las funciones integradas para manejar el enrutamiento, la administración de usuarios, el almacenamiento en caché y mucho más.
* En cuanto a seguridad, Laravel ofrece el algoritmo Bcrypt para evitar que las contraseñas se guarden en la base de datos como texto plano. Aparte de eso, este framework ofrece consultas preparadas para prevenir los ataques de inyección de SQL.
* Ofrece una herramienta de línea de comandos que automatiza la mayoría de tareas tediosas y repetitivas. Además de eso permite crear la estructura de la base de datos y facilita el manejo de migraciones.
* Laravel viene con librerías preinstaladas que no vienen instaladas en otros Frameworks de PHP como puedan ser las librerías de autentificación, reseteo de contraseñas, protección CSRF (Cross-site Request Forgery) y encriptado.

###### MariaDB
MariaDB es un sistema gestor de bases de datos (SGBD), es decir, un conjunto de programas que permiten modificar, almacenar, y extraer información de una base de datos. MariaDB surge a raíz de la compra, de la compañia desarrolladora de otro (SGBD) llamado MySQL, por la empresa Sun Microsystems. MariaDB es un sistema derivado de MySQL, por lo que en cualquier proyecto donde se use o puede utilizar este sistema de gestión de bases de datos, se podrá utilizar MariaDB. La compatibilidad de los programas es otro punto interesante de MariaDB, ya que aquellos programas que son compatibles con MySQL también serán compatibles con MariaDB. Por ejemplo, es posible utilizar WordPress o Drupal con MariaDB en lugar del sistema tradicional MySQL. En la mayoría de los casos la implementación será muy simple, consistiendo en instalar MariaDB y crear nuevamente las tablas de la base de datos.

Tiene las siguientes características:

* MariaDB es muy rápida a la hora de realizar consultas complejas gracias al uso del motor aria, que utiliza el caché para almacenar las filas de datos, en lugar de escribir en disco. También se han eliminado conversiones innecesarias de juegos de caracteres que consiguió incrementar su velocidad entre el 1 y el 5 %. Con estas y otras características se puede decir que MariaDB es un sistema rápido.

* Se han añadido diversas extensiones a MariaDB que le proporcionan mejoras y nuevas funcionalidades, como la posibilidad de manejar hasta 32 segmentos clave por clave (duplicando la capacidad inicial), uso de columnas virtuales, posibilidad de incluir un sistema de autenticación, selección del motor de almacenamiento al crear una tabla, caché de claves segmentadas o incremento de la precisión en la lista de procesos (en microsegundos), entre otras mejoras.

* El soporte disponible de MariaDB es muy extenso. Se puede acceder a toda la información que se necesita para utilizar este gestor de bases de datos desde su documentación oficial. La comunidad alrededor de este proyecto es muy amplia y muy activa, por lo que es fácil hallar soluciones a cualquier problema o incidencia, o encontrar cómo realizar procesos o configuraciones avanzadas. 

* MariaDB se distribuye bajo la licencia GPL, por lo que se trata de un sistema de software libre que puede utilizarse de manera gratuita en cualquier proyecto.


### 3.2. Modelado de datos
Se usará un modelo de base de datos relacional en la cual existirán cuatro tablas:
* Tabla user: Se guardan los datos de los usuarios y tendrá los siguientes campos:
  * id_user
  * user_name
  * email
  * password
  * money_account
  * id_account

La clave primaria de esta tabla es id_user y en ella se importa una clave foránea perteneciente a la tabla account (id_account).


* Tabla account: En ella irán alojados los campos relativos a las operaciones financieras en curso.
  * id_account
  * asset_symbol
  * purchase_price
  * quantity
  * purchase_date

La clave primaria de esta tabla es id_account y se exportará a la tabla user. Tendrá un tipo de relación de uno a uno.

* Tabla historic_operations: En ella irán alojados los campos relativos a las operaciones financieras finalizadas. 
  * id_account
  * asset_symbol
  * purchase_price
  * quantity
  * purchase_date
  * selling_price
  * selling_date

Esta tabla es una copia de la account que recoje las operaciones finalizadas a modo de registro histórico de las mismas. Tiene los mismos campos que la tabla account más los campos selling_price (precio de venta) y selling_date (fecha de venta). 

* Tabla stock_symbol_name:
  * stock_symbol
  * stock_name

En esta última tabla se recojen los nombres y símbolos de las acciones que el usuario puede comprar. 

* Tabla crypto_symbol_name:
  * crypto_symbol
  * crypto_name

En esta última tabla se recojen los nombres y símbolos de la cotización de las criptomonedas en dólares. 


<!-- Se parte de los requisitos de información recogidos en el Estudio de Viabilidad. -->

 #### 3.2.1. Modelo Entidad-Relación


<!-- Tanto para bases de datos relacionales como no relacionales se deberá realizar un Diagrama E/R. -->
<!-- Se mostrará un volcado gráfico del diagrama realizado con una Herramienta CASE. Se adjuntará también el archivo correspondiente de la Herramienta CASE utilizada. -->

#### 3.1.2. Esquema de la base de datos
<!-- En el caso de optar por una base de datos relacional, se adjuntará un archivo sql con el esquema de la base de datos. -->
<!-- En el caso de bases de datos no relacionales, especificar el diseño de la misma. -->

#### 3.1.3. Datos de prueba
<!-- Se deberán adjuntar archivos con datos de prueba. Para la generación de datos de prueba se deberá usar preferentemente algún tipo de herramienta de generación de datos aleatorios. -->
<!-- Ejemplo: https://www.mockaroo.com/ -->

### 3.3. Identificación de los usuarios participantes y finales
<!-- Dar una explicación de cada usuario u otro sistema con el que interactúe la aplicación. -->
Los usuarios que participarán serán únicamente usuarios finales. No se prevé tener un administrador que gestione los datos, ya que se trata de una aplicación destinada a la inversión personal para que el usuario pueda seguir la evolución de su cartera de inversión a lo largo del tiempo.

### 3.4. Identificación de subsistemas de análisis
<!-- Dividimos el sistema en partes o subsistemas. Dar una explicación de cada subsistema y mostrar un diagrama de subsistemas en el que se vea cada usuario (u otro sistema) con qué subsistema interactúa. -->

### 3.5. Establecimiento de requisitos
<!-- Poner un apartado para cada subsistema identificado anteriormente. -->
<!-- En cada subsistema, poner un apartado para cada requisito funcional identificado en el EVS. -->
<!-- Dar una explicación de cada requisito funcional. Si se considera necesario, adjuntar una especificación del requisito funcional como Caso de Uso. -->

### 3.6. Diagramas de Análisis
<!-- Adjuntar los diagramas utilizados en el análisis: diagramas de casos de uso, diagrama de estados, diagramas de secuencia o interacción, diagramas de clases, tablas de decisión, etc. En este caso serán siempre volcados gráficos desde una Herramienta CASE. -->