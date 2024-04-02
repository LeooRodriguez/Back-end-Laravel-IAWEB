
# Proyecto Framework PHP - Laravel data-mavericks

### Links

-   [Deploy en Vercel](https://data-mavericks-laravel.vercel.app)
-   [Swagger UI](https://data-mavericks-laravel.vercel.app/apis/documentation)

### Aclaraciones 

-   Las rutas **/api/..** en Vercel no funcionan puesto que usa esa dirección, por lo que todas las consultas a la API son a **/apis/**

### Ejemplos para probar la API


##### GET /productos

-   Retorna todas los productos en un array.

##### GET /marcas

-   Retorna todas las marcas en un array.
-   Depende si estas marcas estan habilitadas o no.


##### GET /pedidos

-   Retorna todas los pedidos en un array (sin su correspondiente id).


##### POST /crearPedido

-   Crea el pedido en base a el id del cliente y el nombre del producto asociado, ambos deben estar
en la base de datos de Supabase.

-   Para agilizar el testeo, los clientes son del 1 al 10.

##### PUT /editarPedido

-   Modifica un pedido que actualmente se encuentra en la BD de Supabase, para dicho pedido se pueden incrementar o disminuir las cantidades asociadas a diferentes productos.


##### PUT /eliminarPedido

-   Elimina un pedido que actualmente se encuentra en la BD de Supabase, para poder realizar esta accion solo es necesario conocer el id correspondiente de el pedido en particular, este sera eliminado de la base de datos.

### Herramientas y Librerías utilizadas

-   **Blade, Breeze y Eloquent:** herramientas que forman parte del framework Laravel, utilizadas para poder crear vistas a partir de templates, tener un sistema de login.

<br>

-   **Vercel:** sitio web para hacer el deploy de nuestra aplicación de manera gratuita
    [_Sitio Oficial_](https://vercel.com)
    <br>

-   **Supabase:** sitio web que hostea nuestra base de datos PostgreSQL
    [_Sitio Oficial_](https://app.supabase.com)

<br>

-   **JQuery:** librería de JavaScript utilizada por dos plugins.
    [_Sitio Oficial_](https://jquery.com/)

<br>

-   **Datatables:** es un plugin de JQuery, que utilizamos para crear las tablas de la aplicación web de manera sencilla.
    [_Sitio Oficial_](https://datatables.net/)

<br>

-   **Bootstrap:** librería para simplificar la tarea de crear estilos, de la cual sacamos componentes con estilos ya predefinidos.
    [_Sitio Oficial_](https://getbootstrap.com/)

<br>

-   **L5-Swagger:** librería para a partir de anotaciones en el código php generar la documentación de la API en Swagger.
    [_Sitio Oficial_](https://swagger.io/specification/)


------------------------------------------------------------------------------------------------------




- Respecto a laravel, descripcion breve:
    - qué entidades se podrán actualizar (ABM: Alta, baja y modificación)
		.Marcas: ABM de marcas.
		.Productos: ABM de productos.
    - qué reportes se podrán generar o visualizar
		.Falta stock de producto
		.Error al ingresar
		.Error en la carga de un producto
		.Se aceptó la carga del producto
    - qué entidades se podrán obtener por API
		.Producto
		.Marca
		.Detalle_Pedidos
    - qué entidades se podrán modificar por API
		.Producto
		.Marca
		
- Respecto a javascript , descripcion breve:
    - que información podrá ver el usuario,
		.Producto acompañado de su descripcion, precio, nombre, stock y una imagen del mismo.
		.Pedidos realizados (con sus detalles)
    - que acciones podrá realizar, ya sea la primera vez que ingrese a la aplicación como futuros accesos a la misma
		.Realiza pedidos
		.Buscar productos
		.(Primera vez) Crear cuenta
		.Por parte del Administrador este podra:
			.Cargar Productos
			.Eliminar Productos
			.Cargar marcas
			.Eliminar marcas

Nombre de la pagina web:
	MiauDelicias.com

![Diagrama entidad relacion:](/EntidadRelacionIWeb.png)

https://drive.google.com/file/d/1l9-iPq4RymLBM4Wv85NTYX1Dsw0euSkn/view