Sistema de Administración de Netbooks de Conectar Igualdad
==========================================================

Historia
--------

**¿Por qué decidí crear este sistema?**

A principio de año, mi padre (quien es encargado de administrar las netbooks de mi escuela) se amontonó de netbooks, y no conocía el estado de las cuales. Además de ello, necesitaba llevar un control de quiénes llevan sus netbooks a desbloquear cada semana. Frente a estas necesidades, me pidió que le haga un sistema.

Al sistema lo realicé en dos semanas. Mucho del código es mejorable y tengo pensado reescribirlo.

Requerimientos
--------------

1. Servidor web (como Apache. De preferencia Apache)
2. PHP5
3. SQLite3
4. PHP5-SQLite3
5. GIT

Instalación
-----------

Luego de instalar los requerimientos, es necesario realizar lo siguiente:

1. clonar repositorio a carpeta donde se quiera usar `cd /var/www/; git clone https://github.com/fermuch/Admin-Igualdad.git sistema`
2. dar permisos de escritura y lectura a la carpeta system/sqlite y sus archivos. `chmod -R 777 /var/www/sistema/system/sqlite`


**Nota:**
¿Se pueden listar los alumnos pero no se pueden insertar nuevos alumnos?
Es un problema de permisos de SQLite. La carpeta (system/sqlite) debe ser parte del mismo usuario y grupo que web. (En el caso del servidor de mi escuela, www-data)



Preguntas Frecuentes
--------------------

**¿Cómo ingreso al panel de administración?**
Para ingresar, se debe presionar en el texto de Pi que aparece abajo a la derecha (es muy pequeño). El usuario y contraseña por defecto es: Usuario: root  Contraseña: toor



Contacto
--------

###¿Necesitás ayuda? ¿No podés instalar el sistema? ¿Querés comunicarme algo? ¿Querés que añada algo al sistema?

Para todo ello, podés escribirme un correo a **fermuch arroba gmail punto com**
