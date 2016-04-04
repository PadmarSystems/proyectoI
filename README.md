Proyecto I
===================


Este archivo contiene la información básica para que el **proyecto** funcione adecuadamente, 

----------


Clonar Repositorio
-------------

Para descargar el contenido del proyecto usa el comando **clone**
```
 $ git clone https://github.com/PadmarSystems/proyectoI.git
```


#### <i class="icon-file"></i> Crear constants.php

En la ruta **clases/** cree el archivo **constants.php** 

#### <i class="icon-pencil"></i> Modificar constants.php

El contenido original del archivo constants.php es el siguiente
```
/*   
 * Definicion de constantes del proyecto

 */
#acceso BD
const DDD_DBNAME = '';
const DDD_DBUSER = '';
const DDD_DBHOST = 'localhost';
const DDD_DBPASS = '';

const MAIL_HOST = '';
const MAIL_SMTPAUTH = false;
const MAIL_PORT= 2525;
const MAIL_USER = '';
const MAIL_PASS = '';
const MAIL_SMTPSECURE = '';
```

Modifique con los valores convenientes.

gitignore
-------------------

Es necesario que conserve los cambios del archivo **constants.php** localmente, para ignorar los cambios que realice de ahora en adelante en el archivo use la instrucción **rm --cached**

```
git rm --cached clases/constants.php
```