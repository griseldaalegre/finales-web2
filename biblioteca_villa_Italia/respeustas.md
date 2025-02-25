##
ejemplo:// GET api/historias?id_mascota=:id_mascota&orderBy=:orderBy&order=[asc|desc] en get si se pueden pasar
        parametros pero en un post no
1)a)
1) api/libro/  get 
1) api/libro?titulo=harry%potter get
1) api/libro?genero=accion get
1) api/libro?2 get
1) api/libro?OrderBy=:orderby&order=[ASC:DESC]

1)b

GET /api/libro?genero=poesia&order=ASC&orderBy=nombre&limit=20

3-a)

API RESTful es ideal para aplicaciones dinámicas, móviles, desacopladas y con mucha interactividad (como redes sociales, chats, aplicaciones móviles, etc.), donde el frontend y el backend son independientes.

SSR es mejor para aplicaciones SEO-friendly o sitios web que requieren carga inicial rápida y contenido estático (como blogs, e-commerce, noticias), donde el servidor gestiona el renderizado de la página.

3-b)el cliente envia una peticion al servidor el servidor la obtiene y la prosesa , el servidor envia la respuesta y se muestra en el cliente y el protocolo http se utiliza para la comunicacion entre el cliente y el servidor 