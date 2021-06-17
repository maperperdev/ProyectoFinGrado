## Instrucciones para la instalación:
* Instalar PHP: `sudo apt install libapache2-mod-php php php-common php-xml php-gd php-opcache php-mbstring php-tokenizer php-json php-bcmath php-zip unzip php-mbstring php-gd php-json php-curl php-xml`
* Habilitar a2enmod:  `sudo a2enmod php7.4`
* Instalar MariaDB: `sudo apt install mariadb-server mariadb-client`
* Ejecutar MariaDB: `sudo mysql`.
* Crear usuario y base de datos:
`CREATE USER usuario IDENTIFIED BY 'usuario';`
`GRANT ALL PRIVILEGES ON *.* TO 'usuario' WITH GRANT OPTION;`
`create database portfolio;`
* Clonar/descargar el repositorio: `git clone https://github.com/maperperdev/ProyectoFinGrado.git`
* Instalar composer: `curl -sS https://getcomposer.org/installer | php sudo mv composer.phar /usr/local/bin/composer`.
* Editar el fichero ~/bashrc agregando la siguiente línea: `export PATH="$HOME/.config/composer/vendor/bin:$PATH"`.
* Actualizar el archivo de las variables de entorno: 
	* `source ~/.bashrc`
	* `echo $PATH`
* Entrar en la carpeta del proyecto: `cd ProyectoFinGrado`.
* Editar el fichero `.env.example` con el nombre de la base de datos y los datos de conexión.
* Renombrar este archivo a `.env`
* Ejecutar `composer install`.
* Generar la clave: `php artisan generate:key`
* Crear una base de datos con el nombre portfolio.
* Crear un usuario con permisos de admin para dicha base de datos, que será el que coloquemos en el archivo .env.
* Editar las variables de entorno recogidas en el archivo .env, como pueden ser el nombre de la base de datos y el usuario
con el que se conecta.
* Ejecutar el comando `php artisan migrate` para efectuar la migración de la base de datos. Es decir, creará la estructura de tablas que tiene la aplicación
* Cargar los datos en la base de datos `sudo mysql -u USERNAME -p DATABASE < assets_data.sql`.
* Ejecutar `npm install` para instalar las dependencias de Vue y Tailwindcss.
* Ejecutar `npm run dev` y después `npm run prod`.
* Lanzar la aplicación con `php artisan serve`.

## Instrucciones para un despliegue en servidor Apache
* Mover el proyecto a la carpeta /var/www/html: `sudo mv ProyectoFinGrado /var/www/html`.
* Cambiar el directorio de trabajo a /var/www/html: `cd /var/www/html` 
* Cambiar el propietario de la carpeta del proyecto por el usuario de Apache: `sudo chown -R www-data:www-data ProyectoFinGrado`
* Dar los siguientes permisos a la aplicación `sudo chmod -R 755 ProyectoFinGrado`.
* Borrar archivo index.html `sudo rm index.html`.
* Habilitar el módulo de Apache a2enmod: `sudo a2enmod rewrite`
* Cambiar directorio de trabajo a /etc/apache2/sites-available/ `cd /etc/apache2/sites-available/`
* Crear archivo de configuración de la app `sudo nano portfolio.conf`
* Editar el archivo con la siguiente configuración:
```
<VirtualHost *:80>
    DocumentRoot /var/www/html/ProyectoFinGrado/public/
    ServerName portfolio-digital.app
    ServerAlias *.portfolio-digital.app

    <Directory /var/www/html/ProyectoFinGrado/public/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

```
* Habilitar la nueva configuración: `sudo a2ensite portfolio.conf`
* Reiniciar Apache: `sudo systemctl reload apache2.service`
* Deshabilitar configuración por defecto: `sudo a2dissite 000-default.conf ` 
* Reiniciar Apache: `sudo systemctl reload apache2.service`
* Poner la ip de la máquina el en navegador y se ejecutará la aplicación si todo ha ido bien.