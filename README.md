# Proyecto Fin Grado

## 1. Introducción

La propuesta de proyecto consiste en la creación de un portfolio de inversiones digital en el cual se podrán adquirir tanto acciones de bolsa como criptomonedas. El usuario de la aplicación establecerá una cantidad de dinero a modo de ingreso (que podrá aumentar en cualquier momento) y que usará para simular una cartera de inversión en la cual podrá comprar o vender acciones por el valor de mercado que tenga esa acción o esa criptomoneda en ese momento.

Para ayudar al usuario a su decisión de compra, éste podrá crear gráficas con el histórico de precios que el activo que desea adquirir tenía dentro de un intervalo de tiempo que éste elija. Además de eso, el usuario puede consultar el valor de su cartera de inversión, así como el cómputo del beneficio de cada activo adquirido. Los datos del valor de las acciones y criptomonedas se obtendrán de Yahoo Finance mediante web scraping y en la base de datos se guardarán tanto los credenciales de los usuarios como la cantidad de activos valorados a precio de compra y la fecha de la misma. De esta manera se podrá computar el beneficio o pérdida de las operaciones que realice o la valoración de la cartera de inversión a tiempo presente.

Tecnologías usuadas:

Al tratarse de un trabajo de investigación se usarán tecnologías no usadas en clase:

- Backend: Se usará el framework de PHP llamado Laravel.
- Frontend: Se utilizará el framework de Javascript llamado Vue.
- Estilos: Framework de CSS llamado Tailwind.
- Gráficos: Para realizar las gráficas de las acciones se usará d3.js, un framework de Javascript.
- Base de datos: Se empleará la base de datos relacional MariaDB

## 2. Estudio de Viabilidad

Dado que se trata de un proyecto para finalizar los estudios de Grado Superior de Desarrollo de Aplicaciones Web, es importante fijar unas metas razonables debido a que se cuenta con un tiempo determinado.

### 2.1. Descripción del Sistema Actual

### 2.2. Descripción del Sistema Nuevo

### 2.3. Identificación de Requisitos del Sistema

El primer lugar se requiere de una máquina que actúe como servidor de la aplicación y que se encargará principalmente de la parte de Bac

#### 2.3.1. Requisitos de información

#### 2.3.2. Requisitos funcionales.

- Conexión a base de datos para guardar credenciales de los usuarios y sus carteras de inversión.
- Se contará en todo momento con una conexión a internet que permita la conexión con los datos de Yahoo Finance.
- Uso de la librería `d3.js` de Javascript para realizar los gráficos de para la valoración y evolución temporal de los activos.
- Registro de las operaciones financieras realizadas por el usuario, tanto las que estén en curso como las pasads.
- Valoración de la cartera tanto de forma global, como pormenorizada.

#### 2.3.3. Otros Requisitos

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

##### 3.1.1 Entorno tecnológico en el lado del cliente (Backend)

En el lado del servidor se usará el framework Laravel de PHP, que será la pieza clave de la aplicación, ya que sobre él se integrarán el resto de tecnologías tanto de frontend como de base de datos.

#### Laravel

Es un framework de PHP que usa el patróm MVC (Modelo-Vista-Controlador). Se instala con el gestor de dependencias de PHP llamado Composer.
<!-- https://www.optisolbusiness.com/insight/top-6-features-of-php-laravel-framework -->
Sus características principales son las siguientes:

- Sintaxis elegante y funcional que facilita la legilidad de código.
  Framework ligero que implementa algunas funcionalidades de Symphony y que cuenta con un motor de plantillas propio llamado Blade y además permite incorporar widgets de CSS y Javascript.
- Uso del patrón MVC (modelo-vista-controlador) que permita separa la lógica de negocio y la capa de presentación lo cual lo hace fácilmene escalable.
- Uso del ORM Eloquent que permite usar consultas de SQL pero usando la sintaxis de PHP, mucho más amigable.
- Usa las funciones integradas para manejar el enrutamiento, la administración de usuarios, el almacenamiento en caché y mucho más.
- En cuanto a seguridad...
### 3.2. Modelado de datos

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

### 3.4. Identificación de subsistemas de análisis

<!-- Dividimos el sistema en partes o subsistemas. Dar una explicación de cada subsistema y mostrar un diagrama de subsistemas en el que se vea cada usuario (u otro sistema) con qué subsistema interactúa. -->

### 3.5. Establecimiento de requisitos

<!-- Poner un apartado para cada subsistema identificado anteriormente. -->
<!-- En cada subsistema, poner un apartado para cada requisito funcional identificado en el EVS. -->
<!-- Dar una explicación de cada requisito funcional. Si se considera necesario, adjuntar una especificación del requisito funcional como Caso de Uso. -->

### 3.6. Diagramas de Análisis

<!-- Adjuntar los diagramas utilizados en el análisis: diagramas de casos de uso, diagrama de estados, diagramas de secuencia o interacción, diagramas de clases, tablas de decisión, etc. En este caso serán siempre volcados gráficos desde una Herramienta CASE. -->
