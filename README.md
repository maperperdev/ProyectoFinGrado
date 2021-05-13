##Instrucciones para la instalación:
* Clonar/descargar el repositorio: `git clone https://github.com/maperperdev/ProyectoFinGrado.git`
* Instalar PHP: `<sudo apt install libapache2-mod-php php php-common php-xml php-gd php-opcache php-mbstring php-tokenizer php-json php-bcmath php-zip unzip`
* Instalar composer: `curl -sS https://getcomposer.org/installer | php sudo mv composer.phar /usr/local/bin/composer`.
* Editar el fichero ~/bashrc agregando la siguiente línea: `export PATH="$HOME/.config/composer/vendor/bin:$PATH"`.
* Actualizar el archivo de las variables de entorno: 
	* `source ~/.bashrc`
	* `echo $PATH`
* Entrar en la carpeta del proyecto: `cd ProyectoFinGrado`.
* Ejecutar `composer install`.
* Ejecutar `npm install` para instalar las dependencias de Vue y Tailwindcss.
* Generar la clave: `php artisan generate:key`
* Editar el fichero `.env.example` con el nombre de la base de datos y los datos de conexión.
* Renombrar este archivo a `.env`
* Lanzar la aplicación con `php artisan serve`.
