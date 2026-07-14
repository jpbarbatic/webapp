<?php

/**
 * Clase DB
 * Ofrece un API para el acceso sencillo a la base de datos
 * Utiliza el patrón Singleton para devolver siempre la misma instancia
 */
class DB
{
    private static ?DB $instancia = null;
    private PDO $conn;

    /**
     * __construct
     *
     * @param  mixed $conn
     * @return void
     */
    private function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * getConnection
     *
     * @return DB|false
     */
    public static function open($conf = null): DB|false
    {
        if (self::$instancia == null) {
            if (isset($conf)) {
                                
                if(!isset($conf['db_type'])){
                    $conf['db_type']='mysql';
                }

                if(!isset($conf['db_port'])){
                    $conf['db_port']='3306';
                }

                extract($conf);
            } else {             
                $db_type = defined('DB_TYPE') ? DB_TYPE : 'mysql';
                $db_host = DB_HOST;
                $db_port = defined('DB_PORT') ? DB_PORT : '3306';
                $db_user = DB_USER;
                $db_pass = DB_PASS;
                $db_name = DB_NAME;
            }

            if ($db_type === 'sqlite') {
                $conn = new PDO("sqlite:" . $sqlite_path);
            } else {
                // Construimos la cadena de conexión (DSN) usando constantes definidas en utils.php
                $uri = $db_type . ":host=" . $db_host . ";port=" . $db_port . ";dbname=" . $db_name . ";charset=utf8mb4";
                $conn = new PDO($uri, $db_user, $db_pass);
            }

            // Configuramos el modo de errores: excepciones
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Configuramos el modo de obtención de resultados: como array asociativo
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            self::$instancia = new DB($conn);
        }

        return self::$instancia;
    }


    /**
     * begin
     *
     * @return bool
     */
    public function begin()
    {
        return $this->conn->beginTransaction();
    }


    /**
     * commit
     *
     * @return bool
     */
    public function commit()
    {
        if ($this->conn->inTransaction()) {
            return $this->conn->commit();
        }
        return false;
    }

    /**
     * rollback
     *
     * @return bool
     */
    public function rollback()
    {
        if ($this->conn->inTransaction()) {
            return $this->conn->rollBack();
        }
        return false;
    }

    /**
     * query
     *
     * @param  mixed $query SQL
     * @param  mixed $params array con campos y valores
     * @return array|int|false
     */
    public function query($query, $params = null)
    {
        $stmt = $this->conn->prepare($query);
        /*
        if ($params !== null) {
            foreach ($params as $key => $value) {
                // ⚠️ PDO usa índice 1-based para placeholders posicionales (?)
                $bindKey = is_int($key) ? $key + 1 : $key;

                // 🔍 Detección automática: tipo PHP → constante PDO
                $type = match (true) {
                    $value === null  => PDO::PARAM_NULL,
                    is_bool($value) => PDO::PARAM_BOOL,
                    is_int($value)  => PDO::PARAM_INT,
                    default         => PDO::PARAM_STR,
                };

                $stmt->bindValue($bindKey, $value, $type);
            }
        }*/

        // execute() sin argumentos porque ya hicimos el bind manual
        if ($stmt->execute($params)) {
            // Si la consulta devuelve columnas (SELECT, SHOW, DESCRIBE, etc.)
            if ($stmt->columnCount() > 0) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            // Para INSERT/UPDATE/DELETE, devolver número de filas afectadas
            return $stmt->rowCount();
        }
        return false;
    }

    /**
     * get_by_id
     *
     * @param  mixed $table
     * @param  mixed $id
     * @return mixed
     */
    public function get_by_id($table, $id, $id_name = 'id')
    {
        // Validamos que los nombres de tabla y columna sean seguros
        if (!is_valid_identifier($table) || !is_valid_identifier($id_name)) {
            return false;
        }

        // Consulta SQL protegida con marcador de posición
        $sql = "SELECT * FROM `$table` WHERE `$id_name` = ?";

        // Ejecutamos la consulta con el parámetro
        $res = $this->query($sql, [$id]);

        // Si hay resultado, devolvemos el primero, sino false
        return is_array($res) && !empty($res) ? $res[0] : false;
    }

