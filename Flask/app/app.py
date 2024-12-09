from flask import Flask, render_template, request, redirect, url_for
from flask_mysqldb import MySQL

# Inicializar Flask
app = Flask(__name__)

# Configuración de MySQL
app.config['MYSQL_HOST'] = 'localhost'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'bd_examen_final'

conexion = MySQL(app)

# Definición de rutas
@app.route("/")
def index():
    return render_template('index.html')

    

@app.route("/misProveedores")
def index_proveedores():
    data = {}
    try:
        cursor = conexion.connection.cursor()
        sql = "SELECT * FROM proveedores"
        cursor.execute(sql)
        proveedores = cursor.fetchall()
        data['proveedores'] = proveedores
        data['mensaje'] = 'Éxito'
        cursor.close()
    except Exception as ex:
        data['mensaje'] = 'Error ...'
        cursor.close()

    return render_template('proveedores.html', proveedores=data['proveedores'])

@app.route("/registrarProveedor", methods=['POST'])
def registrar_proveedor():
    if request.method == 'POST':
        # Recoger los datos del formulario
        nombre = request.form['nombreProveedor']
        contacto = request.form['contactoProveedor']
        direccion = request.form['direccionProveedor']
        
        try:
            # Insertar los datos en la base de datos
            cursor = conexion.connection.cursor()
            sql = "INSERT INTO proveedores (nombre, contacto, direccion) VALUES (%s, %s, %s)"
            cursor.execute(sql, (nombre, contacto, direccion))
            conexion.connection.commit()  # Confirmar los cambios
            cursor.close()
            return redirect("/misProveedores")  # Redirigir a la lista de proveedores
        except Exception as ex:
            return f"Error al registrar el proveedor: {ex}"

@app.route("/modificarProveedor", methods=['POST'])
def modificar_proveedor():
    if request.method == 'POST':
        id_proveedor = request.form['idProveedorM']
        nombre = request.form['nombreProveedorM']
        contacto = request.form['contactoProveedorM']
        direccion = request.form['direccionProveedorM']
        
        try:
            cursor = conexion.connection.cursor()
            sql = "UPDATE proveedores SET nombre = %s, contacto = %s, direccion = %s WHERE id = %s"
            cursor.execute(sql, (nombre, contacto, direccion, id_proveedor))
            conexion.connection.commit()
            cursor.close()
            return redirect("/misProveedores")  # Redirige a la lista de proveedores
        except Exception as ex:
            return f"Error al modificar el proveedor: {ex}"

@app.route("/eliminarProveedor", methods=['POST'])
def eliminar_proveedor():
    if request.method == 'POST':
        id_proveedor = request.form['idProveedor']
        
        try:
            cursor = conexion.connection.cursor()
            sql = "DELETE FROM proveedores WHERE id = %s"
            cursor.execute(sql, (id_proveedor,))
            conexion.connection.commit()
            cursor.close()
            return redirect("/misProveedores")  # Redirige a la lista de proveedores
        except Exception as ex:
            return f"Error al eliminar el proveedor: {ex}"



@app.route("/misCategorias")
def index_categorias():
    data = {}
    try:
        cursor = conexion.connection.cursor()
        sql = "SELECT * FROM categorias"
        cursor.execute(sql)
        categorias = cursor.fetchall()
        data['categorias'] = categorias
        data['mensaje'] = 'Éxito'
        cursor.close()
    except Exception as ex:
        data['mensaje'] = 'Error ...'
        cursor.close()

    return render_template('categorias.html', categorias=data['categorias'])

@app.route("/registrarCategoria", methods=['POST'])
def registrar_categoria():
    if request.method == 'POST':
        # Recoger los datos del formulario
        nombre = request.form['nombreCategoria']
        
        try:
            # Insertar los datos en la base de datos
            cursor = conexion.connection.cursor()
            sql = "INSERT INTO categorias (nombre) VALUES (%s)"
            cursor.execute(sql, (nombre,))
            conexion.connection.commit()  # Confirmar los cambios
            cursor.close()
            return redirect("/misCategorias")  # Redirigir a la lista de categorías
        except Exception as ex:
            return f"Error al registrar la categoría: {ex}"

