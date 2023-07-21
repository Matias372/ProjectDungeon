
import os

# Obtener la ruta del directorio actual (carpeta "extra")
directorio_actual = os.path.dirname(os.path.abspath(__file__))

# Lista de rutas completas de los archivos que deseas combinar
archivos = [
    (os.path.join(directorio_actual, "../index.php"), "index.php"),
    (os.path.join(directorio_actual, "../html/header.html"), "header.html"),
    (os.path.join(directorio_actual, "../html/footer.html"), "footer.html"),
    (os.path.join(directorio_actual, "../html/game/game.html"), "game.html"),
    (os.path.join(directorio_actual, "../html/game/nueva_partida.html"), "nueva_partida.html"),
    (os.path.join(directorio_actual, "../html/game/cargar_partida.html"), "cargar_partida.html"),
    (os.path.join(directorio_actual, "../html/game/Ciudad/city.html"), "city.html"),
    (os.path.join(directorio_actual, "../php/logros.php"), "logros.php"),
    (os.path.join(directorio_actual, "../php/controladores/cambiar_avatar.php"), "cambiar_avatar.php"),
    (os.path.join(directorio_actual, "../php/controladores/check_partida.php"), "check_partida.php"),
    (os.path.join(directorio_actual, "../php/controladores/GetRandCod.php"), "GetRandCod.php"),
    (os.path.join(directorio_actual, "../php/controladores/record_achievement.php"), "record_achievement.php"),
    (os.path.join(directorio_actual, "../php/controladores/validar_registro.php"), "validar_registro.php"),
    (os.path.join(directorio_actual, "../php/controladores/validar_sesion.php"), "validar_sesion.php"),
    (os.path.join(directorio_actual, "..//php/game/game.php"), "game.php"),
    (os.path.join(directorio_actual, "../php/game/guardar_partida.php"), "guardar_partida.php"),
    (os.path.join(directorio_actual, "../php/game/Personaje.php"), "Personaje.php"),
    (os.path.join(directorio_actual, "../php/game/Partida.php"), "Partida.php"),
    (os.path.join(directorio_actual, "../php/sesion/conexion.php"), "conexion.php"),
    (os.path.join(directorio_actual, "../php/sesion/cuenta.php"), "cuenta.php"),
    (os.path.join(directorio_actual, "../php/sesion/inicio_sesion.php"), "inicio_sesion.php"),
    (os.path.join(directorio_actual, "../php/sesion/registro.php"), "registro.php"),
    (os.path.join(directorio_actual, "../php/sesion/logout.php"), "logout.php"),
    (os.path.join(directorio_actual, "../js/game.js"), "game.js"),
    (os.path.join(directorio_actual, "../js/index.js"), "index.js"),
    (os.path.join(directorio_actual, "../js/nueva_partida.js"), "nueva_partida.js"),
    (os.path.join(directorio_actual, "../js/registro.js"), "registro.js"),
    # Lista de rutas de archivos aquí...
]

# Límite máximo de tokens por archivo combinado
limite_tokens = 2000

# Función para contar los tokens en un texto dado
def contar_tokens(texto):
    return len(texto.split())

# Función para leer el contenido de un archivo y combinarlo en un solo archivo
def combinar_archivos():
    num_archivos_combinados = 0
    tokens_actuales = 0
    archivo_salida_actual = f"archivos_combinados_{num_archivos_combinados}.txt"

    for ruta, nombre_archivo in archivos:
        try:
            with open(ruta, 'r') as archivo_entrada:
                contenido = archivo_entrada.read()
                num_tokens_archivo = contar_tokens(contenido)
                if tokens_actuales + num_tokens_archivo <= limite_tokens:
                    with open(archivo_salida_actual, 'a') as archivo_combinado:
                        archivo_combinado.write(f"====== {nombre_archivo} ======\n\n")
                        archivo_combinado.write(contenido + "\n\n")
                    tokens_actuales += num_tokens_archivo
                else:
                    # Nuevo archivo de salida, incrementar contador
                    num_archivos_combinados += 1
                    tokens_actuales = num_tokens_archivo
                    archivo_salida_actual = f"archivos_combinados_{num_archivos_combinados}.txt"
                    with open(archivo_salida_actual, 'w') as archivo_combinado:
                        archivo_combinado.write(f"====== {nombre_archivo} ======\n\n")
                        archivo_combinado.write(contenido + "\n\n")
        except FileNotFoundError:
            print(f"¡Error! No se pudo encontrar el archivo: {ruta}")



if __name__ == "__main__":
    print("Ruta del directorio actual:", directorio_actual)

    combinar_archivos()
    print("Archivos combinados y guardados.")