    /**
     * insert
     *
     * @param  mixed $table
     * @param  mixed $dto
     * @return mixed
     */
    public function insert($table, $dto)
    {
        // Verificamos que los datos y el nombre de la tabla sean válidos
        if (empty($dto) || !is_valid_identifier($table)) {
            return false;
        }

        if (isset($dto['id'])) {
            unset($dto['id']);
        }
        // Extraemos las claves del array (campos de la tabla)
        
        $fields = array_keys($dto);
        // Escapamos los campos y validamos cada uno
        foreach ($fields as &$field) {
            if (!is_valid_identifier($field)) return false;
            $field = "`$field`";
        }

        // Marcadores de posición (?, ?, ...)
        $params = implode(', ', array_fill(0, count($dto), '?'));

        // Armamos la consulta SQL
        $fields_str = implode(', ', $fields);
        $sql = "INSERT INTO `$table` ($fields_str) VALUES ($params)";
        // Preparamos y ejecutamos la consulta

        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute(array_values($dto))) {
            // Retornamos el último ID generado
            $id = $this->conn->lastInsertId();
            return $id;
        }
        return false;
    }

    /**
     * update
     *
     * @param  mixed $table
     * @param  mixed $dto
     * @return bool
     */
    public function update($table, $dto, $id_name = 'id'): bool
    {
        // Validamos datos y nombres de identificadores
        if (empty($dto) || !is_valid_identifier($table) || !is_valid_identifier($id_name)) {
            return false;
        }

        // Verificamos que exista el ID en los datos
        if (!isset($dto[$id_name])) {
            return false;
        }

        // Guardamos el ID y lo quitamos de los datos a actualizar
        $id = $dto[$id_name];
        unset($dto[$id_name]);

        // Preparamos los campos y valores para la consulta
        $fields = [];
        $values = [];

        foreach ($dto as $key => $value) {
            if (!is_valid_identifier($key)) return false;
            $fields[] = "`$key` = ?";
            $values[] = $value;
        }

        // Añadimos el ID al final de los valores
        $values[] = $id;

        // Armamos la consulta SQL
        $sql = "UPDATE `$table` SET " . implode(', ', $fields) . " WHERE `$id_name` = ?";
        // Preparamos y ejecutamos la consulta
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($values);
    }

    /**
     * delete_by_id
     *
     * @param  mixed $table
     * @param  mixed $id
     * @return void
     */
    public function delete_by_id($table, $id, $id_name)
    {
        // Validamos los nombres de tabla y campo
        if (!is_valid_identifier($table) || !is_valid_identifier($id_name)) {
            return false;
        }
        // Preparamos la consulta con marcador de posición
        $stmt = $this->conn->prepare("DELETE FROM `$table` WHERE `$id_name` = ?");
        // Ejecutamos con el parámetro
        $stmt->execute([$id]);

        return $stmt->rowCount();
    }

    public function select(
        string $sql_base,
        array $params = [],
        int $limit = 0,
        int $offset = 0,
        ?string $order_by = null,
        ?string $order_dir = 'ASC'
    ): array {
        /*  
    // Validación de seguridad: evitar que el usuario inyecte paginación manualmente
    $sql_base_trimmed = trim($sql_base);
    if (preg_match('/\b(LIMIT|OFFSET|ORDER\s+BY)\b/i', $sql_base_trimmed)) {
        throw new InvalidArgumentException(
            'La consulta base no debe contener ORDER BY, LIMIT ni OFFSET. Use los parámetros de la función.'
        );
    }*/
        // 1️⃣ Construir consulta paginada
        $sql_data = $sql_base;
        $data_params = $params;

        if ($order_by !== null && $order_by !== '') {
            $sql_data .= " ORDER BY {$order_by} {$order_dir}";
        }

        if ($limit > 0) {
            $sql_data .= " LIMIT ? OFFSET ?";
            $data_params[] = (int)$limit;
            $data_params[] = (int)$offset;
        }

        // 2️⃣ Construir consulta de conteo segura para consultas complejas. No se ordena
        // Se envuelve en subconsulta para que COUNT(*) funcione correctamente con GROUP BY, HAVING, JOINs, etc.
        $sql_count = "SELECT COUNT(*) as total FROM ({$sql_base}) as t_count";


        // 🔢 Obtener total de registros (sin paginación)
        $stmt_count = $this->conn->prepare($sql_count);
        $stmt_count->execute($params);
        $total = (int)$stmt_count->fetchColumn();

        // 📦 Obtener datos paginados
        $stmt_data = $this->conn->prepare($sql_data);
        $stmt_data->execute($data_params);
        $data = $stmt_data->fetchAll(PDO::FETCH_ASSOC);

        return ['total' => $total, 'datos' => $data];
    }
}