@app.route("/modificarCategoria", methods=['POST'])
def modificar_categoria():
    if request.method == 'POST':
        id_categoria = request.form['idCategoriaM']
        nombre = request.form['nombreCategoriaM']
        
        try:
            cursor = conexion.connection.cursor()
            sql = "UPDATE categorias SET nombre = %s WHERE id = %s"
            cursor.execute(sql, (nombre, id_categoria))
            conexion.connection.commit()
            cursor.close()
            return redirect("/misCategorias")  # Redirige a la lista de categorías
        except Exception as ex:
            return f"Error al modificar la categoría: {ex}"

@app.route("/eliminarCategoria", methods=['POST'])
def eliminar_categoria():
    if request.method == 'POST':
        id_categoria = request.form['idCategoria']
        
        try:
            cursor = conexion.connection.cursor()
            sql = "DELETE FROM categorias WHERE id = %s"
            cursor.execute(sql, (id_categoria,))
            conexion.connection.commit()
            cursor.close()
            return redirect("/misCategorias")  # Redirige a la lista de categorías
        except Exception as ex:
            return f"Error al eliminar la categoría: {ex}"



@app.route("/misProductos")
def index_productos():
    data = {}
    try:
        cursor = conexion.connection.cursor()

        # Obtener los productos
        sql_productos = 'SELECT p.id, p.nombre, p.precio, c.nombre, c.id as categoria FROM productos p JOIN categorias c ON p.categoria_id = c.id'

        cursor.execute(sql_productos)
        productos = cursor.fetchall()

        # Obtener las categorías para el select
        sql_categorias = "SELECT * FROM categorias"
        cursor.execute(sql_categorias)
        categorias = cursor.fetchall()

        # Pasar los datos al template
        data['productos'] = productos
        data['categorias'] = categorias  # Agregar las categorías
        data['mensaje'] = 'Éxito'
        cursor.close()
    except Exception as ex:
        data['mensaje'] = 'Error ...'
        cursor.close()

    return render_template('productos.html', productos=data['productos'], categorias=data['categorias'])

@app.route("/registrarProducto", methods=['POST'])
def registrar_producto():
    if request.method == 'POST':
        # Recoger los datos del formulario
        nombre = request.form['nombreProducto']
        precio = request.form['precioProducto']
        categoria_id = request.form['categoriaProducto']
        
        try:
            # Insertar los datos en la base de datos
            cursor = conexion.connection.cursor()
            sql = "INSERT INTO productos (nombre, precio, categoria_id) VALUES (%s, %s, %s)"
            cursor.execute(sql, (nombre, precio, categoria_id))
            conexion.connection.commit()  # Confirmar los cambios
            cursor.close()
            return redirect("/misProductos")  # Redirigir a la lista de productos
        except Exception as ex:
            return f"Error al registrar el producto: {ex}"

@app.route("/modificarProducto", methods=['POST'])
def modificar_producto():
    if request.method == 'POST':
        id_producto = request.form['idProductoM']
        nombre = request.form['nombreProductoM']
        precio = request.form['precioProductoM']
        categoria_id = request.form['categoriaProductoM']
        
        try:
            cursor = conexion.connection.cursor()
            sql = "UPDATE productos SET nombre = %s, precio = %s, categoria_id = %s WHERE id = %s"
            cursor.execute(sql, (nombre, precio, categoria_id, id_producto))
            conexion.connection.commit()
            cursor.close()
            return redirect("/misProductos")  # Redirige a la lista de productos
        except Exception as ex:
            return f"Error al modificar el producto: {ex}"

@app.route("/eliminarProducto", methods=['POST'])
def eliminar_producto():
    if request.method == 'POST':
        id_producto = request.form['idProducto']
        
        try:
            cursor = conexion.connection.cursor()
            sql = "DELETE FROM productos WHERE id = %s"
            cursor.execute(sql, (id_producto,))
            conexion.connection.commit()
            cursor.close()
            return redirect("/misProductos")  # Redirige a la lista de productos
        except Exception as ex:
            return f"Error al eliminar el producto: {ex}"






# Punto de entrada
if __name__ == '__main__':
    app.run(debug=True)
