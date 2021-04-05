# Proyecto Fin Grado
## 1.- Introducción

La propuesta de proyecto consiste en la creación de un portfolio de inversiones digital en el cual se podrán adquirir tanto acciones de bolsa como criptomonedas. El usuario de la aplicación establecerá una cantidad de dinero a modo de ingreso (que podrá aumentar en cualquier momento) y que usará para simular una cartera de inversión en la cual podrá comprar o vender acciones por el valor de mercado que tenga esa acción o esa criptomoneda en ese momento.

Para ayudar al usuario a su decisión de compra, éste podrá crear gráficas con el histórico de precios que el activo que desea adquirir tenía dentro de un intervalo de tiempo que éste elija. Además de eso, el usuario puede consultar el valor de su cartera de inversión, así como el cómputo del beneficio de cada activo adquirido. Los datos del valor de las acciones y criptomonedas se obtendrán de Yahoo Finance mediante web scraping y en la base de datos se guardarán tanto los credenciales de los usuarios como la cantidad de activos valorados a precio de compra y la fecha de la misma. De esta manera se podrá computar el beneficio o pérdida de las operaciones que realice o la valoración de la cartera de inversión a tiempo presente.

Tecnologías usuadas:
Al tratarse de un trabajo de investigación se usarán tecnologías no usadas en clase:
- Backend: Se usará el framework de PHP llamado Laravel.
- Frontend: Se utilizará el framework de Javascript llamado Vue.
- Estilos: Framework de CSS llamado Tailwind.
- Gráficos: Para realizar las gráficas de las acciones se usará d3.js, un framework de Javascript.
- Base de datos: Se empleará la base de datos relacional MariaDB

## 2.- Estudio de Viabilidad

### 2.1.- Descripción del Sistema Actual
### 2.2.- Descripción del Sistema Nuevo
### 2.3.- Identificación de Requisitos del Sistema
#### 2.3.1.- Requisitos de información
#### 2.3.2.- Requisitos funcionales.
* Conexión a base de datos para guardar credenciales de los usuarios y sus carteras de inversión.
* Se contará en todo momento con una conexión a internet que permita la conexión con los datos de Yahoo Finance.
* 
#### 2.3.3.- Otros Requisitos
### 2.4.- Descripción de la solución
### 2.5.- Planificación del proyecto
#### 2.5.1.- Equipo de trabajo
#### 2.5.2.- Planificación temporal
### 2.6.- Estudio del coste del proyecto

## 3.- Análisis del Sistema de Información
### 3.1.- Identificación del entorno tecnológico
Explicar todo el entorno tecnológico, tanto de desarrollo como de explotación del sistema.
### 3.2.- Modelado de datos
Se parte de los requisitos de información recogidos en el Estudio de Viabilidad.
#### 3.2.1.- Modelo Entidad-Relación
Tanto para bases de datos relacionales como no relacionales se deberá realizar un Diagrama E/R.
Se mostrará un volcado gráfico del diagrama realizado con una Herramienta CASE. Se adjuntará
también el archivo correspondiente de la Herramienta CASE utilizada.
#### 3.1.2.- Esquema de la base de datos
En el caso de optar por una base de datos relacional, se adjuntará un archivo sql con el esquema
de la base de datos.
En el caso de bases de datos no relacionales, especificar el diseño de la misma.
#### 3.1.3.- Datos de prueba
Se deberán adjuntar archivos con datos de prueba. Para la generación de datos de prueba se
deberá usar preferentemente algún tipo de herramienta de generación de datos aleatorios.
Ejemplo: https://www.mockaroo.com/
### 3.3.- Identificación de los usuarios participantes y finales
Dar una explicación de cada usuario u otro sistema con el que interactúe la aplicación.
### 3.4.- Identificación de subsistemas de análisis
Dividimos el sistema en partes o subsistemas. Dar una explicación de cada subsistema y mostrar un
diagrama de subsistemas en el que se vea cada usuario (u otro sistema) con qué subsistema interactúa.
### 3.5.- Establecimiento de requisitos
Poner un apartado para cada subsistema identificado anteriormente.
En cada subsistema, poner un apartado para cada requisito funcional identificado en el EVS.
Dar una explicación de cada requisito funcional. Si se considera necesario, adjuntar una especificación del
requisito funcional como Caso de Uso.
### 3.6.- Diagramas de Análisis
Adjuntar los diagramas utilizados en el análisis: diagramas de casos de uso, diagrama de estados,
diagramas de secuencia o interacción, diagramas de clases, tablas de decisión, etc. En este caso serán
siempre volcados gráficos desde una Herramienta CASE.