/**
 * Funciones wrapper de la clase DB para acceder a través de funciones
 */

/**
 * db_open
 *
 * @param array $conf Array con variables de conexión. El array contendrá las variables:
 * Ejemplo: $conf=['db_type'=>'mysql',db_host'=>'', 'db_port'=>'', 'db_user'=>'', 'db_pass'=>'', 'db_name'=>''};
 * @return DB
 */
function db_open($conf = null): ?DB
{
    try {
        $db = DB::open($conf);
        return $db;
    } catch (PDOException $e) {
        return null;
    }
}

/**
 * Inicia una transacción en la base de datos.
 *
 * @param DB $db Conexión activa a la base de datos
 */
function db_begin(DB $db): bool
{
    return $db->begin();
}

/**
 * Confirma los cambios realizados durante una transacción.
 *
 * @param DB $db Conexión activa a la base de datos
 * @return bool
 */
function db_commit(DB $db): bool
{
    return $db->commit();
}

/**
 * Revierte los cambios realizados durante una transacción.
 *
 * @param DB $db Conexión activa a la base de datos
 */
function db_rollback(DB $db): void
{
    $db->rollback();
}

/**
 * Ejecuta una consulta SQL preparada y devuelve los resultados.
 *
 * @param DB $db Conexión activa a la base de datos
 * @param string $query Consulta SQL a ejecutar
 * @param array|null $params Parámetros para la consulta preparada
 * @return array|int|false Array asociativo para SELECT, número de filas afectadas para INSERT/UPDATE/DELETE, o false en caso de error
 */
function db_query(DB $db, string $query, ?array $params = null): array|int|false
{
    try {
        return $db->query($query, $params);
    } catch (PDOException $e) {
        return false;
    }
}

function db_select(
    DB $db,
    string $sql_base,
    array $params = [],
    int $limit = 0,
    int $offset = 0,
    ?string $order_by = null,
    ?string $order_dir = 'ASC'
) {
    try {
        return $db->select($sql_base, $params, $limit, $offset, $order_by, $order_dir);
    } catch (PDOException $e) {
      echo $e;
        return false;
    }
}

/**
 * Obtiene un registro por su ID.
 *
 * @param DB $db Conexión activa a la base de datos
 * @param string $table Nombre de la tabla
 * @param mixed $id Valor del ID a buscar
 * @param string $id_name Nombre del campo ID (por defecto 'id')
 * @return mixed Registro encontrado o false si no se encuentra
 */
