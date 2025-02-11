##
Utilizar un mismo token JWT en 2 servidores:

El Servidor 1 genera un JWT con una clave secreta o privada y lo envía al cliente, quien lo usa para autenticarse en ambos servidores. El Servidor 2 recibe el JWT, verifica su firma con la misma clave compartida y, si es válido, permite el acceso. 

Proteger las contraseñas cuando se filtra la base de datos:
en caso de filtrarce las contraseñas utilizan hash para encriptarce y hace imposible revertir ya que es unidireccional

Identificar la sesión de un usuario en un sistema SSR:

se utiliza $_SESSIONS['id_usuario'] para identificar usuarios logueado
 
###
PDO sirve para prevenir los ataques de Cross Site Scripting (XSS) falso . PDO Es para la coneccion con la base de datos

Se puede implementar una API REST válida que no devuelva JSON falso, ya que obtienen json como respuesta 

Las APIs REST pueden ser consumidas por un CSR verdadero , mayormente se utilizan para el csr

Todas las APIs necesitan al menos un método de autenticación falsa 
 
Si el único requerimiento no funcional es que el sitio ande en dispositivos con poca capacidad de cómputo,
conviene SSR a CSR verdadera 




