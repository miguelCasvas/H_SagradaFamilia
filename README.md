** CORRER ARCHIVO ./App/config/BD.txt SOBRE BASE DE DATOS  >> udelbosque
** LA PAGINA PRINCIAL ESTA SOBRE LA RUTA http://{dominio}/home/inicio

Configuracion del apache usado
<VirtualHost *:80> 
    DocumentRoot "C:/var/www/html/uDelBosque/public/"
    ServerName uDelBosque.local
    ServerAlias *.uDelBosque.local
    <Directory "C:/var/www/html/uDelBosque/public/">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>