function db_get_by_id(DB $db, string $table, mixed $id, string $id_name = 'id'): mixed
{
    try {
        return $db->get_by_id($table, $id, $id_name);
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Inserta un nuevo registro en la tabla especificada.
 *
 * @param DB $db Conexión activa a la base de datos
 * @param string $table Nombre de la tabla
 * @param array $dto Datos a insertar (clave => valor)
 * @return mixed ID del nuevo registro o false si falla
 */
function db_insert(DB $db, string $table, array $dto)
{
    try {
        return $db->insert($table, $dto);
    } catch (PDOException $e) {
        echo $e;
        return false;
    }
}

/**
 * Actualiza un registro existente en la tabla.
 *
 * @param DB $db Conexión activa a la base de datos
 * @param string $table Nombre de la tabla
 * @param array $dto Datos actualizados (clave => valor)
 * @param string $id_name Nombre del campo ID (por defecto 'id')
 * @return bool true si se actualizó correctamente, false en caso contrario
 */
function db_update(DB $db, string $table, array $dto, string $id_name = 'id'): bool
{
    try {
        return $db->update($table, $dto, $id_name);
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Elimina un registro por su ID.
 *
 * @param DB $db Conexión activa a la base de datos
 * @param string $table Nombre de la tabla
 * @param mixed $id Valor del ID a eliminar
 * @param string $id_name Nombre del campo ID (por defecto 'id')
 * @return bool true si se eliminó correctamente, false en caso contrario
 */
function db_delete_by_id(DB $db, string $table, mixed $id, string $id_name = 'id')
{
    try {
        return $db->delete_by_id($table, $id, $id_name);
    } catch (PDOException $e) {
        return false;
    }
}

// -----------------------------
// Funciones auxiliares privadas
// -----------------------------

/**
 * Valida que un identificador (nombre de tabla o columna) sea seguro.
 *
 * @param string $identifier Nombre a validar
 * @return bool true si es válido, false en caso contrario
 */
function is_valid_identifier(string $identifier): bool
{
    return preg_match('/^[a-zA-Z0-9_]+$/', $identifier);
}

/**
 * Genera una cláusula WHERE segura y sus parámetros a partir de un array asociativo.
 *
 * @param array $filtros Ej: ['nombre' => ['like' => 'pepe'], 'precio' => ['<=' => 23]]
 * @return array ['where' => string, 'params' => array]
 */
function createFilters(array $filtros): array 
{
    $whereParts = [];
    $params = [];
    
    // Lista blanca de operadores permitidos (evita inyección SQL)
    $operadoresPermitidos = [
        '=', '!=', '<>', '>', '<', '>=', '<=', 
        'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 
        'IS NULL', 'IS NOT NULL'
    ];

    foreach ($filtros as $columna => $condiciones) {
        // 1. Sanitizar nombre de columna (solo letras, números, guiones bajos y puntos)
        $colSegura = preg_replace('/[^a-zA-Z0-9_\.]/', '', $columna);
        if ($colSegura === '') {
            continue; // Ignora columnas con nombres inválidos
        }

        // 2. Permitir formato simplificado: ['precio' => 23] se convierte en ['precio' => ['=' => 23]]
        if (!is_array($condiciones)) {
            $condiciones = ['=' => $condiciones];
        }

        // 3. Procesar cada condición de la columna
        foreach ($condiciones as $operador => $valor) {
            $op = strtoupper(trim($operador));
            
            if (!in_array($op, $operadoresPermitidos, true)) {
                throw new InvalidArgumentException("Operador no permitido: '{$op}' en la columna '{$columna}'");
            }

            // ➤ Caso especial: IS NULL / IS NOT NULL (no llevan valor ni ?)
            if (in_array($op, ['IS NULL', 'IS NOT NULL'], true)) {
                $whereParts[] = "{$colSegura} {$op}";
                continue;
            }

            // ➤ Caso especial: IN / NOT IN
            if (in_array($op, ['IN', 'NOT IN'], true)) {
                if (!is_array($valor) || empty($valor)) {
                    $whereParts[] = "1 = 0"; // Condición siempre falsa para evitar error de sintaxis "IN ()"
                    continue;
                }
                $placeholders = implode(',', array_fill(0, count($valor), '?'));
                $whereParts[] = "{$colSegura} {$op} ({$placeholders})";
                // array_values asegura que las claves sean numéricas consecutivas para PDO
                $params = array_merge($params, array_values($valor)); 
                continue;
            }

            // ➤ Bonus: Si es LIKE y el usuario no puso %, se los añadimos automáticamente
            if (($op === 'LIKE' || $op === 'NOT LIKE') && strpos((string)$valor, '%') === false) {
                $valor = '%' . $valor . '%';
            }

            // ➤ Caso estándar (=, <, >, etc.)
            $whereParts[] = "{$colSegura} {$op} ?";
            $params[] = $valor;
        }
    }

    // 4. Unir todas las partes con AND
    $sqlWhere = '';
    if (!empty($whereParts)) {
        $sqlWhere = ' WHERE ' . implode(' AND ', $whereParts);
    }

    return [
        'where'  => $sqlWhere,
        'params' => $params
    ];
}

/**
 * Registra errores en el log del servidor.
 *
 * @param Exception $e Excepción lanzada
 */
function logging(Exception $e): void
{
    error_log($e->getMessage());
}

